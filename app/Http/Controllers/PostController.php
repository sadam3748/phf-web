<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\login;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\validator;


class postcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return "Welcome to post controller";  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function e_billing(){

        return view('e-billing');
    }
    public function fms(){
        return view('fms');
    }
    public function mams(){
        return view('mams');
    }
    public function iams(){
        return view ('iams');
    }
    public function pms(){
        return view ('pms');
    }
    public function show_post($id,$password,$name){
        //return view('post')->with('id',$id , 'password',$password, 'name',$name);
        return view('post',compact('id','name','password'));
    }

    //get logindata
    public function getLoginData(){
        // $loginModel = new login();
        $result = DB::table('lg_login')->get();
       return $result;
    }
    public function getregisterData(){
        $registermodel=new login();
        $result=$registermodel->getregister();
        return response()->json($result);
    }
    public function getHrData(){
        
        $results = DB::table('hr') ->get();
        return response()->json ($results);
       
    }
    public function getContractorData(){
        $contractormodel=new login();
        $result=$contractormodel->getContractor();
        return response()->json($result);
    }
    public function getReportsData(){
        $reportsmodel=new login();
        $result=$reportsmodel->getReports();
        return response()->json($result);
    }


    //add lglogin data
    public function addData(Request $req){
        
         $json = array();
        
         $lgModel=new login();
         $result= $lgModel->AddLgLogin($req->all());
        
         if($result)
         {
            $json['code'] = 1;
            $json['message'] = 'Data Saved Successfully';
         }
         else
         {
            $json['code']=2;
            $json['message']='Pleaes Enter Valid Data';
         }
         
         return response()->json($json);

    }
    
    //add Hr data
    public function addHrData(Request $req){
        $json = array();
        $lgModel1=new login();
        $result=$lgModel1->AddHr($req->all());
      //  dd($result);
      if($result)
      {
        $json['code'] = 1;
        $json['message'] = 'Data Saved Successfully';
      }
      else
      {
        $json['code'] = 2;
        $json['message'] = 'Please Enter Valid Data';
      }
      
      return response()->json($json);

    }
    public function addContractorData(Request $req){
        $contractormodel=new login();
        $result=$contractormodel->AddContractor($req->all());
        return response()->json($result);
    }
    public function addReportsData(Request $req)
    {
        $reportsmodel=new login();
        $result=$reportsmodel->addReports($req->all());
        return response()->json($result);
    }


    //Delete functions
    public function DelLoginData(Request $req){
      
      //echo "delete test";
        $lgModel=new login();
        $id=$req->id;
        $lgModel->deleteData($id);
    }

    public function DelHrData(Request $req){
       // echo "delete test";
        $hrmodel=new login();
        $id=$req->id;
        $del_hrResult=$hrmodel->deleteHr($id);

        if($del_hrResult)
        {
            $json['code']=1;
            $json['message']="Record Deleted Successfully";
        }
        else
        {
        $json['code']=2;
        $json['message']="Error While Delete record";
        }
        return response()->json($json);
    }

    

    public function DelReportsData(Request $req)
    {
      //  echo "Delete Reports";
        $armodel=new login();
        $id=$req->id;
        $del_result= $armodel->deleteReports($id);
        
        
        if($del_result)
        {
            $json['code']=1;
            $json['message']="Record Deleted Successfully";
    
        }
        else
        {
          $json['code'] = 2;
          $json['message'] = "Error!While Deleting Detail";
        }
        return response()->json($json);
      

    }
    public function delContrData(Request $req){
        $contrmodel=new login();
        $id=$req->id;
        $del_result=$contrmodel->delcontractor($id);

        if($del_result)
        {
            $json['code']=1;
            $json['message']="Data Deleted Successfully";
        }
        else
        {
            $json['code']=1;
            $json['message']="Data Deleted Successfully";
        }
        return response()->json($json);

    }

    //editonedata
    public function editonedata(Request $req){
        
        $editmodel=new login();
        $id=$req->id;

        $data=$editmodel->geteditlogin($id);
        return response()->json($data);
    }

    //update controller
    public function updateloginData(Request $req){
        
        $json = array();
        $id=$req->id;
       
        $lgModel=new login();
        $result= $lgModel->updatelogin($id,$req->all());
       
        if($result)
        {
           $json['code'] = 1;
           $json['message'] = 'Data Updated Successfully';
        }
        else
        {
           $json['code']=2;
           $json['message']='Pleaes Enter Valid Data';
        }
        
        return response()->json($json);

   }

    
   
}
