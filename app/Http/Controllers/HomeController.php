<?php

namespace App\Http\Controllers;

use App\carts;
use App\categories;
use App\comment;
use Illuminate\Http\Request;
use Validator;
use App\event;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Redirect;
use Illuminate\Support\Facades\Input;
use Image;
use App\position;
use App\reply;
use App\catevent;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function test(){


        $message=comment::all();
        return view('index',['message'=>$message]);
    }
     public function welcome()
    {
        return view('welcome');
    }

    public function UI()
    {
        
        return view('UI');

    }
    public function image()
    {
        return view('image');

    }

    public function index()
    {
        return view('home');
    }
    public function loginForm()
    {
        return view('login');
    }

 
    public function viewupdate()
    {
        return view('viewupdate');
    }
    public function viewdelete()
    {
        return view('viewdelete');
    }

    public function shop()
    {
        
      

        return view('shop');

    }

    public function eventProduct(Request $request)
    {
        //event product yang ingin dimasukkin
        // $validator = Validator::make($request->all(),
        //     [
        //         'title' => 'required',
        //         'caption' => 'required',
        //         'photo' => 'required|mimes:jpeg,bmp,png',
        //         'location'=>'required',
        //         'event_end'=>'required',
        //         'category'=>'required'

        //     ]);
        // if($validator->fails())
        // {
        //     return redirect()->back()->withErrors($validator);
        // }

        if($request->hasFile('photo'))
        {

            $profileImage=$request->file('photo');
            $profileImageSaveAsName=time()."-event.".
                $profileImage->getClientOriginalExtension();

            $upload_path='aset/';
            $filename=$upload_path . $profileImageSaveAsName;
            $success=$profileImage->move($upload_path,$profileImageSaveAsName);
        }
        
        if($request->hasFile('propo'))
        {

            $profileImage=$request->file('propo');
            $profileImageSaveAsName=time()."-propoevent.".
                $profileImage->getClientOriginalExtension();

            $upload_path='aset/';
            $filepropo=$profileImageSaveAsName;
            $success=$profileImage->move($upload_path,$profileImageSaveAsName);
        }

        $event = new event();
        $event->user_id = Auth::user()->id;
        $event->title = $request->title;
        $event->caption = $request->caption;
        $event->photo = $filename;
        $event->event_end=$request->event_end;

        $event->location=$request->location;
        $event->category=$request->category;
        $event->propo = $filepropo;

       
        $event->save();

        $coba=$event->event_id;
     
        $checklist = $_POST['catevent_tocategory'];
        
        $countcheck = count($checklist);

    foreach ($request->catevent_tocategory as $cat)
    {

        $catevent = new catevent();
        $catevent->catevent_toevent = $coba;
       
  
        
        $catevent->catevent_tocategory = $cat;
        
        
        $catevent->save();  

    }

        // $check=0;
        // for ($check=0; $check<$countcheck;$check++){

            
        // $data= array($checklist);
        // list($checklist) = $data;
        //     $cb=$request->catevent_tocategory;
        //     // $test=implode(",",$data);
        //     dd($cb);
        //     $catevent = new catevent();
        //     $catevent->catevent_toevent = $coba;
           
      
            
        //     $catevent->catevent_tocategory = $test;
            
            
        //     $catevent->save();  

        
        // dd($countcheck);

        // $catevent = new catevent();
        // $catevent->catevent_event = $event;
        // $catevent->catevent_category = $request->catevent_category;
        // $catevent->save();  

        return redirect('/view');
    }
    public function view()
    {
        //view dengan tampilan 8 perhalaman yang menggunakan paginate dan compact yang berfungsi sebagai defined variable agar bisa digunakan pada view
        if($user = Auth::user())
        {
            $ins = event::paginate(8);
            $event=DB::table('events')
                    ->join('users','users.id',"=",'events.user_id')
                    ->join('categories','categories.category_id','=','events.category')
                    ->get();
                    
            return view('shop',compact('event','ins'));
            
        }
        else
        {
        $ins = event::paginate(8);
        $event=DB::table('events')
                ->join('users','users.id',"=",'events.user_id')
                ->join('categories','categories.category_id','=','events.category')
                ->get();
                
        return view('shop',compact('event','ins'));
        }
      
    }
    public function viewup()
    {
        $event = event::paginate(8);
        return view('viewupdate',compact('event'));
    }
    public function viewdel()
    {
        $event = event::paginate(8);
        return view('viewdelete',compact('event'));
    }
    public function upd($id)
    {
        //update dengan fungsi find yang mana update yang berdasarkan id

        $event = event::find($id);
        $category = categories::all();
        return view('update',compact('event','category'));
    }

    public function detail($id)
    {
        //view detail yang menampilkan data yang sudah di input
        $event = event::find($id);
        
        
        $comment = DB::table('comment')
                    ->join('event', 'event.id','=','comment.item_id')
                    ->join('comment', 'comment.id','=','reply.comment_id')
                    ->where([['comment.item_id','=','event.id'],['comment.item_id','=','reply.comment_id'],])
                    ->get();

        
        return view('detailimage',compact('event'));
        // return view('detailimage',['event' => $event, 'id_item' => $id]);
    }

    //
    public function updUser($id)
    {
        $user = user::find($id);
        
        return view('userupdate',compact('user'));
    }
    // public function viewedituser()
    // {
    //     // $user = user::all();
    //     $getAlldata=DB::table
       
    //     return view('viewuser',compact('user'));
    // }
    //


    public function doUpdate(Request $request)
    {
        //melakukan update pada product yang sudh dievent

        $validator = Validator::make($request->all(),
            [
                'title' => 'required',
                'caption' => 'required',
                'photo' => 'required|mimes:jpeg,bmp,png',
                'price'=>'required|numeric',
                'category'=>'required'

            ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        if($request->hasFile('photo'))
        {

            $profileImage=$request->file('photo');
            $profileImageSaveAsName=time()."-product.".
                $profileImage->getClientOriginalExtension();

            $upload_path='aset/';
            $filename=$profileImageSaveAsName;
            $success=$profileImage->move($upload_path,$profileImageSaveAsName);
        }

        $event = event::find($request->id);
//        dd($event);
        $event->user_id = Auth::user()->id;
        $event->title = $request->title;
        $event->caption = $request->caption;
        $event->photo = $filename;
        $event->price=$request->price;
        $event->category=$request->category;

        $event->save();
        return redirect('/view');
    }

    public function deleteProduct($id)
    {
        //melakukan delete product
        event::destroy($id);
        return redirect('/view');
    }
    public function deleteUser($id)
    {
        //delete user yang hanya bisa dilakukan oleh admin jadi admin dapat memantain
        User::destroy($id);
        return redirect('/viewuser');
    }

    public function profile()
    {
        $currentDataUser=DB::table('users')
                        ->where([['users.id','=',Auth::user()->id]])
                        ->get();
        
                        $user = $currentDataUser;
        $position=DB::table('positions')
                ->where('positions.id_position','=',Auth::user()->position_id)
                ->get();
       
        foreach($user as $user)
        {
            $user;
        }
        return view('profile',['user'=>$user,'position'=>$position]);
    

    }


    public function updateProfile(Request $request) {
        //Melakukan update pada profile masing - masing user
        
       $checkEmail=DB::table('users')
                ->where([['users.email','=',$request->email]])
                ->get();
        $position=Position::all();
        $user=Auth::user();
        $user_id = $user->id;

        
        $user->name=$request->name;
        
        if(count($checkEmail) == NULL || $request->email == Auth::user()->email ){
        $user->email=$request->email;
        }


        else{
        
            return back()->with('failMsg','Success edit company .');

        }
        $user->password=($request->password);
      
            $user->gender=$request->gender;
        
     
//        if($request->hasFile('image')){
//            $image = $request->file('image');
//            $filename = time(). "-edit." . $image->getClientOriginalExtension();
//            Image::make($image)->resize(300, 300)->save( public_path('aset/profile_image_edit/' . $filename ) );
//
//
//            $user = Auth::user();
//            $user->image = $filename;
//
//            $user->save();
//        }
        if($request->hasFile('image'))
        {
            $profileImage = $request->file('image');
            //-profile nama belakang dari file tsb
            $profileImageSaveAsName = time(). "-profile." .
            $profileImage->getClientOriginalExtension();
            $upload_path = 'profile_image/';
            $profile_image_url = $upload_path . $profileImageSaveAsName;
            //logic = sukses berati profileImage(image) dipindahkan ke path atau folder yg ditentukan, simpan sbg nama dengan infix -profile
            $success=$profileImage->move($upload_path, $profileImageSaveAsName);
            $user->image=$profile_image_url;
        }
        
//        DB::table('users')->where('id', $user_id)->update($request->except('_token'));
            $user->position_id=$request->position_id;
         
            $user->save();
            return back()->with('sccsMsg','Success edit company .');
    }
    public function updateUser(Request $request) {
 
        $validator = Validator::make($request->all(),
            [
                'title' => 'required',
                'caption' => 'required',
                'photo' => 'required',
                'price'=>'required|numeric',
                'category'=>'required'

            ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        if($request->hasFile('photo'))
        {

            $profileImage=$request->file('photo');
            $profileImageSaveAsName=time()."-product.".
                $profileImage->getClientOriginalExtension();

            $upload_path='aset/';
            $filename=$upload_path . $profileImageSaveAsName;
            $success=$profileImage->move($upload_path,$profileImageSaveAsName);
        }

        $cart = new carts();
        $cart->user_id = Auth::user()->id;
        $cart->title = $request->title;
        $cart->caption = $request->caption;
        $cart->photo = $request->photo;
        $cart->price=$request->price;
        $cart->category=$request->category;
        $cart->save();
        return redirect('/view');
    }
    public function cartView()
    {
        $cart = carts::where('user_id','LIKE',''.Auth::user()->id.'')->paginate(5);
        return view('cartview',compact('cart'));
    }

    //category=====================
  
    public function eventCategory(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'categoryname' => 'required',
            ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $category = new categories();
        $category ->categoryname = $request->categoryname;
        $category ->save();
        return back();
    }
    //CRUD Category
    public function deleteCategory($id)
    {
        event::destroy($id);
        return redirect('/view');
    }
    public function viewdelCategory()
    {
        $category = categories::paginate(8);
        return view('viewdelCategory',compact('category'));
    }
    public function viewupCateg()
    {
        $category = categories::paginate(8);
        return view('viewupCategory',compact('category'));
    }
    public function updcategory($id)
    {
        $category = categories::find($id);
        return view('updateCategory',compact('category'));
    }
    public function doUpdateCategory(Request $request)
    {


        $validator = Validator::make($request->all(),
            [
                'categoryname' => 'required',

            ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $category = categories::find($request->id);
        $category->categoryname = $request->categoryname;
        $category->save();
        return back();
    }

    //category=========================


    //coment
    public function deleteComment($id)
    {
        //delete comment yang sudah dimasukkan
        comment::destroy($id);
        return back();
    }

    //coment
    public function PositionInput()
    {
        
        
        return view('positioninput');
    }
    public function eventPosition(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'position' => 'required',
            ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $position = new Position();
        $position->position = $request->position;
        $position->save();
        return redirect('/');
    }
    public function RepComment(request $request)
    {   
    
       date_default_timezone_set('Asia/Jakarta');
        $currtime=date('Y-m-d H:i');
        $currDate=date('Y-m-d', strtotime($currtime. ' + 7 days'));
        $reply = new reply();
        $reply->comment_id=$request->comment_id;
        $reply->user_replyid=auth::user()->id;
        $reply->reply=$request->reply;
        $reply->rep_created_at=$currtime;

        $reply->save();
        // return response()->json();
        return \App::make('redirect')->back()->with('flash_success', 'Thank you,!');




    }

    public function showReply($id)
    {
        $comment= comment ::find($id);
      
        $reply = DB::table('reply')
                    ->join('comment', 'comment.id','=','reply.comment_id')
                    ->where('comment.item_id','=','event.id')
                    ->get();


    }

    public function forgetPassword(Request $request)
    {

        $getMail = $request->email;
        $getUser = DB::table('users')
                ->where('users.email','=',$getMail)
                ->get();
        foreach($getUSer as $gU){
            $To = $gU->email;
            $User = $gU->name;
            $userid=$gU->id;
        }

        $getInitial=Str::substr($User, 0, 3);
        $getUpperInitial=strtoupper($getInitial);
        //
        //get rand 4 number
        $fourdigitrandom = mt_rand(1000,9999);
        //
        // initial + rand number
        $code=$getUpperInitial.$fourdigitrandom; 
        
        $setPassword = user::find($userid);
        $setPassword->password=bcrypt($code);
        $setPassword->save();

        Mail::to($To)->send(new mailForPassword($User,$Code));

        return back()->with(['successMsg'=>'success send message']);
    }
    


    public function passwordForm(){

        return view('reset');

    }
   

   
}
