<?php

namespace App\Http\Controllers;

use App\carts;
use App\categories;
use App\comment;
use Illuminate\Http\Request;
use Validator;
use App\insert;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Redirect;
use Illuminate\Support\Facades\Input;
use Image;
use App\position;
use App\reply;

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
    public function welcome()
    {
        return view('welcome');
    }

    public function UI()
    {
        return view('/UI');

    }
    public function image()
    {
        return view('image');

    }

    public function index()
    {
        return view('home');
    }
    public function login()
    {
        return view('login');
    }

    public function input()
    {
        $category = categories::all();
        return view('input',compact('category'));
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

    public function insertProduct(Request $request)
    {
        //insert product yang ingin dimasukkin
        $validator = Validator::make($request->all(),
            [
                'title' => 'required',
                'caption' => 'required',
                'photo' => 'required|mimes:jpeg,bmp,png',
                'location'=>'required',
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

        $insert = new Insert();
        $insert->user_id = Auth::user()->id;
        $insert->title = $request->title;
        $insert->caption = $request->caption;
        $insert->photo = $filename;
        $insert->location=$request->location;
        $insert->category=$request->category;
        $insert->save();
        return redirect('/view');
    }
    public function view()
    {
        //view dengan tampilan 8 perhalaman yang menggunakan paginate dan compact yang berfungsi sebagai defined variable agar bisa digunakan pada view

        $ins = insert::paginate(8);
        $insert=DB::table('inserts')
        ->join('users','users.id',"=",'inserts.user_id')
        ->get();
        return view('shop',compact('insert','ins'));
    }
    public function viewup()
    {
        $insert = insert::paginate(8);
        return view('viewupdate',compact('insert'));
    }
    public function viewdel()
    {
        $insert = insert::paginate(8);
        return view('viewdelete',compact('insert'));
    }
    public function upd($id)
    {
        //update dengan fungsi find yang mana update yang berdasarkan id

        $insert = insert::find($id);
        $category = categories::all();
        return view('update',compact('insert','category'));
    }

    public function detail($id)
    {
        //view detail yang menampilkan data yang sudah di input
        $insert = insert::find($id);
        $comment = DB::table('comment')
                    ->join('insert', 'insert.id','=','comment.item_id')
                    ->join('comment', 'comment.id','=','reply.comment_id')
                    ->where('comment.item_id','=','insert.id','AND','comment.item_id','=','reply.comment_id')
                    ->get();

        
        return view('detailimage',compact('insert'));
        // return view('detailimage',['insert' => $insert, 'id_item' => $id]);
    }

    //
    public function updUser($id)
    {
        $user = user::find($id);
        
        return view('userupdate',compact('user'));
    }
    public function viewedituser()
    {
        $user = user::all();
       
        return view('viewuser',compact('user'));
    }
    //


    public function doUpdate(Request $request)
    {
        //melakukan update pada product yang sudh diinsert

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
            $filename=$upload_path . $profileImageSaveAsName;
            $success=$profileImage->move($upload_path,$profileImageSaveAsName);
        }

        $insert = Insert::find($request->id);
//        dd($insert);
        $insert->user_id = Auth::user()->id;
        $insert->title = $request->title;
        $insert->caption = $request->caption;
        $insert->photo = $filename;
        $insert->price=$request->price;
        $insert->category=$request->category;

        $insert->save();
        return redirect('/view');
    }

    public function deleteProduct($id)
    {
        //melakukan delete product
        Insert::destroy($id);
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
        //view untuk profile
        // $viewProfile =DB::table('users')
        // ->join('positions','users.position_id','=','positions.id')
        // ->select('users.*','positions.position')
        // ->get();
       
        $position=Position::all();
        return view('profile', array('user' => Auth::user()),compact('position') );
    

    }


    public function updateProfile(Request $request) {
        //Melakukan update pada profile masing - masing user
        
       $position=Position::all();
        $user=Auth::user();
        $user_id = $user->id;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        if($request->hasFIle('gender'))
        {
            $user->gender=$request->gender;
        }
     
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
            $user->position_id=$request->position;
         
            $user->save();
            return redirect('/');
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
    public function inputcotegory()
    {
        return view('inputcotegory');
    }
    public function insertCategory(Request $request)
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
        Insert::destroy($id);
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
    public function insertPosition(Request $request)
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
        
        $reply = new reply();
        $reply->comment_id=$request->comment_id;
        $reply->user_id=auth::user()->id;
        $reply->reply=$request->reply;

        $reply->save();
        // return response()->json();
        return back();



    }

    public function showReply($id)
    {
        $comment= comment ::find($id);
      
        $reply = DB::table('reply')
                    ->join('comment', 'comment.id','=','reply.comment_id')
                    ->where('comment.item_id','=','insert.id')
                    ->get();


    }

    
   

   
}
