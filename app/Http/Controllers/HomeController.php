<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }



    public function test_email(){
        

                    // return redirect()->back();
                    $data = ['username'=>'a','email'=>'a@a.com','password'=>'123456','uid'=>'7859b164bbaef3b2139c1ef0d720b812'];
                    $email = 'mohammad.arbaz001@yahoo.com';
                    if(Mail::send('mail.login_credentials',['data'=>$data],function($mail) use ($email){
                        $mail->to($email,'SAFE User')->from("no-reply@safepk.com")->subject("SAFE Account Credentials");
                    })){

                    }else{
                        dd(Mail::failures());
                    }

        dd('a');
    }

}
