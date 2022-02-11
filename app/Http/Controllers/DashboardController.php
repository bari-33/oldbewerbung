<?php

namespace App\Http\Controllers;

use App\ChatRequest;
use App\Design;
use App\Message;
use App\Messenger;
use App\Order;
use App\Product;
use App\Role;
use App\User;
use App\Website;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $products=Product::all()->count();
        $designs=Design::all()->count();
        $websites=Website::all()->count();
        $orders=Order::with('employees_detail','orderdetail')->orderBy('created_at','desc')->get();
        $employees=User::whereHas('roles', function($q) {
            $q->where('id', '2');
        })->get();
        $dropdown=User::where("status","1")->get();

        $cm = date('Y-m');
        $pm = date('Y-m', strtotime(date('Y-m')." -1 month"));

        $cfrom = date($cm.'-01 00:00:00');
        $cto = date($cm.'-31 23:59:59');

        $pfrom = date($pm.'-01 00:00:00');
        $pto = date($pm.'-31 23:59:59');


        $corders = Order::whereBetween('created_at', [$cfrom, $cto])->count();
        $porders = Order::whereBetween('created_at', [$pfrom, $pto])->count();


        if($porders==$corders){
            $order_p = 0;
        }else{
        if($corders==0){
            $order_p = -100;
        }else{
            if($porders > $corders){
            $order_p = -1 * (($corders * 100) / $porders);
            }else{
                $order_p = ($porders * 100) / $corders;
            }

        }
        }

        $cordersrev = Order::whereBetween('created_at', [$cfrom, $cto])->get();
        $pordersrev = Order::whereBetween('created_at', [$pfrom, $pto])->get();

        $crev = 0;
        foreach($cordersrev as $co){
            $crev+=(int)$co->total_exact_price;
        }

        $prev = 0;
        foreach($pordersrev as $po){
            $prev+=(int)$po->total_exact_price;
        }


        if($crev==$prev){
            $order_r = 0;
        }else{
        if($crev==0){
            $order_r = -100;
        }else{
            if($prev > $crev){
            $order_r = -1 * (($crev * 100) / $prev);
            }else{
                $order_r = ($prev * 100) / $crev;
            }

        }
        }

        $days = date('d');
        $cdaily_avg = $crev / $days;
        $pdaily_avg = $prev / $days;
        $avg_p = 0;
        if($cdaily_avg==$pdaily_avg){
            $avg_p = 0;
        }else{
        if($cdaily_avg==0){
            $avg_p = -100;
        }else{
            if($pdaily_avg > $cdaily_avg){
            $avg_p = -1 * (($cdaily_avg * 100) / $pdaily_avg);
            }else{
                $avg_p = ($pdaily_avg * 100) / $cdaily_avg;
            }

        }
        }

        $cprod = Product::whereBetween('created_at', [$cfrom, $cto])->count();
        $pprod = Product::whereBetween('created_at', [$pfrom, $pto])->count();


        if($cprod==$pprod){
            $prod_p = 0;
        }else{
        if($cprod==0){
            $prod_p = -100;
        }else{
            if($pprod > $cprod){
            $prod_p = -1 * (($cprod * 100) / $pprod);
            }else{
                $prod_p = ($pprod * 100) / $cprod;
            }

        }
        }

        $revenue=0;
        foreach($orders as $order)
        {
            $revenue+=(int)$order->total_exact_price;
        }

        $orders_count=Order::all()->count();

        $employees=collect();
        $emp=Role::where('slug','employee')->first()->users()->get();
        foreach ($emp as $employee)
        {
            $count=Messenger::where('from',$employee->id)->where('to',Auth::user()->id)->where('read','0')->count();
            $employee->setAttribute('count',$count);
            $employees->add($employee);
        }



        return view('dashboard.admin',compact('products','dropdown','employees','designs','websites','orders','orders_count','revenue','employees','order_p','order_r','prod_p','cdaily_avg','pdaily_avg','avg_p'));
    }
    public function customer()
    {
        $user=User::find(Auth::user()->id);
        $orders=$user->orders()->orderBy('created_at','desc')->get();
        return view('dashboard.customer',compact('orders'));
    }


    public function employee()
    {
        $products=Product::all()->count();
        $designs=Design::all()->count();
        $websites=Website::all()->count();

        $orders=User::find(Auth::user()->id)->employee_orders()->orderBy('created_at','Desc')->get();
        $employee=User::find(Auth::user()->id);

        $order_count=$orders->count();

        $previous_month_orders=$employee->employee_orders()->whereMonth('order_user.created_at',Carbon::now()->subMonth()->month)->count();
        $current_month_orders=$employee->employee_orders()->whereMonth('order_user.created_at',Carbon::now()->month)->count();

     if($previous_month_orders==$current_month_orders){
                $order_p = 0;
            }else{
            if($current_month_orders==0){
                $order_p = -100;
            }else{
                if($previous_month_orders > $current_month_orders){
                $order_p = -1 * (($current_month_orders * 100) / $previous_month_orders);
                }else{
                    $order_p = ($previous_month_orders * 100) / $current_month_orders;
                }

            }
        }


        if($previous_month_orders==0)
        {
            $previous_month_orders=1;
        }
        $order_count_percentage=((int)$current_month_orders-(int)$previous_month_orders)/$previous_month_orders;


        $revenue=$employee->employee_orders()->whereMonth('order_user.created_at',Carbon::now()->month)->sum('amount');

        $previous_revenue=$employee->employee_orders()->whereMonth('order_user.created_at',Carbon::now()->subMonth()->month)->sum('amount');

        if($revenue==$previous_revenue){
            $order_r = 0;
        }else{
        if($revenue==0){
            $order_r = -100;
        }else{
            if($previous_revenue > $revenue){
            $order_r = -1 * (($revenue * 100) / $previous_revenue);
            }else{
                $order_r = ($previous_revenue * 100) / $revenue;
            }

        }
        }



        if($previous_revenue==0)
        {
            $previous_revenue=1;
        }
       $percentage=((int)$revenue-(int)$previous_revenue)/$previous_revenue;


        $unreadIds = Messenger::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('read', false)
            ->groupBy('from')
            ->get();
        $contacts = $orders->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->user->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            return $contact;
        });

        $contacts=collect();
        $orders=Order::where('employee_chat',Auth::user()->id)->get();

        // foreach ($orders as $order)
        // dd( $order);

        // {
        //     $user=$order->user;

        //     $count=Messenger::where('from',$user->id)->where('to',Auth::user()->id)->where('read','0')->count();
        //     $user->setAttribute('count',$count);
        //     $contacts->add($user);

        // }


        $admin=Role::where('slug','admin')->first()->users()->first();
        $count=Messenger::where('from',$admin->id)->where('to',Auth::user()->id)->where('read','0')->count();

        $chat_requests=ChatRequest::where('accepted','0')->get();

        return view('employees.page',compact('products','designs','websites','orders','order_count','employee','percentage','revenue','contacts','admin','count','chat_requests','order_count_percentage','order_p','order_r'));
    }
}
