<?php

namespace App\Http\Controllers;

use App\Company;
use Validator;
use Auth;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddYourEmployeePost;
use Image;
use Illuminate\Support\Facades\Input;

class CompanyController extends Controller
{
    //

    public function createCompany(AddYourEmployeePost $request)
    {
        // $validatedData = $request->validated();

        // if($validatedData->fails())
        // {
        //     return redirect()->back()->withErrors($validator);
        // }
        if($request->hasFile('company_photo'))
            {

       
                $profileImage=$request->file('company_photo');
                $profileImageSaveAsName=time()."-proposal.".$profileImage->getClientOriginalExtension();
                $upload_path='aset/';
                $Companyfile=$upload_path . $profileImageSaveAsName;
                $success=$profileImage->move($upload_path,$profileImageSaveAsName);
            }
        //Company Create New
                $company =new Company();
                $company->company_name = $request->company_name;
                $company->company_address=$request->company_address;
                $company->company_phone=$request->company_phone;
                $company->website_address=$request->website_address;
                $company->social_media=$request->social_media;
                $company->company_photo=$Companyfile;
                $company->save();

        $currUser= user::find(Auth::user()->id);
        $currUser->userid_tocompany=$company->company_id;
        $currUser->save();
        //Dipisah karna getclientoriginalextension() tidak bisa menerima data kosong. Next time coba dibuat nullable()
        if($request->hasFile('company_photo'))
        {
            $company->company_photo=$Companyfile;

        }

        return back()->with('successMsg','Success create company .');
    }

    public function viewDetailCompany($company_id)
    {
        //To get current company in form
        $companyDetail = company::find($company_id);
        $getdata=$companyDetail;
   
        $adminPos=DB::table('positions')
                    ->where([['position','=','Admin']])
                    ->get();

         foreach($adminPos as $aP){

            $admin= $aP->id_position;
        }
        

        $compDet= DB::table('companies')
        ->join('users','users.userid_tocompany','=','companies.company_id')
        ->join('positions','positions.id_position','=','users.position_id')     
        ->where([['users.id','=',Auth::user()->id]])
        ->get();

        $reqDet= DB::table('companies')  
                 ->where([['companies.company_id','=',$company_id]])
                 ->get();
       
        $owner= DB::table('companies')
        ->join('users','users.userid_tocompany','=','companies.company_id')
        ->join('positions','positions.id_position','=','users.position_id')     
        ->where([['positions.position','=','Admin']])
        ->get();

        //
        // to get all user to be selected when add member
        $getAlluser=DB::table('users')
                    ->where([['users.userid_tocompany','=',null]])
                    ->get();   
        //

        $getListMember= DB::table('users')
                     ->join('companies','companies.company_id','=','users.userid_tocompany')
                     ->join('positions','positions.id_position','=','users.position_id')
                     ->orderBy('positions.position', 'asc')
                     ->get();
        
       
        return view('DetailOfProfileCompany',['compDet'=>$compDet,'getAlluser'=>$getAlluser,'testVar'=>$company_id,'getListMember'=>$getListMember,'admin'=>$admin,'owner'=>$owner,'getdata'=>$getdata,'reqDet'=>$reqDet]);

        
    }
    public function AddYourEmployee()
    {

    }

    public function viewCompany()
    {   
        return view('ProfileCompany');
    }

    public function viewListOfCompany()   
    {
        $getPosition=DB::table('positions')
                    ->where([['position','=','Admin'],])
                    ->get();
        foreach($getPosition as $p)
        {
            $pos = $p->id_position;

        }
        $getListOfCompany= DB::table('companies')
                        ->join('users','users.userid_tocompany','=','companies.company_id')
                        ->where([['users.position_id','=',$pos],])
                        ->get();
        
       

        return view('ViewListCompany',['getListOfCompany'=>$getListOfCompany]);

    }

    public function EditCompanyData(request $request)
    {

       
        switch($request->input('action'))
        {
        
            case 'Edit':
                            if($request->hasFile('company_photo'))
                                {
                                    $profileImage=$request->file('company_photo');
                                    $profileImageSaveAsName=time()."-company.".$profileImage->getClientOriginalExtension();
                                    $upload_path='aset/';
                                    $Cfile=$upload_path . $profileImageSaveAsName;
                                    $success=$profileImage->move($upload_path,$profileImageSaveAsName);
                                
                                }
                            //Company Edit 
                                $company =company::find($request->company_id);

                                $company->company_name = $request->company_name;
                            

                                $company->company_address=$request->company_address;
                                $company->company_phone=$request->company_phone;
                                $company->website_address=$request->website_address;
                                $company->social_media=$request->social_media;
                            if($request->hasFile('company_photo'))
                            {
                                $company->company_photo=$Cfile;
                            
                            }
                        
                        
                                $company->save();
                        
                                 return back()->with('successMsg','Success edit company .');
        break;

        // case 'Delete':
        
        //               $listUser=user::find($request->id);
        //               dd($listUser);
        //               $listUser->userid_tocompany=null;
                    
        //               $listUser->save();

        //               return back()->with('successDel','Success delete member .');
                        

        // break;
         }
    }

    public function setPosition(Request $request)
    {
        $adminPos=DB::table('positions')
                    ->where([['position','=','Admin']])
                    ->get();

        $staffPos=DB::table('positions')
                    ->where([['position','=','Staff']])
                    ->get();

        foreach($staffPos as $sP){

            $staff= $sP->id_position;
        }

        foreach($adminPos as $aP){

            $admin= $aP->id_position;
        }
        $upAdmin=user::find($request->id);       
        $upAdmin->position_id=$admin;
        $upAdmin->save();

        $upStaff=Auth::user();
        $upStaff->position_id=$staff;
        $upStaff->save();

        return back()->with('successDel','Success delete member .');          
    }

    public function deleteUser(Request $request)
    {
        
        $listUser=user::find($request->id);
        
        $listUser->userid_tocompany=null;
      
        $listUser->save();

        return back()->with('successDel','Success delete member .');


    }
//buat form baru dibawah company detail, dimana mendapatkan current company id dan masukkan id user baru 
    public function listCompanyMember(Request $request)
    {   
        $company=company::find($request->company_id);
        $getCurrentCompanyID=$request->company_id;
        
        $user=user::find($request->id);
        $user->userid_tocompany=$getCurrentCompanyID;
        

        $user->save();  

        return back()->with('successAdd','Success edit company .');
        

    }

  
}
