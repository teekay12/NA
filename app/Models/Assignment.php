<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Sentinel;

class Assignment extends Model
{
    use HasFactory;

    public $search;

    public function getCompanyList(){
        $user = Sentinel::getUser();
        $company = DB::table('companys as c')
                        ->join('profiles as p', 'p.user_id', '=', 'c.user_id')
                        ->where([
                            ['c.user_id', $user->id],
                            ['p.deleted_at', NULL],
                            ['c.deleted_at', NULL],
                        ])
                        ->select('c.id as cid', 'p.id as pid', 'p.user_id as uid', 'c.name as co_name','c.email as co_email','c.location as co_loc')
                        ->orderby('c.id', 'desc')
                        ->get();
        return  $company;
    }

    public function getCompanySearch($id){
        $this->search = $id;
        $company = DB::table('companys as c')
                        ->join('profiles as p', 'p.user_id', '=', 'c.user_id')
                        ->where([
                            ['p.deleted_at', NULL],
                            ['c.deleted_at', NULL],
                        ])
                        ->where(function($query) {
                            $query->where('c.name', 'like', '%'. $this->search.'%')
                                  ->orWhere('c.location', 'like', '%'.$this->search.'%');
                        })
                        ->select('c.id as cid', 'p.id as pid', 'p.user_id as uid', 'c.name as co_name','c.email as co_email','c.location as co_loc')
                        ->orderby('c.id', 'desc')
                        ->get();
        return  $company;
    }


    public function getCompanybyid($id){
        $this->search = $id;
        $company = DB::table('companys as c')
                        ->join('profiles as p', 'p.user_id', '=', 'c.user_id')
                        ->where([
                            ['c.id', $id],
                            ['p.deleted_at', NULL],
                            ['c.deleted_at', NULL],
                        ])
                        ->select('c.id as cid', 'p.id as pid', 'p.user_id as uid', 'c.name as co_name','c.email as co_email','c.location as co_loc')
                        ->first();
        return  $company;
    }

    public static function userCompanyCount($userid){
        $result = DB::table('companys as c')
                        ->where([
                            ['c.user_id', $userid],
                            ['c.deleted_at', NULL]
                        ])
                        ->count();
        return  $result;
    }

    public static function userCompanyCheck($userid, $company_id){
        $result = DB::table('companys as c')
                        ->where([
                            ['c.user_id', $userid],
                            ['c.id', $company_id],
                            ['c.deleted_at', NULL]
                        ])
                        ->count();
        return  $result;
    }

    public static function userCompanyifexist($company_id){
        $result = DB::table('companys as c')
                        ->where([
                            ['c.id', $company_id],
                        ])
                        ->count();
        return  $result;
    }

    public static function userCompanyDeleted($userid, $email){
        $result = DB::table('companys as c')
                        ->where([
                            ['c.user_id', $userid],
                            ['c.email', $email],
                            ['c.deleted_at','<>', NULL]
                        ])
                        ->count();
        return  $result;
    }

    public static function userCompanyDelete($userid, $company_id){
        $result = DB::table('companys as c')
                        ->where([
                            ['c.user_id', $userid],
                            ['c.id', $company_id],
                        ])
                        ->update(['c.deleted_at' => NOW()]);
        return  $result;
    }

    public static function restoreCompany($userid, $email, $name, $location){
        $result = DB::table('companys as c')
                        ->where([
                            ['c.user_id', $userid],
                            ['c.email', $email],
                        ])
                        ->update(['c.deleted_at' => NULL, 'c.name'=>$name, 'c.location'=>$location]);
        return  $result;
    }
}
