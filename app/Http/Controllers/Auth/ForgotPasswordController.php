<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use DB;
use Hash;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function forgotpassword()
    {
        return view('frontend.pages.auth.forgotpassword');
        //echo 'dddd';
    }
    public function checkuser(Request $request){
        
        $this->validate($request, [
        'username'        => 'required'
      ]);
     
      if (preg_replace('/[^0-9]/', '', $request->username) == $request->username) {
          $user = DB::table('users')->where('mobile',$request->username)->first();
        //Attempt to log the employee in
        if($user){
            //if (Auth::guard()->attempt(['mobile' => $request->username,'status' => 1])) {
            //return redirect()->intended(route('index'));
            session()->flash('token', request()->_token);
				    return redirect(route('passwordchange'))->withInput();
            
        }
      } else {
        //dd($request);
        //Attempt to log the employee in
         $user = DB::table('users')->where('username',$request->username)->first();
         if($user){
        //if (Auth::guard()->attempt(['username' => $request->username, 'status' => 1])) {
            session()->flash('token', request()->_token);
				return redirect(route('passwordchange'))->withInput();
          
        }
      }
      //If unsuccessfull, then redirect to the admin login with the data
      session()->flash('login_error', "Invalid Username or Mobile / Password");
      return redirect()->back()->withInput($request->only('username', 'remember'));
    }

    public function chanpass(){
      return view('frontend.pages.auth.changepassword');
    }
    
    public function changepassword(Request $request){
      //dd($request);
      $valid = request()->validate([
        'password'=>'required|min:6',
        'confirm_password'=>'required|min:6|same:password|min:6'
      ]);
      
      $result = DB::table('users')
        ->where('username',$request->username)
        ->update([
          'password'=> Hash::make($request->password)
        ]);
        session()->flash('success_message', 'Password Changed Successfully...');
        return redirect('/login');

      //dd($request);
    }
}
