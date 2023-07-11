<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetpasswordController extends Controller
{

        //reset password
        public function ForgetPasswordPage($id){
            return view('adminuser.account.forgot-password');
        }

        //password forget
        public function PasswordForget(Request $request){
            // dd($request->email);
            $request->validate(['email'=>'required|email|exists:users']);
            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
              ]);

            Mail::send('adminuser.account.email.forgot-password', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            return back()->with('message', 'We have e-mailed your password reset link!');
        }

        //passowrd forget page
        public function resetPasswordGetPage($token){
            // dd($token);
            return view('adminuser.account.email.forgetPasswordLink', ['token' => $token]);
        }

        //password reset form
        public function submitPasswordForm(Request $request){
            // dd($request->all());
            $this->requestPasswordValidate($request);
            $updatePassword = DB::table('password_resets')
            ->where([
              'email' => $request->email,
              'token' => $request->token
            ])
            ->first();
            // dd($updatePassword);
            if (!$updatePassword) {
                return back()->withInput()->with('error', 'Invalid Token');
            }

            $status = User::where( 'email', $request->email)
                            ->update(['password'=>Hash::make($request->password)]);

            // dd($user);
            // $oldPass = User::where('email', $request->email)->get();
            // dd($oldPass->toArray());

            DB::table('password_resets')->where(['email'=> $request->email])->delete();
            // dd('done');

            return $status === true ? redirect()->route('Auth#login') : back();

        }

        //requestvalidatedata
        private function requestPasswordValidate(Request $request){
            $request->validate([
                'email' => 'required|email|exists:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required'
            ]);
        }

}
