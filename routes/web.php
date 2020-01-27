<?php

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

//product
route::post('insertProduct','HomeController@insertProduct');
route::get('/input','HomeController@input');
Route::post('/doUpdate','HomeController@doUpdate');
Route::get('/upd/{id}','HomeController@upd');
Route::get('/doDelete/{id}','HomeController@deleteProduct');
Route::get('/view','HomeController@view');
Route::get('/viewup','HomeController@viewup');
Route::get('/viewdel','HomeController@viewdel');

//category
route::get('/inputcotegory','HomeController@inputcotegory');
route::post('insertCategory','HomeController@insertCategory');
Route::get('/viewupCateg','HomeController@viewupCateg');
Route::get('/viewdelCategory','HomeController@viewdelCategory');
Route::get('/updcategory/{id}','HomeController@updcategory');
Route::post('/doUpdateCategory','HomeController@doUpdateCategory');
Route::get('/deleteCategory/{id}','HomeController@deleteCategory');
//category

//comment
Route::resource('/comments','commentController');
Route::get('/doDeleteComment/{id}','HomeContoller@deleteComment');
//s

//replies
Route::resource('/replies','repliesController');

//

//cart
Route::post('/insertToCart','HomeController@insertToCart');
Route::get('/adCart/{id}','HomeController@adCart');
Route::get('/cartview','HomeController@cartView');
//

Route::get('/detail/{insert_id}','cobaController@detail');

//Update delete view user melalui admin
Route::get('/updUser/{id}','HomeController@updUser');

Route::get('/doUserDelete/{id}','HomeController@deleteUser');
Route::post('/updateUser', 'HomeController@updateUser');
Route::get('/viewuser','proposalController@viewAllProposal');
//

//untuk UI
Route::get('/doSearch','cobaController@search');
route::get('/','cobaController@UI');
route::get('/image','HomeController@image');
route::get('/welcome','HomeController@welcome');
route::get('/login','HomeController@login');


//Update profile show profile
Route::post('/updateProfile', 'HomeController@updateProfile');

route::post('/uploadPhoto','HomeController@updatePhoto');

Route::get('profile', 'HomeController@profile');

//CRUD untuk Position
route::get('/positioninput','HomeController@PositionInput');
route::post('/insertPosition','HomeController@insertPosition');

//routes auth
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//comment Reply
Route::post('/RepComment','HomeController@RepComment');
//Submit proposal
Route::post('/addProposal','proposalController@addProposal');
Route::get('toProposal/{insert_id}','proposalController@viewProposal');

//MasterData

Route::post('/addData','MasterController@addData');
Route::get('/MasterDataInput','MasterController@ViewFormMaster');

//proposal
Route::get('toDetailPropo/{proposal_id}','proposalController@replyProposal');
Route::post('rejectProposal','proposalController@rejectProposal');
Route::get('toDetailPropo2/{proposal_id}','proposalController@viewEditProposal');
Route::get('RequestSp/{insert_id}','ProposalController@RequestSponsor');

//View Company

Route::get('ProfileCompany','CompanyController@viewCompany');
Route::post('/addCompany','CompanyController@createCompany');
Route::get('toCompanyDet/{company_id}','CompanyController@viewDetailCompany');
Route::get('/viewListCompany','CompanyController@viewListOfCompany');
Route::post('editCompany','CompanyController@EditCompanyData');
Route::post('addMember','CompanyController@listCompanyMember');
Route::get('deleteUser/{id}','CompanyController@deleteUser');
Route::get('setPosition/{id}','CompanyController@setPosition');

//Request
Route::get('RequestList/{id}','RequestorController@requestList');
Route::get('toCompanyDet/{company_id}','CompanyController@viewDetailCompany');
