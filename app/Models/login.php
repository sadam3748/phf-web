<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class login extends Model
{

    // protected $primaryKey = 'LG_ID';

    use HasFactory;
    public function getlogin(){
        //return "welcome to login data";
        $result = DB::table('lg_login')->get('name','email','Password');
        return $result;
    }

    public function getregister(){
        $result=DB::table('users')->get();
        return $result;
    }

    public function getHr()
    {
        //for testing purporse call login DB
        
       
    }
    public function getContractor(){
        $result=DB::table('contractor')->get();
        return $result;
    }
    public function getReports(){
        $result=DB::table('reports')->get();
        return $result;
    }

    //add data functions
    public function AddLgLogin($data)
    {
        //for testing purporse call login DB
        $result = DB::table('lg_login')->insert($data);
        return $result;
       
    }

    public function AddHr($data)
    {
        $result=DB::table('hr')->insert($data);
        return $result; 
    }
    public function AddContractor($data)
    {
        $result=DB::table('contractor')->insert($data);
        return $result;
    }
    public function addReports($data)
    {
        $result=DB::table('reports')->insert($data);
        return $result;
    }



    //Delete Function

    public function deleteData($id)
    {
        $result=DB::table('lg_login')->where('id',$id )->delete();
        return $result;
    }

    public function deleteHr($id)
    {
        $result= DB::table('hr')->where('id',$id)->delete();
        return $result;
    }
    public function deleteReports($id)
    {
       $result= DB::table('reports')->where('id',$id)->delete();
       return $result;
    }
    public function delcontractor($id)
    {
        $result=DB::table('contractor')->where('id',$id)->delete();
        return $result; 
    }



    //Edit function
    public function geteditlogin($id){
        //return "welcome to login data";
        $result = DB::table('lg_login')->select('name','email','Password','id')->where('id',$id)->get()->first();
        return $result;
    }
    //update student
    public function updatelogin($id,$data)
    {
        //for testing purporse call login DB
        $result = DB::table('lg_login')->where('id',$id)->update($data);
        return $result;
       
    }
}
