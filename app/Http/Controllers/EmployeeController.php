<?php

namespace App\Http\Controllers;

use App\Design;
use App\Order;
use App\Product;
use App\User;
use App\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::find(Auth::user()->id);
        $string=explode(" ",$user->name);
        $first_name=$string[0];
        $last_name="";
        if (isset($string[1])) {
            $last_name = $string[1];
        }
         Session::put('email',$user->email);
       // $roles=Role::all();
        return view('employees.profile',compact('user','first_name','last_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'nullable|confirmed|min:8',
            'email' => 'required|email',
            'first_name' => 'required',
            'telephone' => 'nullable',
            'biographical_information' => 'nullable',
        ]);

        $userdetail = User::find($id);

        if (User::where('email', '=', Input::get('email'))->exists() && (session('email') != $request->get('email'))) {

        } else {
            $userdetail->name = $request->get('first_name') . ' ' . $request->get('last_name');
            $userdetail->email = $request->get('email');
            if (!empty($request->get('password'))) {
                $userdetail->password = Hash::make($request->get('password'));
            }


            $profile_picture = "";
            if ($request->hasFile('profile_picture')) {

                //checking if already profile picture exists
                if (!empty($userdetail->profile_picture)&&$userdetail->profile_picture!="profile.png") {
                    $path = public_path() . "/img/profiles/" . $userdetail->profile_picture;
                    unlink($path);
                }
                $image = $request->profile_picture;
                $ext = $image->getClientOriginalExtension();
                $filename = uniqid() . '.' . $ext;
                $image->move('public/img/profiles', $filename);
                $profile_picture = $filename;


            } else {
                $profile_picture = $userdetail->profile_picture;
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

            ]);

            $userdetail->save();


            return redirect(url('employees_dashboard'));


        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function editOrder($id){
        $order=Order::find($id);

        $product=Product::find($order->product_id);
        $design=Design::find($order->design_id);
        $website=Website::find($order->website_id);

        /* $tax_product=explode("% ",$product->tax_class);
         $tax_design=explode("% ",$design->tax_class);
         $tax_website=explode("% ",$website->tax_class); */

        $vat['complete_application']=str_replace('.',',',number_format(((float)str_replace(',','.',$product->regular_price)*0.19),2));
        $vat['application_homepage']=str_replace('.',',',number_format(((float)str_replace(',','.',$website->regular_price)*0.19),2));
        $vat['design']=str_replace('.',',',number_format(((float)str_replace(',','.',$design->regular_price)*0.19),2));
        $vat['express_processing']=str_replace('.',',',number_format(((float)str_replace(',','.',$order->express)*0.19),2));
        $vat['total']=str_replace('.',',',number_format(((float)str_replace(',','.',$order->total_price)*0.19),2));
        $vat['product_price']=$product->regular_price;
        $vat['website_price']=$product->regular_price;
        $vat['design_price']=$product->regular_price;


        return view('employees.edit_order',compact('order','vat'));
    }

    public function editOrderStatus(Request $request,$id){
        $order=Order::find($id);
        //changing order status
        $order->order_status=$request->get('order_status');

        $order->save();

        return redirect('employees_dashboard');
    }


    public function saveNotes(Request $request,$id)
    {
        $order=Order::find($id);

        $order->orderdetail()->update([
            "notes" => $request->get('notes'),
        ]);
        return redirect('employees/editOrder/'.$order->id);

    }

    public function orders()
    {
        $user=User::find(Auth::user()->id);
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('employees.orders',compact('orders','user'));
    }

    public function invoices()
    {
        $user=User::find(Auth::user()->id);
        $orders=$user->employee_orders()->orderBy('created_at','desc')->get();
        return view('employees.invoices',compact('orders'));
    }
    public function tasks()
    {
        $user=User::find(Auth::user()->id);
        $orders = Order::orderBy('created_at', 'desc')->get();


        return view('employees.tasks',compact('orders','user'));
    }


    public function inProcess($order){

        $order=Order::find($order);
        $order->order_status='2';
        $order->save();

        return redirect('employees/orders');
    }

    public function completed($order){
        $order=Order::find($order);
        $order->order_status='4';

        $order->save();


        return redirect('employees/orders');
    }

}
