<?php

namespace App\Http\Controllers;

use App\UserEducation;
use App\UserExperience;
use App\UserProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
//use App\Models\User;
use App\User;
use App\Http\Controllers\API\BaseController;


use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class UserProfileController extends Controller
{
    public function user_register(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required',
//        ]);
//
//        if($validator->fails()){
//            return $this->sendError($validator->errors() , $request->toArray(), 400);
//        }
        $User = new User();
        $User->name = $request->name;
        $User->email = $request->email;
        $User->contact_no = $request->contact_no;
        $User->pnc_no = $request->pnc_no;
        $User->password =bcrypt($request->password);
        $User->re_type_password =bcrypt($request->re_type_password) ;
        $User->save();
        return response()->json([
            'success'=>true,
            'code'=>1,
            'message'=>'first User Created Successfully',

        ],Response::HTTP_OK);

//        return $this->sendResponse(
//            'user Inserted Successfully.',
//            $User
//        );

    }
    public function insert_user_profile(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required',
//        ]);
//
//        if($validator->fails()){
//            return $this->sendError($validator->errors() , $request->toArray(), 400);
//        }

        $profile_image = $request->file('profile_image');
        $cnic_front_image = $request->file('profile_image');
        $cnic_back_image = $request->file('profile_image');
        $domicile_image = $request->file('profile_image');
        $pnc_certificate_image = $request->file('profile_image');

        $profile_image_path = $profile_image->store('profile_image');
        $cnic_front_image_path = $cnic_front_image->store('profile_image');
        $cnic_back_image_path = $cnic_back_image->store('profile_image');
        $domicile_image_path = $domicile_image->store('profile_image');
        $pnc_certificate_image_path = $pnc_certificate_image->store('profile_image');
        $User = new UserProfile();
        $User->user_id = $request->user_id;
        $User->father_name = $request->father_name;
        $User->gender = $request->gender;
        $User->date_of_birth = $request->date_of_birth;
        $User->cnic = $request->cnic;
        $User->cnic_expiry = $request->cnic_expiry;
        $User->marital_status = $request->marital_status;
        $User->domicile = $request->domicile;
        $User->city_of_residence = $request->city_of_residence;
        $User->address = $request->address;
        $User->profile_image = $profile_image_path;
        $User->cnic_front_image = $cnic_front_image_path ;
        $User->cnic_back_image = $cnic_back_image_path ;
        $User->domicile_image = $domicile_image_path ;
        $User->pnc_certificate_image = $pnc_certificate_image_path ;
        $User->save();

        return response()->json([
            'success'=>true,
            'code'=>1,
            'message'=>'change in User profile Created Successfully',

        ],Response::HTTP_OK);

    }
    public function insert_user_education(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required',
//        ]);
//
//        if($validator->fails()){
//            return $this->sendError($validator->errors() , $request->toArray(), 400);
//        }
        $User = new UserEducation();
        $User->user_id = $request->user_id;
        $User->education_level = $request->education_level;
        $User->obtain_marks = $request->obtain_marks;
        $User->institute = $request->institute;
        $User->passing_date = $request->passing_date;
        $User->degree_image = $request->degree_image;
        $User->save();
        return response()->json([
            'success'=>true,
            'code'=>1,
            'message'=>'User education Created Successfully',

        ],Response::HTTP_OK);

    }
    public function update_user_education(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required',
//        ]);
//
//        if($validator->fails()){
//            return $this->sendError($validator->errors() , $request->toArray(), 400);
//        }
        $User = UserEducation::where('id', $request['id'])->first();
        if($User){
            $User->education_level = $request->education_level;
            $User->obtain_marks = $request->obtain_marks;
            $User->institute = $request->institute;
            $User->passing_date = $request->passing_date;
            $User->degree_image = $request->degree_image;
            $User->save();
            return response()->json([
                'success'=>true,
                'code'=>1,
                'message'=>'User education Created Successfully',

            ],Response::HTTP_OK);
        }




    }
    public function delete_user_education(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required',
//        ]);
//
//        if($validator->fails()){
//            return $this->sendError($validator->errors() , $request->toArray(), 400);
//        }
        $User = UserEducation::where('id', $request['id'])->delete();
        if($User){

            return response()->json([
                'success'=>true,
                'code'=>1,
                'message'=>'User education Deleted Successfully',

            ],Response::HTTP_OK);
        }

    }

    public function education_listing(Request $request)
    {
        $listing = UserEducation::all();

        return response()->json([
            'success'=>true,
            'code'=>1,
            'message'=>'get education listing Successfully',$listing

        ],Response::HTTP_OK);


        return $this->sendResponse(
            ' litigation case status listing show successfully.',
            $litigation_case
        );
    }
    public function insert_user_experience(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required',
//        ]);
//
//        if($validator->fails()){
//            return $this->sendError($validator->errors() , $request->toArray(), 400);
//        }
        $User = new UserExperience();
        $User->user_id = $request->user_id;
        $User->organization_type = $request->organization_type;
        $User->organization_name = $request->organization_name;
        $User->position_title = $request->position_title;
        $User->from_date = $request->from_date;
        $User->to_date = $request->to_date;
        $User->is_working = $request->is_working;
        $User->certificate = $request->certificate;
        $User->save();
        return response()->json([
            'success'=>true,
            'code'=>1,
            'message'=>'User experience Created Successfully',

        ],Response::HTTP_OK);

    }
    public function update_user_experience(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required',
//        ]);
//
//        if($validator->fails()){
//            return $this->sendError($validator->errors() , $request->toArray(), 400);
//        }
        $User = UserExperience::where('id', $request['id'])->first();
        if($User){
            $User->organization_type = $request->organization_type;
            $User->organization_name = $request->organization_name;
            $User->position_title = $request->position_title;
            $User->from_date = $request->from_date;
            $User->to_date = $request->to_date;
            $User->is_working = $request->is_working;
            $User->certificate = $request->certificate;
            $User->save();
            return response()->json([
                'success'=>true,
                'code'=>1,
                'message'=>'User experience updated Successfully',

            ],Response::HTTP_OK);
        }

    }
    public function delete_user_experience(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required',
//        ]);
//
//        if($validator->fails()){
//            return $this->sendError($validator->errors() , $request->toArray(), 400);
//        }
        $User = UserExperience::where('id', $request['id'])->delete();
        if($User){
            return response()->json([
                'success'=>true,
                'code'=>1,
                'message'=>'User experience Deleted Successfully',

            ],Response::HTTP_OK);

        }

    }

    public function experience_listing(Request $request)
    {
        $listing = UserExperience::all();

        return response()->json([
            'success'=>true,
            'code'=>1,
            'message'=>'get education listing Successfully',$listing

        ],Response::HTTP_OK);


        return $this->sendResponse(
            ' litigation case status listing show successfully.',
            $litigation_case
        );
    }

}
