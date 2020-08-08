<?php
use App\User;

///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
//
//Route::get('/', function () {
//    return view('welcome');
//});
//route::get('/content2','HomeController@content2');

//event
route::post('createEvent','EventController@createEvent');
route::get('/input','EventController@toFormEvent');
Route::post('/doUpdate','HomeController@doUpdate');
Route::get('/updateEvent/{event_id}','EventController@formEditEvent');
Route::get('/doDelete/{id}','HomeController@deleteProduct');

Route::get('/view', 'EventController@view');
Route::get('/CompanyEvent', 'EventController@companyEvent');

Route::get('/viewMyEvent', 'EventController@viewMyEvent');

Route::get('/viewup','HomeController@viewup');
Route::get('/viewdel','HomeController@viewdel');
Route::post('/editEvent','EventController@editEvent');
Route::get('/downloadPropo/{event_id}','EventController@downloadFile');

//category
route::get('/inputcategory','MasterController@inputcategory');
route::post('eventCategory','MasterController@eventCategory');
Route::get('/viewupCateg','HomeController@viewupCateg');
Route::get('/viewdelCategory','HomeController@viewdelCategory');
Route::get('/updcategory/{id}','HomeController@updcategory');
Route::post('/doUpdateCategory','HomeController@doUpdateCategory');
Route::get('/deleteCategory/{id}','HomeController@deleteCategory');
//category

//comment
Route::resource('/comments','commentController');
Route::get('/deleteComment/{cmntid}','commentController@deleteComment');
Route::get('/deleteReplies/{replies_id}','repliesController@deleteReplies');

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
Route::get('/viewMyAssignList','proposalController@viewMyAssignList');
Route::get('/detailOurAssign/{proposal_id}','proposalController@detailOurAssign');
Route::get('/detailMyAssignList/{proposal_id}','proposalController@detaiProposalList');
Route::post('/changePIC','proposalController@changePIC');
// Route::get('/changePic/','proposalController@detailOurAssign');

//

//untuk UI
Route::get('/doSearch','EventController@searchEvent')->name('search');
route::get('/','EventController@UI');
route::get('/image','HomeController@image');
route::get('/welcome','HomeController@welcome');
route::get('/login','HomeController@loginForm');


//Update profile show profile
Route::post('/updateProfile', 'HomeController@updateProfile');

route::post('/uploadPhoto','HomeController@updatePhoto');

Route::get('profile', 'HomeController@profile');

//CRUD untuk Position
route::get('/positioninput','MasterController@PositionInput');
route::post('/eventPosition','MasterController@eventPosition');
route::get('/viewDetailUserProile/{id}','userController@userDetail');

//routes auth
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test','HomeController@test');

//comment Reply
Route::post('/RepComment','RepliesController@RepComment');
//Submit proposal
Route::post('/addProposal','proposalController@addContract');
Route::get('toProposal/{event_id}/{proposal_id}','proposalController@viewProposal');

//MasterData

Route::post('/addData','MasterController@addData');
Route::get('/MasterDataInput','MasterController@ViewFormMaster');

//proposal
// Route::get('toDetailPropo/{proposal_id}','proposalController@replyProposal');
Route::get('toDetailPropo2/{proposal_id}','proposalController@viewEditProposal');
// Route::get('toDetailPropo/{proposal_id}/{event_id}', [
//     'as' => 'toDetailPropo', 'uses' => 'proposalController@remindHelper']);

Route::post('rejectProposal','proposalController@approvalProposal');
Route::get('toDetailPropo/{proposal_id}','proposalController@replyProposal');
Route::post('RequestSp/','ProposalController@RequestSponsor');
Route::get('ourAssign/','ProposalController@viewOurAssign');


//View Company

Route::get('ProfileCompany','CompanyController@viewNewCompany');
Route::post('/addCompany','CompanyController@createCompany');
Route::get('toCompanyDet/{company_id}','CompanyController@viewDetailCompany');
Route::get('/viewListCompany','CompanyController@viewListOfCompany');
Route::post('editCompany','CompanyController@EditCompanyData');
Route::post('addMember','CompanyController@listCompanyMember');
Route::get('deleteUser/{id}','CompanyController@deleteUser');
Route::get('setPosition/{id}','CompanyController@setPosition');
Route::get('toCompanyFromList/{company_id}','CompanyController@viewDetailCompanyFromListRequest');
Route::get('companyList/','CompanyController@companyList');

Route::get('chooseCompanies/{event_id}','CompanyController@chooseCompanies');


//Request
Route::get('RequestList/{id}','RequestorController@requestList');
Route::get('toCompanyDet/{company_id}','CompanyController@viewDetailCompany');
Route::post('approveRequest','RequestorController@approveRequest');
Route::get('rejectRequest/{Mapping_Req_Id}','RequestorController@rejectRequest');
Route::post('RequestCompany','RequestorController@RequestCompany');
Route::get('chooseeCompany/{event_id}','RequestorController@chooseCompany');

//log

Route::get('toLogCompany/{company_id}','logUserController@logUserCompany');
Route::get('/notif', function() {
    $user = \App\User::first();
    $user->notify(new \App\Notifications\Daftar);
});


Route::get('/sendEmail','appEmailController@index');

Route::post('/sendChat','chatController@doSendChat');

// Route::get('/testAjax/{id}','chatController@AjaxCoba');
Route::get('/viewAllRequest','RequestorController@allRequest');


//chat pusher 

Route::get('/chatHome','ChatsController@index');
Route::get('/divmessage','chatsController@test');

// Route::get('messages','chatController@fetchMessages');
// Route::post('messages', 'chatController@sendMessage');

Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');
Route::post('/getReview','requestorController@sendReview');
Route::get('deleteEvent/{event_id}','EventController@deleteEvent');
Route::get('/passwordForm','HomeController@passwordForm');
route::post('/forgotPassword','HomeController@forgetPassword');