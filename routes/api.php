<?php

use App\Http\Controllers\UserProfileController;
use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\postcontroller;



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

Route::middleware('auth:sanctum')->get('/User', function (Request $request) {
    return $request->User();
});

//UserProfileController
Route::post('user-register',[UserProfileController::class,'user_register']);
Route::post('add-user-profile',[UserProfileController::class,'insert_user_profile']);
Route::post('add-user-education',[UserProfileController::class,'insert_user_education']);
Route::post('update-user-education',[UserProfileController::class,'update_user_education']);
Route::post('delete-user-education',[UserProfileController::class,'delete_user_education']);
Route::get('get-education-listing',[UserProfileController::class,'education_listing']);
Route::post('add-user-experience',[UserProfileController::class,'insert_user_experience']);
Route::post('update-user-experience',[UserProfileController::class,'update_user_experience']);
Route::post('delete-user-experience',[UserProfileController::class,'delete_user_experience']);
Route::get('get-experience-listing',[UserProfileController::class,'experience_listing']);


Route::post('login',[ApiController::class,'login']);
Route::post('register',[ApiController::class,'register']);
Route::group(['middleware'=>['jwt.verify']],function(){
 Route::get('logout',[ApiController::class,'logout']);
});

//get API

Route::get('/login_data',[postcontroller::class,'getLoginData']);
Route::get('/register_data',[postcontroller::class,'getregisterData']);
Route::get('/hr',[postcontroller::class,'getHrData']);
Route::get('/get-contractor',[postcontroller::class,'getContractorData']);
Route::get('/reports',[postcontroller::class,'getReportsData']);


//Post API

Route::post('/get-add-data',[postcontroller::class,'addData']);
Route::post('/AddHrData',[postcontroller::class,'addHrData']);
Route::post('add-contractor',[postcontroller::class,'addContractorData']);
Route::post('addReports',[postcontroller::class,'addReportsData']);

//Delete API

Route::delete('/dellogin/{id}',[postcontroller::class,'DelLoginData']);
Route::delete('delhr/{id}',[postcontroller::class,'DelHrData']);
Route::delete('delar/{id}',[postcontroller::class,'DelReportsData']);
Route::delete('delcontractor/{id}',[postcontroller::class,'delContrData']);

//Route to get the reports to edit
//for edit record first get data and then update it.
Route::get('geteditlogin/{id}',[postcontroller::class,'editonedata']);
Route::patch('updatelogin/{id}',[postcontroller::class,'updateloginData']);

