<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    /**
     * @Desc:
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @since 29/10/2018
     */
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('Admin::login');
        } else {
            $userData = $request->all();
            $validationResponse = Validator::make($userData, [
                'email' => 'required',
                'password' => 'required'
            ]);
            if ($validationResponse->fails()) {
                return Redirect::back()->withErrors($validationResponse)->withInput($request->input());
            } else {

                $data = [];
                $data['email'] = $userData['email'];
                $data['password'] = $userData['password'];

                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    return redirect('/dashboard');
                } else {
                    return Redirect::back()->with('msg', 'Failed to login');
                }

            }

        }
    }

    /**
     * @Desc:
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @since 29/10/2018
     */
    public function Register(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('Admin::reg');
        } else {
            $userData = $request->all();
            $validationResponse = Validator::make($userData, [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);
            if ($validationResponse->fails()) {
                return Redirect::back()->withErrors($validationResponse)->withInput($request->input());
            } else {

                $data = [];
                $data['name'] = $userData['name'];
                $data['email'] = $userData['email'];
                $data['password'] = Hash::make($userData['password']);
                $obj = new Admin();
                $res = $obj->insert($data);
                if ($res) {
                    return view('Admin::login', ['data' => 'Registration Successful Please Login To Continue']);
                } else {
                    return \redirect()->back()->with('msg', 'Problem Occured Try Again..!!');
                }
            }

        }
    }

    /**
     * @Desc:
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 29/10/2018
     */
    public function Dashboard(Request $request)
    {

        return view('Admin::dashboard');
    }

    public function Search(Request $request)
    {

        $userData = $request->all();
        $validationResponse = Validator::make($userData, [
            'name' => 'required'
        ]);
        if ($validationResponse->fails()) {
            return \redirect()->back()->with('emsg', 'Please enter valid characters..!!');
        }
        $name = $request->all()['name'];
        Session::put('name', $name);
        $obj = new Admin();
        $fetchdata = $obj->fetchuser();
        $str = $fetchdata->reqId;

        $res = $obj->searchData($name, $str);
        $res1 = json_decode(json_encode($res, true), true);
        if (count($res1) > 0) {
            Session::put('name', $request->all()['name']);
            return redirect('/sugList');
        } else {
            return \redirect()->back()->with('msg', 'No such friends found..!!');
        }
    }

    public function SugList(Request $request)
    {
        $obj = new Admin();
        $fetchdata = $obj->fetchuser();
        $str = $fetchdata->reqId;
        $name = Session::get('name');
        $res = $obj->searchData($name, $str);
        return view('Admin::viewTable', ['userData' => $res]);
    }

    /**
     * @Desc:
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @since 29/10/2018
     */
    public function SendReq(Request $request, $id)
    {

        $userId = Auth::user()->id;
        $frndId = $id;
        $obj = new Admin();
        $data = array();
        $data['fromId'] = $userId;
        $data['toId'] = $frndId;
        $data['status'] = 0;
        $res = $obj->insertReq($data);
        if ($res == 0) {
            return redirect('/dashboard')->with('smsg', 'Friend Request Already Send .');
        }
        $fetch = $obj->fetchqueryUsers();
        $prvReq = $fetch->reqId . ',' . $frndId;
        if ($res) {
            $res1 = $obj->updatedata($prvReq);
            return redirect('/dashboard')->with('smsg', 'Friend Request Send Sucessfully.');
        } else {
            return redirect('/dashboard')->with('msg', 'Failed.');

        }
    }

    /**
     * @Desc:home
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 29/10/2018
     */
    public function home(Request $request)
    {

        if ($request->isMethod('get')) {
            if (Session::get('admin')) {
                $result = Session::get('admin');
                return view('Admin::home', ['result' => $result]);
            }
            return view('Admin::home');
        } else {
            dd($request->all(), 'mona');
        }
    }

    /**
     * @Desc:logout
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @since 29/10/2018
     */
    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/login');
    }

    /**
     * @Desc:viewTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 29/10/2018
     */
    public function viewTable()
    {
        $obj = Admin::getInstance();
        $result = $obj->viewTable();
        return view('Admin::viewTable', ['userData' => $result]);
    }

    /**
     * @Desc:friendList
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 29/10/2018
     */
    public function friendList(Request $request)
    {

        $data = array();
        $data['fromId'] = Auth::user()->id;
        $obj = new Admin();
        $result = $obj->frindlist($data);
        $result1 = json_decode(json_encode($result, true), true);
        $id = array();

        foreach ($result1 as $key) {

            if ($key['fromId'] == Auth::user()->id) {
                $id[] = $key['toId'];
            } else {
                $id[] = $key['fromId'];
            }
        }
        $result = $obj->frindDetails($id);
        return view('Admin::frindList', ['userData' => $result]);
    }

    /**
     * @Desc:requestData
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 29/10/2018
     */
    public function requestData(Request $request)
    {
        $data = array();
        $data['fromId'] = Auth::user()->id;
        $obj = new Admin();
        $result = $obj->RequestList($data);
        $result1 = json_decode(json_encode($result, true), true);

        $id = array();

        foreach ($result1 as $key) {
            if ($key['fromId'] == Auth::user()->id) {
                $id[] = $key['toId'];
            } else {
                $id[] = $key['fromId'];
            }
        }
        $result = $obj->frindDetails($id);
        return view('Admin::RequestList', ['userData' => $result]);
    }

    /**
     * @Desc:profile
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 29/10/2018
     */
    public function profile(Request $request, $id)
    {
        $obj = new Admin();
        $profile = $obj->profileUser($id);
        $profile1 = json_decode(json_encode($profile, true), true);
        return view('Admin::profile', ['userData' => $profile1]);


    }

    /**
     * @Desc:Mutual
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 29/10/2018
     */
    public function Mutual(Request $request, $id)
    {
        $obj = new Admin();
        $mutual1 = $obj->mutualfriend($id);
        $mutual = json_decode(json_encode($mutual1, true), true);
        $mutual2 = $obj->Mutualdata();
        $mutual3 = json_decode(json_encode($mutual2, true), true);
        $id1 = array();
        $id2 = array();

        foreach ($mutual as $key) {
            if ($key['fromId'] == $id) {
                $id1[] = $key['toId'];
            } else {
                $id1[] = $key['fromId'];
            }
        }
        foreach ($mutual3 as $key) {
            if ($key['fromId'] == Auth::user()->id) {
                $id2[] = $key['toId'];
            } else {
                $id2[] = $key['fromId'];
            }
        }
        $result = array_intersect($id1, $id2);
        $result = array_values($result);
        $data = $obj->FullDetails($result);
        return view('Admin::mutual', ['userData' => $data]);


    }

    /**
     * @Desc:pendingData
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since 29/10/2018
     */
    public function pendingData(Request $request)
    {
        $object = new Admin();
        $result = $object->pendingData();
        $result1 = json_decode(json_encode($result, true), true);
        $dataId = array();
        foreach ($result1 as $key) {
            $dataId[] = $key['fromId'];
        }
        $res = $object->FullDetails($dataId);
        return view('Admin::pending', ['userData' => $res]);


    }

    /**
     * @Desc:conformPending
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @since 29/10/2018
     */
    public function conformPending(Request $request, $id)
    {

        $object = new Admin();
        $result = $object->confirmRequest($id);

        return redirect('/dashboard')->with('smsg', 'Friend Request confirmed Sucessfully.');


    }


}
