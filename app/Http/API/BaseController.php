<?php

/**
     * @OA\Info(
     *      version="1.0.0",
     *      title="LG&CD Documentation",
     *      description="Contains API documentation for LG&CD Portal",
     *      @OA\Contact(
     *          email="admin@admin.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="LG&CD API Server"
     * )

     *
     * @OA\Tag(
     *     name="LG&CD API",
     *     description="API Endpoints of LG&CD"
     * )
     *
     */
namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Config;

use App\Mail\MailAgent;

use Auth;
class BaseController extends Controller
{
    public $bypass_check = true;
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($message, $result, $custom_param_name = null, $custom_param_value = null,$custom_param_name1 = null, $custom_param_value1 = null,$custom_param_name2 = null, $custom_param_value2 = null)
    {
        if(!empty($custom_param_name)){
            $response = [
                'code' => 200,
                'success' => true,
                'message' => $message,
                'data'    => $result,
                $custom_param_name => $custom_param_value,
                $custom_param_name1 => $custom_param_value1,
                $custom_param_name2 => $custom_param_value2
            ];
        } else {
            $response = [
                'code' => 200,
                'success' => true,
                'message' => $message,
                'data'    => $result,

            ];
        }
        $response['SOE_YEAR'] = Config::get('constants.soe_year');
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $data = [], $code = 404)
    {
		if(is_array($error)){
            $error = implode(",", $error);
        }

        if(is_object($error)){
            $error = implode(",", $error->all());
        }
    	$response = [
			'code' => $code,
            'success' => false,
            'error' => $error,
        ];

        if(empty($error)){
            unset($response['error']);
        }

        if(!empty($data)){
            $response['data'] = $data;
        }

        $response['SOE_YEAR'] = Config::get('constants.soe_year');

        return response()->json($response, $code);
    }


    public function send_email($to_name, $to_email, $subject, $email_txt,$data=array(),$attachmentPath=null)
    {
        try{

            $log_data  = array(
                'to_name'  =>$to_name,
                'to_email'  =>$to_email,
                'subject'  =>$subject,
                'email_txt'  =>$email_txt,
                'created_at' =>date("Y-m-d H:i:s")
            );

            DB::table("mail_logs")->insert($log_data);

            Mail::to($to_email, $to_name)->queue(new MailAgent($subject,'emails.commonTemplate',$email_txt,$data,$attachmentPath));
            return true;
        }
        catch(\Exception $e){
            // Get error here
            return false;
        }


        // Mail::send([], [], function ($message) use ($to_name, $to_email, $subject, $email_txt)  {
        //     $message->to($to_email, $to_name)->subject($subject);
        //     $mail_from_params = config('mail.from');
        //     $from_name = $mail_from_params['name'];//env("MAIL_FROM_NAME", 'Admin | ELGCD');
        //     $from_address = $mail_from_params['address'];//env("MAIL_FROM_ADDRESS", 'admin@elgcd.punjab.gov.pk');
        //     // $message->from('admin@schemes.punjab.gov.pk','LG&CD'); //support@lgcd.com
        //     $message->from($from_address, $from_name); //support@lgcd.com
        //     $message->setBody($email_txt, 'text/html'); // for HTML rich messages
        // });
        // if (Mail::failures()) {
        //     return false;
        // } else {
        //     return true;
        // }





    }

    public function sendSms($number,$sms_text, $user_id=null, $auto_otp = false)
    {
        if($auto_otp){
            $sms_text = "<#> ".$sms_text."\n"."dNR8ajQkRb6";
        }
        if($_SERVER['HTTP_HOST'] == 'elgcd.punjab.gov.pk'){
            $if_disabled = false;
        }else{
            $if_disabled = DB::table("metadata_records")->where("name","disabled_sms")->where("data_text","1")->first();
        }

        $model  = array(
            'phone_no'	=>$number,
            'sms_text'	=>$sms_text,
            'sec_key'	=> '731725782697429f286b5ae13a71be39',
            'sms_language'	=>'english'
            );


        $post_string= http_build_query($model);

        $url='https://smsgateway.pitb.gov.pk/api/send_sms';
        $ch= curl_init();// or die("Cannot init");
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: '.strlen($post_string)) );
        if(!$if_disabled){
            //return false;
            $curl_response= curl_exec($ch);
        }else{
            $curl_response = json_encode(array("status"=>"disabled","message"=>"message are disabled from meta data management"));   
        }
        $gr =$curl_response;
        $res_txt = json_decode($gr);
        if(empty($user_id)){
            $user = auth('api')->User();
            $user_id = 0;
            if(!empty($user)){
                $user_id = $user->id;
            }
        }
        $user = DB::table("sms_logs")->insert(array(
            "user_id"=>$user_id,
            "phone"=>$number,
            "sms_text"=>$sms_text,
            "sms_response"=>json_encode($res_txt),
            "created_at"=>date("Y-m-d H:i:s")
        ));
        // $user->sms_response_text = json_encode($res_txt);
        // $user->save();
        return $res_txt;

    }
}
