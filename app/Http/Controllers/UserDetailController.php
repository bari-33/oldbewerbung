<?php

namespace App\Http\Controllers;

use App\EmployeeProduct;
use App\Role;
use App\User;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Alert;
class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users=User::orderBy('created_at','Desc')->with('userdetail')->get();

		$all=$users->count();
        $admins=0;
        $clients=0;
        $customers=0;
        $employees=0;

        foreach ($users as $user) {
            if ($user->roles()->first()->slug == "admin") {
                $admins++;
            } else if ($user->roles()->first()->slug == "client") {
                $clients++;

            }
            else if ($user->roles()->first()->slug == "customer") {
                $customers++;

            }
            else if ($user->roles()->first()->slug == "employee") {
                $employees++;

            }

        }


        Session::put('all',$all);
        Session::put('admins',$admins);
        Session::put('clients',$clients);
        Session::put('customers',$customers);
        Session::put('employees',$employees);
         Alert::success('Saved');
        return view('userdetails.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $roles=Role::all();
        return view('userdetails.create',compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'username'=>'required',
            'password'=>'required|confirmed|min:8',
            'email'=>'required|email',
            'first_name'=>'required',
            'role'=>'required',
            'profile_picture'=>'required',
            'telephone'=>'nullable',

            'biographical_information'=>'nullable',
        ]);


        if (UserDetail::where('username', '=', Input::get('username'))->exists() || User::where('email', '=', Input::get('email'))->exists())
        {
           
        }
        else {

            $userdetail = new User();
            $userdetail->name = $request->get('first_name') . ' ' . $request->get('last_name');
            $userdetail->email = $request->get('email');
            $userdetail->password = Hash::make($request->get('password'));
            $userdetail->save();
            $userdetail->roles()->attach($request->get('role'));


            $userDetail = new UserDetail();
            $userDetail->user_id = $userdetail->id;
            $userDetail->username = $request->get('username');
            $userDetail->first_name = $request->get('first_name');
            $userDetail->last_name = $request->get('last_name');
            $userDetail->telephone = $request->get('telephone');
            $userDetail->website = $request->get('website');
            $userDetail->facebook = $request->get('facebook');
            $userDetail->instagram = $request->get('instagram');
            $userDetail->deutch = $request->get('deutch');
            $userDetail->english = $request->get('english');
            $userDetail->spanish = $request->get('spanish');
            $userDetail->french = $request->get('french');
            $userDetail->web_designer = $request->get('web_designer');
            $userDetail->graphic_designer = $request->get('graphic_designer');
            $userDetail->media_designer = $request->get('media_designer');
            $userDetail->biographical_information = $request->get('biographical_information');

            $profile_picture = "";
            if ($request->hasFile('profile_picture')) {
                $image = $request->profile_picture;
                $ext = $image->getClientOriginalExtension();
                $filename = uniqid() . '.' . $ext;
                $image->move('public/img/profiles', $filename);
                $profile_picture = $filename;


            }

            $userdetail->profile_picture = $profile_picture;

            /*if($request->get('role')==="2")
            {
                $userdetail->billing=$request->get('billing');
                $userdetail->amount=$request->get('amount');
            }*/

            $userDetail->save();
            $userdetail->save();



            return redirect(url('/userdetails'));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function show(User $userdetail)
    {
        return view('userdetails.show',compact('userdetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(User $userdetail)
    {
        $user=$userdetail;
        $string=explode(" ",$user->name);
        $first_name=$string[0];
        $last_name="";
        if (isset($string[1])) {
            $last_name = $string[1];
        }
        Session::put('email',$user->email);
        $roles=Role::all();

        return view('userdetails.edit',compact('user','first_name','last_name','roles'));
    }

    public function editClient(User $client)
    {
        $string=explode(" ",$client->name);
        $first_name=$string[0];
        $last_name="";
        if (isset($string[1])) {
            $last_name = $string[1];
        }
        Session::put('email',$client->email);

        return view('userdetails.editclient', compact('client','first_name','last_name'));
    }

    public function updateClient(Request $request, User $client)
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


            return redirect(url('/userdetails'));


        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $userdetail)
    {

        $request->validate([
            'username'=>'required',
            'password'=>'nullable|confirmed|min:8',
            'email'=>'required|email',
            'first_name'=>'required',
            'telephone'=>'nullable',
            'biographical_information'=>'nullable',
        ]);



        if (User::where('email', '=', Input::get('email'))->exists()&&(session('email')!=$request->get('email')))
        {

        }
        else {
            $userdetail->name = $request->get('first_name') . ' ' . $request->get('last_name');
            $userdetail->email = $request->get('email');
            if (!empty($request->get('password')))
            {
                $userdetail->password = Hash::make($request->get('password'));
            }
           $userdetail->roles()->sync($request->get('role'));



            $profile_picture = "";
            if ($request->hasFile('profile_picture')) {

                //checking if already profile picture exists
                if (!empty($userdetail->profile_picture)&&$userdetail->profile_picture!="profile.png")
                {
                    $path = public_path()."/img/profiles/".$userdetail->profile_picture;
                    unlink($path);
                }
                $image = $request->profile_picture;
                $ext = $image->getClientOriginalExtension();
                $filename = uniqid() . '.' . $ext;
                $image->move('public/img/profiles', $filename);
                $profile_picture = $filename;


            }
            else
            {
                $profile_picture=$userdetail->profile_picture;
            }

            $userdetail->profile_picture=$profile_picture;


            $userdetail->userdetail()->update([
                "first_name" => $request->get('first_name'),
                "last_name" => $request->get('last_name'),
                "telephone" => $request->get('telephone'),
                "website" => $request->get('website'),
                "facebook" => $request->get('facebook'),
                "instagram" => $request->get('instagram'),
                "biographical_information" => $request->get('biographical_information'),
                "deutch" => $request->get('deutch'),
                "english" => $request->get('english'),
                "spanish" => $request->get('spanish'),
                "french" => $request->get('french'),
                "web_designer" => $request->get('web_designer'),
                "graphic_designer" => $request->get('graphic_designer'),
                "media_designer" => $request->get('media_designer'),

                "company" => $request->get('company'),
                "street_no" => $request->get('street_no'),
                "house_no" => $request->get('house_no'),
                "additional_info" => $request->get('additional_info'),
                "zip_code" => $request->get('zip_code'),

                "city" => $request->get('city'),
                "country" => $request->get('country'),

                "bank_name" => $request->get('bank_name'),
                "iban" => $request->get('iban'),
                "bc" => $request->get('bc'),
                "paypal" => $request->get('paypal'),


                'billing'=> $request->get('billing'),
                'amount'=> $request->get('amount'),
            ]);

            $userdetail->save();

            EmployeeProduct::where('user_detail_id',$userdetail->userdetail->id)->delete();

            if($request->get('role')==="2")
            {
                if(!empty($request->get('resume'))) {
                    $employeeproduct = new EmployeeProduct();
                    $employeeproduct->product = $request->get('resume');
                    $employeeproduct->user_detail_id=$userdetail->userdetail->id;
                    $employeeproduct->save();
                }
                if(!empty($request->get('website'))) {
                    $employeeproduct = new EmployeeProduct();
                    $employeeproduct->product = $request->get('website');
                    $employeeproduct->user_detail_id=$userdetail->userdetail->id;
                    $employeeproduct->save();
                }
                if(!empty($request->get('package'))) {
                    $employeeproduct = new EmployeeProduct();
                    $employeeproduct->product = $request->get('package');
                    $employeeproduct->user_detail_id=$userdetail->userdetail->id;
                    $employeeproduct->save();
                }
            }

                return redirect(url('/userdetails'));





        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $userdetail)
    {


    }

    public function delete($id){
        User::where('id',$id)->delete();
        UserDetail::where('user_id',$id)->delete();
        return redirect(url('/userdetails'));
    }




// Custom function defined for showing limited data on the index page

    public function search(Request $request)
    {

        switch ($request->input('action'))
        {

            case 'all':
                $users=User::orderBy('created_at','Desc')->get();
                break;
            case 'admins':
                $users = User::whereHas('roles', function($q){

                    $q->where('id', 1); //this refers id field from categories table

                })->orderBy('created_at','Desc')->get();


                break;
            case 'employees':
                $users = User::whereHas('roles', function($q){

                    $q->where('id', 2);

                })->orderBy('created_at','Desc')->get();
                break;
            case 'customers':
                $users = User::whereHas('roles', function($q){

                    $q->where('id', 3); //this refers id field from categories table

                })->orderBy('created_at','Desc')->get();
                break;

            case 'deleted':
                break;


        }
        return view('userdetails.index',compact('users'));


    }

}
