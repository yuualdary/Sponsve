<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::resource('/crud','CrudController',[
//     'except'=>['edit','show','store']
// ]);



//event
route::post('eventProduct','HomeController@eventProduct');
route::get('/input','HomeController@input');
Route::post('/doUpdate','HomeController@doUpdate');
Route::get('/updateEvent/{event_id}','EventController@updEvent');
Route::get('/doDelete/{id}','HomeController@deleteProduct');
Route::get('/view', 'EventController@view');
Route::get('/viewup','HomeController@viewup');
Route::get('/viewdel','HomeController@viewdel');
Route::post('/editEvent','EventController@editEvent');
Route::get('/downloadPropo/{event_id}','EventController@downloadFile');

//category
route::get('/inputcotegory','HomeController@inputcotegory');
route::post('eventCategory','HomeController@eventCategory');
Route::get('/viewupCateg','HomeController@viewupCateg');
Route::get('/viewdelCategory','HomeController@viewdelCategory');
Route::get('/updcategory/{id}','HomeController@updcategory');
Route::post('/doUpdateCategory','HomeController@doUpdateCategory');
Route::get('/deleteCategory/{id}','HomeController@deleteCategory');
//category

//comment
Route::resource('/comments','commentController');
Route::get('/deleteComment/{cmntid}','commentController@deleteComment');
Route::get('/deleteReplies/{replies_id}','commentController@deleteReplies');

//s

//replies
Route::resource('/replies','repliesController');

//

//cart
Route::post('/eventToCart','HomeController@eventToCart');
Route::get('/adCart/{id}','HomeController@adCart');
Route::get('/cartview','HomeController@cartView');
//

Route::get('/detail/{event_id}','EventController@detail');

//Update delete view user melalui admin
Route::get('/updUser/{id}','HomeController@updUser');

Route::get('/doUserDelete/{id}','HomeController@deleteUser');
Route::post('/updateUser', 'HomeController@updateUser');
Route::get('/viewuser','proposalController@viewAllProposal');
//

//untuk UI
Route::get('/doSearch','EventController@search');
route::get('/','eventController@UI');
route::get('/image','HomeController@image');
route::get('/welcome','HomeController@welcome');
route::get('/login','HomeController@login');


//Update profile show profile
Route::post('/updateProfile', 'HomeController@updateProfile');

route::post('/uploadPhoto','HomeController@updatePhoto');

Route::get('profile', 'HomeController@profile');

//CRUD untuk Position
route::get('/positioninput','HomeController@PositionInput');
route::post('/eventPosition','HomeController@eventPosition');
route::get('/viewDetailUserProile/{id}','userController@userDetail');

//routes auth
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//comment Reply
Route::post('/RepComment','HomeController@RepComment');
//Submit proposal
Route::post('/addProposal','proposalController@addProposal');
Route::get('toProposal/{event_id}','proposalController@viewProposal');

//MasterData

Route::post('/addData','MasterController@addData');
Route::get('/MasterDataInput','MasterController@ViewFormMaster');

//proposal
Route::get('toDetailPropo/{proposal_id}','proposalController@replyProposal');
Route::post('rejectProposal','proposalController@rejectProposal');
Route::get('toDetailPropo2/{proposal_id}','proposalController@viewEditProposal');
Route::get('RequestSp/{event_id}','ProposalController@RequestSponsor');

//View Company

Route::get('ProfileCompany','CompanyController@viewCompany');
Route::post('/addCompany','CompanyController@createCompany');
Route::get('toCompanyDet/{company_id}','CompanyController@viewDetailCompany');
Route::get('/viewListCompany','CompanyController@viewListOfCompany');
Route::post('editCompany','CompanyController@EditCompanyData');
Route::post('addMember','CompanyController@listCompanyMember');
Route::get('deleteUser/{id}','CompanyController@deleteUser');
Route::get('setPosition/{id}','CompanyController@setPosition');
Route::get('toCompanyFromList/{company_id}','CompanyController@viewDetailCompanyFromListRequest');

//Request
Route::get('RequestList/{id}','RequestorController@requestList');
Route::get('toCompanyDet/{company_id}','CompanyController@viewDetailCompany');
Route::get('approveRequest/{Mapping_Req_Id}','RequestorController@approveRequest');
Route::get('rejectRequest/{Mapping_Req_Id}','RequestorController@rejectRequest');

//log

Route::get('toLogCompany/{company_id}','logUserController@logUserCompany');