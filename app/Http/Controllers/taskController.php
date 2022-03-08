<?php

namespace App\Http\Controllers;
use App\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
      return view('task.index',compact("orders"));
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
    public function check($id,$checked,$checked1)
    {
        $checkbox=$checked;

        $data = order::where("id", $id)->get('check_boxes')->first();

        if (isset($data->check_boxes)) {
            $employ = explode(",", $data->check_boxes);
            if (!in_array($id, $employ)) {
                order::where("id", $id)->update([
                    "check_boxes" => empty($data->check_boxes) ? '' .$checked : $data->check_boxes . ',' .$checked
                ]);

            }
        }
        $data1 = order::where("id", $id)->get('check_boxes')->first();
        $employ = explode(",", $data1->check_boxes);
        $employee = count($employ);
        if ($checked1==1) {
        $check1 = "6";
          if ($employee == $check1) {
            order::where("id", $id)->update([
                "order_status" => "4"
            ]);

          }
        }
        if ($checked1==2) {
          $check2 = "1";
          if ($employee == $check2) {
            order::where("id", $id)->update([
                "order_status" => "4"
            ]);

          }
        }
        if ($checked1==3) {
            $check3 = "5";
            if ($employee == $check3) {
              order::where("id", $id)->update([
                  "order_status" => "4"
              ]);

            }
          }


          
    }

    public function uncheck1($id,$checked)
    {
      $data1 = order::where('id', $id)->select('check_boxes')->first();
      $order1   =  $data1->check_boxes;
      $order_db = explode(',', $order1);
      if (($key = array_search($checked, $order_db)) !== false) {
          unset($order_db[$key]);
      }
      $orderss1 = implode(',', $order_db);
      order::where('id', $id)->update(["check_boxes" => $orderss1
  , "order_status" => "3"]);



    }
}
