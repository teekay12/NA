<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Sentinel;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'companys';

    protected $fillable = [
        'name',
        'email',
        'location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAllCompany(){
        $company = DB::table('companys as c')
                        ->where('c.deleted_at', NULL)
                        ->get();
        return  $company;
    }

    public function getCompany($id){
        $company = DB::table('companys as c')
                        ->where([
                            ['c.id', $id],
                            ['c.deleted_at', NULL]
                        ])
                        ->first();
        return  $company;
    }
}
