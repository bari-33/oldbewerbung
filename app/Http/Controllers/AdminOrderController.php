<?php

namespace App\Http\Controllers;

use PDF1;
use ZipArchive;
use File;
use App\Design;
use App\FinishedDocument;
use App\Mail\OrderCancelled;
use App\Mail\OrderCompleted;
use App\Mail\OrderMail;
use App\Mail\OrderProcessing;
use App\Mail\OrderRefunded;
use App\Mail\OrderWaitingPayment;
use App\Order;
use App\Product;
use App\Role;
use App\TrialDocument;
use App\User;
use App\UserDetail;
use App\Website;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();

        $employees = User::whereHas('roles', function ($q) {
            $q->where('id', '2');
        })->get();
        $dropdown = User::where("status", "1")->get();
        Session::put('all', $orders->count());
        Session::put('progress', Order::where('order_status', '2')->orderBy('created_at', 'Desc')->count());
        Session::put('waiting', Order::where('order_status', '1')->orderBy('created_at', 'Desc')->count());
        Session::put('completed', Order::where('order_status', '3')->orderBy('created_at', 'Desc')->count());
        Session::put('cancelled', Order::where('order_status', '-1')->orderBy('created_at', 'Desc')->count());
        Session::put('deleted', Order::onlyTrashed()->count());
        return view('adminorders.index', compact('orders', 'dropdown', 'employees'));
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
        $employees = User::whereHas('roles', function ($q) {
            $q->where('id', '2');
        })->whereDoesntHave('employee_orders', function ($q) use ($id) {
            $q->where('order_id', $id);
        })->get();


        $order = Order::find($id);
        //  dd($order);
        $product = Product::find($order->product_id);
        $design = Design::find($order->design_id);
        $website = Website::find($order->website_id);
        /* $tax_product=explode("% ",$product->tax_class);
        $tax_design=explode("% ",$design->tax_class);
        $tax_website=explode("% ",$website->tax_class); */

        $vat['complete_application'] = str_replace('.', ',', number_format(((float)str_replace(',', '.', $product->regular_price) * 0.19), 2));
        $vat['application_homepage'] = str_replace('.', ',', number_format(((float)str_replace(',', '.', $website->regular_price) * 0.19), 2));
        $vat['design'] = str_replace('.', ',', number_format(((float)str_replace(',', '.', $design->regular_price) * 0.19), 2));
        $vat['express_processing'] = str_replace('.', ',', number_format(((float)str_replace(',', '.', $order->express) * 0.19), 2));
        $vat['total'] = str_replace('.', ',', number_format(((float)str_replace(',', '.', $order->total_price) * 0.19), 2));
        $vat['product_price'] = $product->regular_price;
        $vat['website_price'] = $product->regular_price;
        $vat['design_price'] = $product->regular_price;


        return view('adminorders.edit', compact('order', 'employees', 'vat'));
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
        $order = Order::find($id);

        //changing order status
        $order->order_status = $request->get('order_status');

        $order->save();

        // fetching data for products designs and websites
        $product = Product::find($order->product_id);
        $design = Design::find($order->design_id);
        $website = Website::find($order->website_id);

        $product_price = (float)str_replace(',', '.', $product->regular_price);
        $design_price = (float)str_replace(',', '.', $design->regular_price);
        $website_price = (float)str_replace(',', '.', $website->regular_price);
        $express_price = (float)$order->express;
        $total_price = $product_price + $design_price + $website_price + $express_price;
        $tax = $total_price * 0.19;

        $account_data = [
            'user' => $order->user->name,
            'order_id' => $order->id,
            'product_name' => $product->product_title,
            'product_price' => $product->regular_price,
            'product_language' => $product->language,
            'design_name' => $design->design_title,
            'design_category' => $design->product_category,
            'design_price' => $design->regular_price,
            'website_name' => $website->website_title,
            'website_category' => $website->product_category,
            'website_price' => $website->regular_price,
            'total_price' => $order->total_price,
            'express' => $express_price,
            'date' => Carbon::parse($order->created_at->toDateString())->format('M d Y'),
            'tax' => $tax,
            'finishing_date' => Carbon::parse($order->completion_date)->format('M d Y'),
        ];


        if ($request->get('order_status') == "2") {
            Mail::to($order->user->email)->send(new OrderProcessing($account_data));
        }

        if ($request->get('order_status') == "3") {
            Mail::to($order->user->email)->send(new OrderWaitingPayment($account_data));
        }

        if ($request->get('order_status') == "4") {
            Mail::to($order->user->email)->send(new OrderCompleted($account_data));
        }

        if ($request->get('order_status') == "-1") {
            Mail::to($order->user->email)->send(new OrderCancelled($account_data));
        }
        if ($request->get('order_status') == "-2") {
            Mail::to($order->user->email)->send(new OrderRefunded($account_data));
        }

        return redirect('adminorders');
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
        $employees = User::whereHas('roles', function ($q) {
            $q->where('id', '2');
        })->get();
        $dropdown = User::where("status", "1")->get();
        if ($request->input('action') != 'custom_date') {
            $trash = false;


            switch ($request->input('action')) {

                case 'all':
                    $orders = Order::orderBy('created_at', 'Desc')->get();
                    break;
                case 'progress':

                    $orders = Order::where('order_status', '2')->orderBy('created_at', 'Desc')->get();
                    break;
                case 'waiting':
                    $orders = Order::where('order_status', '1')->orderBy('created_at', 'Desc')->get();
                    break;
                case 'completed':
                    $orders = Order::where('order_status', '4')->orderBy('created_at', 'Desc')->get();
                    break;
                case 'cancelled':
                    $orders = Order::where('order_status', '-1')->orderBy('created_at', 'Desc')->get();
                    break;
                case 'deleted':
                    $orders = Order::onlyTrashed()->get();
                    $trash = true;
                    break;
            }
        } else {
            $trash = true;
            // dd($request);
            $orders = Order::whereBetween('created_at', [$request->date_from . " 00:00:00", $request->date_to . " 23:59:59"])->orderBy('created_at', 'Desc')->get();
        }


        return view('adminorders.index', compact('orders', 'trash', 'dropdown', 'employees'));
    }

    //saving the order notes here

    public function saveNotes(Request $request, $id)
    {
        $order = Order::find($id);

        $order->orderdetail()->update([
            "notes" => $request->get('notes'),
        ]);
        return redirect('adminorders/' . $order->id . '/edit');
    }


    // trial documents upload

    public function trialDocuments(Request $request, $id)
    {
        $order = Order::find($id);

        $document = $request->file('file');
        $documentName = $document->getClientOriginalName();
        $document->move(public_path('files/trialdocuments'), $documentName);

        $documents = new TrialDocument();
        $documents->name = $documentName;
        $documents->order_id = $id;
        $documents->save();

        return response()->json(['success' => $documentName]);
    }

    public function trialDocumentsDestroy(Request $request)
    {


        $filename =  $request->get('filename');
        TrialDocument::where('name', $filename)->delete();
        $path = public_path() . '/files/trialdocuments/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }



    public function finishedDocuments(Request $request, $id)
    {
        $order = Order::find($id);

        $document = $request->file('file');
        $documentName = $document->getClientOriginalName();
        $document->move(public_path('files/finisheddocuments'), $documentName);

        $documents = new FinishedDocument();
        $documents->name = $documentName;
        $documents->order_id = $id;
        $documents->save();

        return response()->json(['success' => $documentName]);
    }

    public function finishedDocumentsDestroy(Request $request)
    {


        $filename =  $request->get('filename');
        FinishedDocument::where('name', $filename)->delete();
        $path = public_path() . '/files/finisheddocuments/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function addEmployee(Request $request, $id)
    {
        $order = Order::find($id);
        $employee = User::find($request->get('employee_id'));
        $total_price = (float)str_replace(',', '.', $order->total_price);

        if ($employee->userdetail->billing == "1") {
            //percentage
            $amount = $total_price * (($employee->userdetail->amount) / 100);
        } else if ($employee->userdetail->billing == "2") { //fixed
            $amount = $employee->userdetail->amount;
        }

        $order->employees()->syncWithoutDetaching([($request->get('employee_id')) => ['amount' => $amount]]);

        return response()->json(['success' => 'Employee is successfully added']);
    }

    public function removeEmployee(Request $request, $id)
    {
        $order = Order::find($id);
        $order->employees()->detach($request->get('employee_id'));

        return response()->json(['success' => 'Employee is successfully removed']);
    }

    public function deletetrialDocuments($id)
    {


        $document = TrialDocument::find($id);
        $path = public_path() . '/files/trialdocuments/' . $document->name;
        if (file_exists($path)) {
            unlink($path);
        }

        $document->delete();

        return response($id);
    }


    public function deletefinishedDocuments($id)
    {


        $document = FinishedDocument::find($id);
        $path = public_path() . '/files/finisheddocuments/' . $document->name;
        if (file_exists($path)) {
            unlink($path);
        }

        $document->delete();

        return response($id);
    }


    public function running($order)
    {
        $order = Order::find($order);
        $order->order_status = '2';
        $order->save();
        $data = json_encode($order);
        return response($data);
    }

    public function check($order)
    {
        $order = Order::find($order);
        $order->order_status = '3';
        $order->save();
          $data = json_encode($order);
        return response($data);
    }
    public function finished($order)
    {
        $order = Order::find($order);
        $order->order_status = '4';
        $order->save();
          $data = json_encode($order);
        return response($data);
    }
    public function activated($order)
    {
        $order = Order::find($order);
        $order->order_status = '-1';
        $order->save();
          $data = json_encode($order);
        return response($data);
    }
    public function cancelled($order)
    {
        $order = Order::find($order);
        $order->order_status = '1';
        $order->save();
          $data = json_encode($order);
        return response($data);
    }

    public function todo($order)
    {
        $order = Order::find($order);
        $order->order_status = '0';
        $order->save();
          $data = json_encode($order);
        return response($data);
    }

    public function deleteOrder($order)
    {

        $order = Order::where('id', $order)->delete();
        return redirect('adminorders');
    }

    public function deleteall(request $request)
    {

        $selector = $request->selector;
        if ($selector != 0) {
            foreach ($selector as  $value) {
                Order::where('id', $value)->delete();
            }
        }

        return redirect('adminorders');
    }
    public function allinvoice(request $request)
    {

        $selector = $request->selector;
        $invoice = [];
        $path = public_path('myfiles/');
        if (is_dir($path)) {
            File::deleteDirectory($path);
        }
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        foreach ($selector as  $value) {
            $order = Order::find($value);
            $user = User::find($order->customer_id);
            $product = Product::find($order->product_id);
            $design = Design::find($order->design_id);
            $website = Website::find($order->website_id);
            $total_price_without_tax = (float)str_replace(',', '.', $order->total_price);
            $tax = $total_price_without_tax * 0.19;
            $total_price = $total_price_without_tax + $tax;

            $total_price = str_replace('.', ',', number_format($total_price, 2));
            $tax = str_replace('.', ',', number_format($tax, 2));
            $total_price_without_tax = str_replace('.', ',', number_format($total_price_without_tax, 2));

            $items = [
                'product_name' => $product->product_title,
                'product_price' => $product->regular_price,
                'product_language' => $product->language,
                'design_name' => $design->design_title,
                'design_category' => $design->product_category,
                'design_price' => $design->regular_price,
                'website_name' => $website->website_title,
                'website_category' => $website->product_category,
                'website_price' => $website->regular_price,
                'tax' => $tax,
                'price' => $total_price_without_tax,
                'total_price' => $total_price,
                'express' => $order->express,
                'order_created_at' => $order->created_at,
                'order_completion_date' => $order->completion_date,
                'order_id' => $order->id,
                'order_status' => $order->order_status,
                'user_name' => $order->user->name,
                'email' => $order->user->email,
                'mobile' => $order->user->clientdetail->mobile,
                'street_no' => $order->user->clientdetail->street_no,
                'house_no' => $order->user->clientdetail->house_no,
                'zip_code' => $order->user->clientdetail->zip_code,
                'city' => $order->user->clientdetail->city,

            ];

            array_push($invoice, $items);

            foreach ($invoice as  $items) {
                $mpdf = new  \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
                $html = view('invoices.alldown', compact('items'))->render();
                $mpdf->WriteHTML($html,2);
                $filename = $order->id . '.pdf';
                $destination = $path . $filename;
                $mpdf->Output($destination, 'F');
            }


        }
        $zip = new ZipArchive;
        if (public_path("invoice.zip")) {
            unlink(public_path('invoice.zip'));
        }
        $fileName = 'invoice.zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
            $files = File::files(public_path('myfiles'));
            foreach ($files as $key => $value) {
                $file = basename($value);
                $zip->addFile($value, $file);
            }

            $zip->close();
        }


        return response()->download(public_path($fileName));
    }
    public function paid(request $request)
    {
        $payment_status = "1";
        $selector = $request->selector;
        foreach ($selector as  $value) {
            Order::where('id', $value)->update(["payment_status" => $payment_status]);
        }
        return redirect('adminorders');
    }

    public function unassingemploy($id, $order_id)
    {

        $data = User::where('id', $id)->select('order_id')->first();
        $order   =  $data->order_id;
        $order_id_db = explode(',', $order);
        if (($key = array_search($order_id, $order_id_db)) !== false) {
            unset($order_id_db[$key]);
        }
        $orderss = implode(',', $order_id_db);

        user::where('id', $id)->update(["order_id" => $orderss]);

        $data1 = order::where('id', $order_id)->select('user_id')->first();
        $order1   =  $data1->user_id;
        $order_db = explode(',', $order1);
        if (($key = array_search($id, $order_db)) !== false) {
            unset($order_db[$key]);
        }
        $orderss1 = implode(',', $order_db);
        $order_status = "0";
        order::where('id', $order_id)->update(["user_id" => $orderss1,
         "order_status"=>$order_status]);

        return redirect('adminorders');
    }
    public function restore(request $request)
    {
        $selector = $request->selector;
        foreach ($selector as  $value) {
            order::where('id', $value)->withTrashed()->restore();
        }
        return redirect('adminorders');
    }
    public function dropupdate($id, $order)
    {

        $status = "1";

        $order_id_in_db = User::where("id", $id)->get('order_id')->first();
        if (isset($order_id_in_db->order_id)) {
            $ind_order_id = explode(",", $order_id_in_db->order_id);
            if (!in_array($order, $ind_order_id)) {
                User::where("id", $id)->update([
                    "status" => $status,
                    "order_id" => empty($order_id_in_db->order_id) ? '' . $order : $order_id_in_db->order_id . ',' . $order
                ]);

            }
        }
        $order_status = "2";
        $data = order::where("id", $order)->get('user_id')->first();
        if (isset($data->user_id)) {
            $employ = explode(",", $data->user_id);
            if (!in_array($id, $employ)) {
                order::where("id", $order)->update([
                    "order_status"=>$order_status,
                    "user_id" => empty($data->user_id) ? '' . $id : $data->user_id . ',' . $id
                ]);

            }
        }

    }
}
