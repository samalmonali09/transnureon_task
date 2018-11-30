<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{


    private static $_instance = null;
    protected $table = 'admin';

    public static function getInstance()
    {
        if (!is_object(self::$_instance))  //or if( is_null(self::$_instance) ) or if( self::$_instance == null )
            self::$_instance = new Admin();
        return self::$_instance;
    }

    public function insert($data)
    {
        $id = DB::table('users')->insertGetId($data);
        return DB::table('users')->where('id', $id)->update(['reqId' => $id]);
    }

    public function insertReq($data)
    {
        $fetch = DB::table('friendreq')
            ->where(['fromId' => $data['fromId'], 'toId' => $data['toId']])->first();
        if ($fetch) {
            return 0;
        } else {
            return DB::table('friendreq')->insertGetId($data);
        }


    }

    public function searchData($data, $str)
    {

//        dd($str);
        $str1 = '[' . $str . ']';


        $test = explode(",", $str);
        $test2 = [];
        foreach ($test as $val) array_push($test2, (int)$val);
        $like = $data . '%';

        $demo = DB::table('users')
            ->where('name', 'like', $like)
            ->whereNotIn('id', $test2)
            ->paginate(5);
            return $demo;

    }

    public function fetchuser()
    {
        $data = Auth::user()->id;
        $fetch = DB::table('users')
            ->where(['id' => $data])->first();
        return $fetch;
    }

    public function frindDetails($id)
    {

        $users = DB::table('users')
            ->whereIn('id', $id)
            ->paginate(5);
        return $users;

    }




    public function frindlist($data)
    {
//        $fetch = DB::table('friendreq')
//            ->where('fromId', $data['fromId'])
//            ->orWhere('toId', $data['fromId'])
//            ->where('status', 1)
//            ->get();

        $fetch = DB::select('SELECT * FROM `friendreq` WHERE (fromId=' . $data['fromId'] . ' or toId=' . $data['fromId'] . ') and status =1 ');

//dd($fetch);


        return $fetch;
    }

    public function RequestList($data)
    {
//        $fetch = DB::table('friendreq')
//            ->where('fromId', $data['fromId'])
//            ->where('status', 0)
//            ->where('toId', $data['fromId'])
//            ->get();

//        $fetch = DB::select('SELECT * FROM `friendreq` WHERE (fromId=' . $data['fromId'] . ' or toId=' . $data['fromId'] . ') and status =0 ');
        $fetch = DB::select('SELECT * FROM `friendreq` WHERE (fromId=' . $data['fromId'] . ') and status =0 ');

//        dd($fetch);
        return $fetch;
    }

    public function profileUser($data)
    {
        $fetch = DB::table('users')
            ->where(['id' => $data])->first();
        return $fetch;
    }

    public function mutualfriend($data)
    {
        $fetch = DB::table('friendreq')
            ->where('fromId', $data)
            ->where('status', 1)
            ->orWhere('toId', $data)
            ->get();
        return $fetch;
    }

    public function FullDetails($data)
    {
        $users = DB::table('users')
            ->whereIn('id', $data)->paginate(5);
        return $users;
    }

    public function Mutualdata()
    {
        $data = Auth::user()->id;
        $fetch = DB::table('friendreq')
            ->where('fromId', $data)
            ->where('status', 1)
            ->orWhere('toId', $data)
            ->get();
        return $fetch;

    }

    public function checkLogin($data)
    {
        return DB::table('details')
            ->where('email', $data['email'])
            ->where('password', $data['password'])
            ->first();
    }

    public function fetchqueryUsers()
    {
        $data = Auth::user()->id;
        return DB::table('users')
            ->where('id', $data)->first();
    }

    public function updatedata($qData)
    {
        $id = Auth::user()->id;
        return DB::table('users')
            ->where('id', $id)
            ->update(['reqId' => $qData]);
    }

    public function pendingData()
    {
        $data = Auth::user()->id;
        $fetch = DB::table('friendreq')
            ->where('toId', $data)
            ->where('status', 0)
            ->get();
        return $fetch;
    }

    public function confirmRequest($id)
    {
        $data = Auth::user()->id;
        return DB::table('friendreq')
            ->where('fromId', $id)
            ->where('toId', $data)
            ->update(['status' => 1]);


    }

}
