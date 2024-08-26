<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\User;

class AuthController extends Controller {

    /**
     * Display login of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function login(){
        $title = "Login";
        $description = "Some description for the page";
        return view('auth.login',compact('title','description'));
    }

    /**
     * Display register of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function register(){
        $title = "Register";
        $description = "Some description for the page";
        return view('auth.register',compact('title','description'));
    }

    /**
     * Display forget password of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function forgetPassword(){
        $title = "Forget Password";
        $description = "Some description for the page";
        return view('auth.forget_password',compact('title','description'));
    }

    /**
     * make the user able to register
     *
     * @return
     */
    public function signup(Request $request){
        $validators=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'password_confirmation'=>'required|same:password'
        ]);
        if($validators->fails()){
            return redirect()->route('register')->withErrors($validators)->withInput();
        }else{
            if($request->password == $request->password_confirmation){
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->type = 0;
                $user->save();
                auth()->login($user);
            }

            return redirect()->intended(route('dashboard.demo_one','en'))->with('message','Registration was successfull !');
        }
    }

    /**
     * make the user able to login
     *
     * @return
     */
    public function authenticate(Request $request){
        $validators=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validators->fails()){
            return redirect()->route('login')->withErrors($validators)->withInput();
        }else{
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'type'=>0])){
                return redirect()->intended(route('dashboard.demo_one','en'))->with('message','Welcome back !');
            }else{
                return redirect()->route('login')->with('message','Login failed !Email/Password is incorrect !');
            }
        }
    }

    /**
     * make the user able to logout
     *
     * @return
     */
    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('message','Successfully Logged out !');
    }
}
