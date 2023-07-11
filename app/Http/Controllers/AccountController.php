<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //main page
    public function accountMainPage($id){
        $data = Auth::user()->where('id', $id)->where('role', 'admin')->first();
        return view('adminuser.account.account_main', compact('data'));
    }

    //edit Page
    public function accountEditPage($id){
        $data = Auth::user()->where('id', $id)->where('role', 'admin')->first();
        return view('adminuser.account.account_edit', compact('data'));
    }

    //edit
    public function EditData(Request $request){
        // dd($request->toArray());

        $this->requestValidateData($request);
        $data = $this->requestUserData($request);

        if ($request->hasFile('myphoto')) {
            $dbImage = Auth::user()->where('role', 'admin')->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete(['public/' . $dbImage]);
            }

            $fileName = uniqid() . $request->file('myphoto')->getClientOriginalName();
            $request->file('myphoto')->storeAs('public/' , $fileName);
            $data['image'] = $fileName;
        }

        $fileName = uniqid() . $request->file('myphoto')->getClientOriginalName();
        $request->file('myphoto')->storeAs('public/' , $fileName);
        $data['image'] = $fileName;

        Auth::user()->where('id', $request->userId)->where('role', 'admin')->update($data);

        return redirect()->route('account#main', $request->userId);
    }

    //setting
    public function SettingPage($id){
        return view('adminuser.account.account_setting');
    }

    //changePassowrd
    public function ChangePassword(Request $request){
        // dd($request->all());
        $this->validatePasswordData($request);

        $dbpass = Auth::user()->select('password')->where('id', Auth::user()->id)->first();
        // $hashpass = Hash::make('asdf654!@');
        if (Hash::check($request->oldpassword, $dbpass->password)) {
            // dd('true');
            $data = [
                'password' =>Hash::make($request->newpassword)
            ];
            // dd($data);
            Auth::user()->where('id', Auth::user()->id)->update($data);
        }
        return back()->with(['success'=>'your account password is successfully changed!']);
    }



    //request data
    private function requestValidateData(Request $request){
        $validateRule =
        [
            'name' =>'required|min:6',
            'email' => 'required',
            'phone' => 'required|min:11',
            'myphoto' => 'required|mimes:png,jpg,jpeg,webp|file',
            'address' =>'required',
            'gender' => 'required'
        ];

        Validator::make($request->all(), $validateRule)->validate();
    }

    //request user data
    private function requestUserData(Request $request){
        return[
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender
        ];
    }

    //validate password
    private function validatePasswordData($request){
        $validateRule = [
            'oldpassword' => 'required|min:6',
            'newpassword' =>'required|min:6',
            'confirmpassword' =>'required|min:6|same:newpassword'
        ];

        Validator::make($request->all(), $validateRule)->validate();
    }
}
