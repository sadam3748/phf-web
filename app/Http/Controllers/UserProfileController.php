<?php

namespace App\Http\Controllers;

use App\UserEducation;
use App\UserExperience;
use App\UserProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
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
            'message'=>'User Created Successfully',

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
        $User->profile_image = $request->profile_image;
        $User->cnic_front_image = $request->cnic_front_image;
        $User->cnic_back_image = $request->cnic_back_image;
        $User->domicile_image = $request->domicile_image;
        $User->pnc_certificate_image = $request->pnc_certificate_image;
        $User->save();
        return response()->json([
            'success'=>true,
            'code'=>1,
            'message'=>'User profile Created Successfully',

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

}
