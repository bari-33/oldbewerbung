<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $client)
    {
        $string=explode(" ",$client->name);
        $first_name=$string[0];
        $last_name="";
        if (isset($string[1])) {
            $last_name = $string[1];
        }
        Session::put('email',$client->email);

        return view('clients.edit', compact('client','first_name','last_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $client)
    {




        $request->validate([
            'nickname'=>'required',
            'password'=>'nullable|confirmed|min:8',
            'email'=>'required|email',
            'first_name'=>'required',
            'last_name'=>'nullable',
            'street_no'=>'required',
            'house_no'=>'required',
            'zip_code'=>'required',
            'city'=>'required',
            'country'=>'required',
        ]);


        if (User::where('email', '=', Input::get('email'))->exists() && (session('email') != $request->get('email'))) {


        } else {
            $client->name = $request->get('first_name') . ' ' . $request->get('last_name');
            $client->email = $request->get('email');
            if (!empty($request->get('password'))) {

                $client->password = Hash::make($request->get('password'));
            }


            $profile_picture = "";
            if ($request->hasFile('profile_picture')) {

                //checking if already profile picture exists
                if (!empty($client->profile_picture)&&$client->profile_picture!="profile.png")
                {
                    $path = public_path()."/img/profiles/".$client->profile_picture;
                    unlink($path);
                }
                $image = $request->profile_picture;
                $ext = $image->getClientOriginalExtension();
                $filename = uniqid() . '.' . $ext;
                $image->move('public/img/profiles', $filename);
                $profile_picture = $filename;

                $client->profile_picture=$profile_picture;

               $client->clientdetail()->update([
                   'nickname'=>$request->nickname,
                   'first_name'=>$request->first_name,
                   'last_name'=>$request->last_name,
                   'mobile'=>$request->mobile,
                   'street_no'=>$request->street_no,
                   'house_no'=>$request->house_no,
                   'zip_code'=>$request->zip_code,
                   'city'=>$request->city,
                   'additional_info'=>$request->additional_info,
                   'country'=>$request->country,
                   'website'=>$request->website,
                   'xing'=>$request->xing,
                   'facebook'=>$request->facebook,
                   'linkedin'=>$request->linkedin,
                   'twitter'=>$request->twitter,
                   'other'=>$request->other,

               ]);

            }
            else {
                $client->clientdetail()->update([
                    'nickname'=>$request->nickname,
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'mobile'=>$request->mobile,
                    'street_no'=>$request->street_no,
                    'house_no'=>$request->house_no,
                    'zip_code'=>$request->zip_code,
                    'city'=>$request->city,
                    'additional_info'=>$request->additional_info,
                    'country'=>$request->country,
                    'website'=>$request->website,
                    'xing'=>$request->xing,
                    'facebook'=>$request->facebook,
                    'linkedin'=>$request->linkedin,
                    'twitter'=>$request->twitter,
                    'other'=>$request->other,

                ]);
            }


            $client->save();

            $order= $client->orders()->orderBy('created_at','desc')->first();

            return redirect(url('/orders/current/'.$order->id));


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $client)
    {
        $client->clientdetail()->delete();
        $client->delete();
        Auth::logout();
        return redirect('/login');
    }

}
