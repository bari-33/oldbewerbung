<?php

namespace App\Http\Controllers;

use App\ClientDetail;
use App\Design;
use App\DesignCategory;
use App\faq;
use App\Mail\AccountMail;
use App\Mail\OrderAdmin;
use App\Mail\OrderMail;
use App\Messenger;
use App\Order;
use App\OrderDetail;
use App\OrderDocument;
use App\OrderProgress;
use App\Paypal;
use App\Product;
use App\Role;
use App\User;
use App\UserDetail;
use App\Website;
use App\WebsiteCategory;
use Carbon\Carbon;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products=Product::all();
        return view('orders.index',compact('products'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $password=rand(1000,9999);

        $request->validate([
            'email'=>'required|unique:users',
            'name'=>'required',
            'nickname'=>'required',
            'phonenumber'=>'required',
            'gender'=>'required',
        ]);


      $user=User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($password),
        ]);


       $order=new Order();
       $order->product_id=$request->get('product');
        $order->design_id=$request->get('design');
        $order->website_id=$request->get('website');

        $order->express=str_replace('.',',',number_format($request->get('express'), 2));;

        if($request->get('express')=='0')
        {
            $order->completion_date=Carbon::now()->addDay(4);
        }
        else
        {
            $order->completion_date=Carbon::now()->addDay(1);
        }


        $order->order_status='0';
        $order->payment_status='0';
       $order->customer_id=$user->id;

        // fetching data for products designs and websites
        $product=Product::find($request->get('product'));
        $design=Design::find($request->get('design'));
        $website=Website::find($request->get('website'));

        // calulating total price for an order
        $product_price=(float)str_replace(',','.',$product->regular_price);
        $design_price=(float)str_replace(',','.',$design->regular_price);
        $website_price=(float)str_replace(',','.',$website->regular_price);
        $express_price=(float)$request->get('express');
        $total_price=$product_price+$design_price+$website_price+$express_price;

        $order->total_price=str_replace('.',',',number_format($total_price, 2));
        $order->total_exact_price=$total_price;
        $order->save();
        $order_detail=new OrderDetail();
        $order_detail->order_id=$order->id;
         $order_detail->save();

// for email purpose

        $tax=$total_price*0.19;


        $account_data=[
            'user'=>$order->user->name,
            'email'=>$user->email,
            'password'=>$password,
            'order_id'=>$order->id,
            'product_name'=>$product->product_title,
            'product_price'=>$product->regular_price,
            'product_language'=>$product->language,
            'design_name'=>$design->design_title,
            'design_category'=>$design->product_category,
            'design_price'=>$design->regular_price,
            'website_name'=>$website->website_title,
            'website_category'=>$website->product_category,
            'website_price'=>$website->regular_price,
            'total_price'=>$order->total_price,
            'express'=>$express_price,
            'date'=>Carbon::parse($order->created_at->toDateString())->format('M d Y'),
            'tax'=>$tax,
            'finishing_date'=>Carbon::parse($order->completion_date->toDateString())->format('M d Y'),
        ];

        $user->roles()->attach(3);

        ClientDetail::create([
           'order_id'=>$order->id,
           'user_id'=>$user->id,
           'first_name'=>$request->get('name'),
            'last_name'=>$request->get('nickname'),
           'gender'=>$request->get('gender'),
           'mobile'=>$request->get('phonenumber'),
       ]);
       // Mail::to($user->email)->send(new OrderMail($mail_data));
        Mail::to($user->email)->send(new OrderMail($account_data));

       // Mail::to($user->email)->send(new AccountMail($account_data));



        Mail::to(Role::where('slug','admin')->first()->users()->first()->email)->send(new OrderAdmin($account_data));
       // for email purpose ends here

        Auth::login($user);


        return view('orders.thanks',compact('password','order'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $product=Product::find($id);
        $designs=Design::all();
        $websites=Website::all();
        $design_categories=DesignCategory::all();
        $website_categories=WebsiteCategory::all();

        return view('orders.show',compact('designs','websites','product','design_categories','website_categories'));
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function currentOrder($order)
    {
        // echo '<pre>'; print_r($order); echo '</pre>'; die;
        $data = json_decode($order);
        foreach ($data as $key => $value) {
           $data = $value->id;


        $order=Order::find($data);
        $messages=Messenger::where('to',Auth::user()->id)->orWhere('from',Auth::user()->id)->orderBy('created_at','asc')->get();
        $product=Product::find($order->product_id);
        $design=Design::find($order->design_id);

        $website=Website::find($order->website_id);

        //     $progress_count=$order->orderprogress->count();



        // if(!empty($order->orderprogress->last()->name)) {
        //     $last_progress = $order->orderprogress->last()->name;
        // }
        // else
        // {
        //     $last_progress="";
        // }
        // if(!empty($order->employee_chat))
        // {
        //     $emp=User::find($order->employee_chat);
        // }
        // else
        // {
        //     $emp='';
        // }

        $secret='b3d328f07199b1d0df8d783333badf79';
        $sig = hash_hmac('sha256', Auth::user()->email, $secret);



        //tax calculation
       // $tax_string=explode("% ",$product->tax_class);
        // $tax=str_replace(".",",",(float)str_replace(",",".",$order->total_price)*((float)((int)$tax_string[0]))/100);
     $tax=str_replace(".",",",number_format(((float)str_replace(",",".",$order->total_price)*0.19),2));

        }
        return view('orders.current_order',compact('order','product','design','website','sig','tax','messages'));
    }

    public function releaseOrder($order)
    {

        $order=Order::find($order);
        $order->order_status='1';
        $order->save();
/*
        $user=User::find($order->user_id);
        $product=Product::find($order->product_id);
        $design=Design::find($order->design_id);
        $website=Website::find($order->website_id);



        $total_price_without_tax=$order->total_price;
        $tax=$total_price_without_tax*0.19;
        $total_price=$total_price_without_tax+$tax;
        $items=[
            'product_name'=>$product->product_title,
            'product_price'=>$product->regular_price,
            'design_name'=>$design->design_title,
            'design_price'=>$design->regular_price,
            'website_name'=>$website->website_title,
            'website_price'=>$website->regular_price,
            'tax'=>$tax,
            'price'=>$total_price_without_tax,
            'total_price'=>$total_price,
            'express'=>$order->express,
        ];*/
       // return view('invoices.index',compact('order','user','items'));

        return response()->json(['success'=>'Order successfully released']);
    }


    public function expressOrder($order)
    {

        $order=Order::find($order);
        $order->express='59,00';
        $order->total_price=str_replace('.',',',(float)(str_replace(',','.',$order->total_price))+(59.00));
        $order->completion_date=Carbon::now()->addDay(1);

        $order->save();
        return redirect('orders/current/'.$order->id);
    }



    public function personalData(Request $request,$id)
    {

        $order=Order::find($id);
        $order->orderdetail()->update([
            "personal_description" => $request->get('personal_description')
        ]);
        $order->save();
        return response()->json(['success'=>'Data is successfully added']);
    }
    public function jobData(Request $request,$id)
    {

        $order=Order::find($id);

        $request->validate([
            'job' => 'required_without_all:job_file,job_description',
            'job_file' => 'required_without_all:job,job_description',
            'job_description' => 'required_without_all:job,job_file',

        ]);

        $count=$order->where('id',$id)->whereHas('orderprogress',function($q){
            $q->where('name', 'job');
        })->count();



        if($count==0)
        {
            $order_progress=new OrderProgress();
            $order_progress->name='job';
            $order_progress->type='completed';
            $order_progress->order_id=$order->id;
            $order_progress->save();

        }

        if($request->hasFile('job_file')){

            if(!empty($order->orderdetail->job_file)){
                $path = public_path()."/files/job/".$order->orderdetail->job_file;
                unlink($path);
            }

            $file = $request->job_file;
            $ext = $file->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $file->move('public/files/job/',$filename);

        }

        if (!empty($request->get('job'))){

            $order->orderdetail()->update([
                'job'=>$request->get('job'),
            ]);
        }
        if (!empty($filename)){

            $order->orderdetail()->update([
                "job_file" =>$filename,
                ]);
        }

        if (!empty($request->get('job_description'))){

            $order->orderdetail()->update([
                "job_description" => $request->get('job_description'),
            ]);

        }


        $order->save();

        return response()->json(['success'=>$count]);
     //   return response()->json(['success'=>'Data is successfully added']);
    }


    public function documentsData(Request $request,$id)
    {

        $order=Order::find($id);
        $count=$order->where('id',$id)->whereHas('orderprogress',function($q){
            $q->where('name', '=', 'documents');
        })->count();

        if($count==0)
        {
            $order_progress=new OrderProgress();
            $order_progress->name='documents';
            $order_progress->type='completed';
            $order_progress->order_id=$order->id;
            $order_progress->save();

        }

        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('files/document'),$imageName);

        $documents=new OrderDocument();
        $documents->name=$imageName;
        $documents->order_id=$id;
        $documents->save();

        return response()->json(['success'=>$imageName]);

    }

    public function documentsDestroy(Request $request)
    {


        $filename =  $request->get('filename');
        OrderDocument::where('name',$filename)->delete();
        $path=public_path().'/files/document/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function qualificationsData(Request $request,$id)
    {

        $order=Order::find($id);


            $count=$order->where('id',$id)->whereHas('orderprogress',function($q){
                $q->where('name', '=', 'qualification');
            })->count();

            if($count==0)
            {
                $order_progress=new OrderProgress();
                $order_progress->name='qualification';
                $order_progress->type='completed';
                $order_progress->order_id=$order->id;
                $order_progress->save();

            }


        $order->orderdetail()->update([
            "qualifications" => $request->get('qualifications'),
        ]);
        $order->save();
        return response()->json(['success'=>'Data is successfully added']);
    }

    public function qualificationsSkip(Request $request,$id)
    {

        $order=Order::find($id);

        $count=$order->where('id',$id)->whereHas('orderprogress',function($q){
            $q->where('name', '=', 'qualification');
        })->count();

        if($count==0)
        {
            $order_progress=new OrderProgress();
            $order_progress->name='qualification';
            $order_progress->type='skipped';
            $order_progress->order_id=$order->id;
            $order_progress->save();

        }

        $order->orderdetail()->update([
            "qualifications" => '-1',
        ]);
        $order->save();
        return response()->json(['success'=>'Data is successfully added']);
    }

    public function motivationData(Request $request,$id)
    {


        $order=Order::find($id);


            $count=$order->where('id',$id)->whereHas('orderprogress',function($q){
                $q->where('name', '=', 'motivation');
            })->count();

            if($count==0)
            {
                $order_progress=new OrderProgress();
                $order_progress->name='motivation';
                $order_progress->type='completed';
                $order_progress->order_id=$order->id;
                $order_progress->save();

            }

        $order->orderdetail()->update([
            "motivation_description" => $request->get('motivation_description'),
            "motivation_salary" => $request->get('salary'),
            "motivation_entry_date" => $request->get('entry_date'),
        ]);
        $order->save();
        return response()->json(['success'=>'Data is successfully added']);
    }

    public function motivationSkip(Request $request,$id)
    {


        $order=Order::find($id);

        $count=$order->where('id',$id)->whereHas('orderprogress',function($q){
            $q->where('name', '=', 'motivation');
        })->count();

        if($count==0)
        {
            $order_progress=new OrderProgress();
            $order_progress->name='motivation';
            $order_progress->type='skipped';
            $order_progress->order_id=$order->id;
            $order_progress->save();

        }


        $order->orderdetail()->update([
            "motivation_description" => '-1',
        ]);
        $order->save();
        return response()->json(['success'=>'Data is successfully added']);
    }

    public function paymentDone($id)
    {
        $order=Order::find($id);

        $paypal=new Paypal();
        $paypal->payment_id=$_GET['paymentId'];
        $paypal->payer_id=$_GET['PayerID'];
        $paypal->token=$_GET['token'];
        $paypal->order_id=$order->id;
        $paypal->save();

        $order->payment_status='1';

        $count=$order->where('id',$id)->whereHas('orderprogress',function($q){
            $q->where('name', '=', 'payment');
        })->count();

        if($count==0)
        {
            $order_progress=new OrderProgress();
            $order_progress->order_id=$order->id;
            $order_progress->name='payment';
            $order_progress->type='completed';

            $order_progress->save();

        }

        $order->save();
        $faqs=faq::where('set_public','1')->get();
        return view('orders.thanks_for_payment',compact('order','faqs'));
    }


    public function allOrders()
    {

        $orders=Order::orderBy('created_at','Desc')->get();

        return view('orders.orders_all',compact('orders'));
    }


    public function customerOrders($customer)
    {

        $customer=User::find($customer);
        $orders=$customer->orders;
        $secret='b3d328f07199b1d0df8d783333badf79';

        $sig = hash_hmac('sha256', Auth::user()->email, $secret);
        return view('orders.customer_orders',compact('orders','sig'));
    }


    public function addOrder(Request $request)
    {

        $order=new Order();
        $order->product_id=$request->get('product');
        $order->design_id=$request->get('design');
        $order->website_id=$request->get('website');

        $order->express=str_replace('.',',',number_format($request->get('express'), 2));;


        if($request->get('express')=='0')
        {
            $order->completion_date=Carbon::now()->addDay(4);
        }
        else
        {
            $order->completion_date=Carbon::now()->addDay(1);
        }


        $order->order_status='0';
        $order->payment_status='0';
        $order->customer_id=Auth::user()->id;

        // fetching data for products designs and websites
        $product=Product::find($request->get('product'));
        $design=Design::find($request->get('design'));
        $website=Website::find($request->get('website'));

        // calulating total price for an order
        $product_price=(float)str_replace(',','.',$product->regular_price);
        $design_price=(float)str_replace(',','.',$design->regular_price);
        $website_price=(float)str_replace(',','.',$website->regular_price);
        $express_price=(float)$request->get('express');
        $total_price=$product_price+$design_price+$website_price+$express_price;


        $order->total_price=str_replace('.',',',number_format($total_price, 2));
        $order->save();
        $order_detail=new OrderDetail();
        $order_detail->order_id=$order->id;
        $order_detail->save();

        // for email purpose
        $tax=$total_price*0.19;
        $mail_data=[
            'order_id'=>$order->id,
			'user'=>Auth::user()->email,
            'product_name'=>$product->product_title,
            'product_price'=>$product->regular_price,
            'product_language'=>$product->language,
            'design_name'=>$design->design_title,
            'design_category'=>$design->product_category,
            'design_price'=>$design->regular_price,
            'website_name'=>$website->website_title,
            'website_price'=>$website->regular_price,
            'website_category'=>$website->website_category,
            'total_price'=>$order->total_price,
            'express'=>$express_price,
            'tax'=>$tax,
            'date'=>Carbon::parse($order->created_at->toDateString())->format('M d Y'),
            'finishing_date'=>Carbon::parse($order->completion_date->toDateString())->format('M d Y'),
        ];

        Mail::to(Auth::user()->email)->send(new OrderMail($mail_data));

        // for email purpose ends here

        return redirect('adminorders/');

    }

    public function allDocuments($id)
    {

        $order=Order::find($id);

        return response()->json($order->documents);
    }

    public function documentsDelete($id)
    {
        $document=OrderDocument::find($id);
        $document->delete();

        return response()->json(['success'=>'removed successfully']);
    }

    public function getTrialDocuments($id)
    {
        // Fetch all records
       $order=Order::find($id);
       $trialdocuments=$order->trialdocuments;

        return Response($trialdocuments);
    }

    public function getFinishedDocuments($id)
    {
        // Fetch all records
        $order=Order::find($id);
        $finisheddocuments=$order->finisheddocuments;

        return Response($finisheddocuments);
    }

}
