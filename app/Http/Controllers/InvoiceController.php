<?php

namespace App\Http\Controllers;

use App\Design;
use App\Order;
use App\Product;
use App\User;
use App\ClientDetail;
use App\Website;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::orderBy('created_at','desc')->get();
		
        $ClientDetail=ClientDetail::orderBy('created_at','desc')->get();

        $employees=User::whereHas('roles', function($q) {
            $q->where('id', '2');
        })->get();
        Session::put('all',$orders->count());
        Session::put('progress',Order::where('order_status','2')->orderBy('created_at','Desc')->count());
        Session::put('waiting',Order::where('order_status','1')->orderBy('created_at','Desc')->count());
        Session::put('completed',Order::where('order_status','3')->orderBy('created_at','Desc')->count());
        Session::put('cancelled',Order::where('order_status','-1')->orderBy('created_at','Desc')->count());
        Session::put('deleted',Order::onlyTrashed()->count());


        return view('invoices.index',compact('orders','ClientDetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $orders=Order::orderBy('created_at','Desc')->get();

        return view('invoices.view',compact('orders'));
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

        $order=Order::find($id);
		$user=User::where('id',$order->customer_id)->with('userdetail')->first();
        $product=Product::find($order->product_id);
        $design=Design::find($order->design_id);
        $website=Website::find($order->website_id);


        $total_price_without_tax=(float)str_replace(',','.',$order->total_price);
        $tax=$total_price_without_tax*0.19;
        $total_price=$total_price_without_tax+$tax;

        $total_price=str_replace('.',',',number_format($total_price, 2));
        $tax=str_replace('.',',',number_format($tax, 2));
        $total_price_without_tax=str_replace('.',',',number_format($total_price_without_tax, 2));

        $items=[
            'product_name'=>$product->product_title,
            'product_price'=>$product->regular_price,
            'product_language'=>$product->language,
            'design_name'=>$design->design_title,
            'design_category'=>$design->product_category,
            'design_price'=>$design->regular_price,
            'website_name'=>$website->website_title,
            'website_category'=>$website->product_category,
            'website_price'=>$website->regular_price,
            'tax'=>$tax,
            'price'=>$total_price_without_tax,
            'total_price'=>$total_price,
            'express'=>$order->express,
            'order_created_at'=>$order->created_at,
            'order_completion_date'=>$order->completion_date,
            'order_id'=>$order->id,
            'order_status'=>$order->order_status,
            'user_name'=>$user->name,
            'email'=>$user->email,
            'mobile'=>$order->user->clientdetail->mobile,
            'street_no'=>$order->user->clientdetail->street_no,
            'house_no'=>$order->user->clientdetail->house_no,
            'zip_code'=>$order->user->clientdetail->zip_code,
            'city'=>$order->user->clientdetail->city,
        ];
        return view('invoices.show',compact('items'));
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
        //
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
    public function search(Request $request)
    {
		$ClientDetail=ClientDetail::orderBy('created_at','desc')->get();
        if($request->input('action')!='custom_date'){
            $trash=false;
            switch ($request->input('action'))
            {

                case 'all':
                    $orders=Order::orderBy('created_at','Desc')->get();
                    break;
                case 'progress':

                    $orders=Order::where('order_status','2')->orderBy('created_at','Desc')->get();
                    break;
                case 'waiting':
                    $orders=Order::where('order_status','1')->orderBy('created_at','Desc')->get();
                    break;
                case 'completed':
                    $orders=Order::where('order_status','4')->orderBy('created_at','Desc')->get();
                    break;
                case 'cancelled':
                    $orders=Order::where('order_status','-1')->orderBy('created_at','Desc')->get();
                    break;
                case 'deleted':
                    $orders=Order::onlyTrashed()->get();
                    $trash=true;
                    break;


            }
        }else{
             $trash=true;
             // dd($request);
            $orders=Order::whereBetween('created_at', [$request->date_from." 00:00:00", $request->date_to." 23:59:59"])->orderBy('created_at','Desc')->get();
        }


            return view('invoices.index',compact('orders','trash','ClientDetail'));


     }

    public function pdf($id){

        $order=Order::find($id);
		
        $user=User::find($order->customer_id);
		
        $product=Product::find($order->product_id);
        $design=Design::find($order->design_id);
        $website=Website::find($order->website_id);
        $total_price_without_tax=(float)str_replace(',','.',$order->total_price);
        $tax=$total_price_without_tax*0.19;
        $total_price=$total_price_without_tax+$tax;

        $total_price=str_replace('.',',',number_format($total_price, 2));
        $tax=str_replace('.',',',number_format($tax, 2));
        $total_price_without_tax=str_replace('.',',',number_format($total_price_without_tax, 2));

        $items=[
            'product_name'=>$product->product_title,
            'product_price'=>$product->regular_price,
            'product_language'=>$product->language,
            'design_name'=>$design->design_title,
            'design_category'=>$design->product_category,
            'design_price'=>$design->regular_price,
            'website_name'=>$website->website_title,
            'website_category'=>$website->product_category,
            'website_price'=>$website->regular_price,
            'tax'=>$tax,
            'price'=>$total_price_without_tax,
            'total_price'=>$total_price,
            'express'=>$order->express,
            'order_created_at'=>$order->created_at,
            'order_completion_date'=>$order->completion_date,
            'order_id'=>$order->id,
            'order_status'=>$order->order_status,
            'user_name'=>$order->user->name,
            'email'=>$order->user->email,
            'mobile'=>$order->user->clientdetail->mobile,
            'street_no'=>$order->user->clientdetail->street_no,
            'house_no'=>$order->user->clientdetail->house_no,
            'zip_code'=>$order->user->clientdetail->zip_code,
            'city'=>$order->user->clientdetail->city,

        ];

        return view('invoices.download',compact('items'));
    }
}
