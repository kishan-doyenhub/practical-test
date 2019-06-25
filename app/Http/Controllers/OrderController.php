<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Datatables;
use App\DataTables\OrderDataTable as OrderDataTable;
use \App\Order;
use \App\OrderItem;
use Activity;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderDataTable $dataTable, Request $request) {
        if(\Auth::user()->id != 3 AND \Auth::user()->id != 1){
            return redirect()->route('home')->withErrors("Sorry, You don't have permission");
        }
        $title = 'Order Data List';
        $button_link = '<a href="'.route('order.create').'" class="btn btn-primary extrasmall pull-right"><i class="fa fa-plus"></i> Add New</a>';
        $assets = ['datatable_builder'];
        $key = $request->key;
        return $dataTable->render('globalPage.datatable', compact('assets','title','button_link','key'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(\Auth::user()->id != 3 AND \Auth::user()->id != 1){
            return redirect()->route('home')->withErrors("Sorry, You don't have permission");
        }
        $id = -1;
        if($request->id){
            $id = $request->id;
        }

        if($id == -1){
            $title = "Add Order";
            $order_data = new Order;
            $order_item = [];
        }else{
            $title = "Edit Order";
            $order_data = Order::where('id',$id)->first();
            $order_item = OrderItem::where('order_id',$id)->get();
        }
        if(count($order_item) == 0){
            $order_item[] = new OrderItem;
        }
        $relation = [
            'customer' => \App\Customer::get()->pluck('name', 'id')->prepend('--Select--', ''),
        ];
        $product = \App\Product::where('in_stock','!=',0)->get();
        return view('order.create',compact('order_data','title','product','order_item')+$relation);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order_save = array(
            'customer_id'     => $request->customer_id,
            'invoice_number'  => $request->invoice_number,
            'total_amount'    => $request->final_amt,
        );

        if($request->order_id == ''){
            $order = Order::create($order_save);
            $order_id = $order->id;
            //creating the newsItem will cause an activity being logged
            // $activity = Activity::all()->last();

            // $activity->description; //returns 'created'
            // $activity->subject; //returns the instance of NewsItem that was created
            // $activity->changes(); //returns ['attributes' => ['name' => 'original name', 'text' => 'Lorum']];
        }else{
            $order = Order::where('id',$request->order_id)->update($order_save);
            $order_id = $request->order_id;
            //updating the newsItem will cause an activity being logged
            // $activity = Activity::all()->last();

            // $activity->description; //returns 'updated'
            // $activity->subject; //returns the instance of NewsItem that was created
        }

        $item_id = $request->item_id;
        $product = $request->product_id;
        $quantity = $request->quantity;

        foreach($product as $key => $P){
            if($P != ''){
                $item_save = array(
                    'order_id'   => $order_id,
                    'product_id' => $P,
                    'quantity'  => $quantity[$key]
                );
                $productData = \App\Product::where('id',$P)->first();
                if($item_id[$key] == ''){
                    $stock =  $productData->in_stock - $quantity[$key];
                    $productData = \App\Product::where('id',$P)->update(['in_stock' => $stock]);
                    
                    OrderItem::create($item_save);
                }else{
                    $oldItemData = OrderItem::where('id',$item_id[$key])->first();
                    $stock =  ($productData->in_stock + $oldItemData->quantity) - $quantity[$key];
                    $productData = \App\Product::where('id',$P)->update(['in_stock' => $stock]);

                    OrderItem::where('id',$item_id[$key])->update($item_save);
                }

            }
        }

        if($request->order_id == ''){
            return redirect()->route('order.index')->withSuccess("Order data has been added successfully.");
        }else{
            return redirect()->route('order.index')->withSuccess("Order data has been updated successfully.");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = "Order Details";
        $orderData = Order::where('id',$id)->first();
        $orderItemData = OrderItem::where('order_id',$id)->get();
        return view('order.view',compact('orderData','orderItemData','title'));
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
        if(\Auth::user()->id != 3 AND \Auth::user()->id != 1){
            return redirect()->route('home')->withErrors("Sorry, You don't have permission");
        }
        $del_status = Order::where('id',$id)->first();
        if(count($del_status) == 0){
            return redirect()->back()->withErrors("Sorry, This Information Is Not Found");
        }
        OrderItem::where('order_id',$id)->delete();
        Order::where('id',$id)->delete();
        return redirect()->route('order.index')->withSuccess("Order has been deleted successfully.");
    }

    public function DeleteProductItemData(Request $request)
    {
        $item_data = OrderItem::where('id',$request->check_exists_id)->first();
        $status = $item_data->delete();
        if($status == true){
            return response()->json(['status'=>TRUE, 'message'=> 'Delete successfully.']);
        }else{
            return response()->json(['status'=>FALSE, 'message'=> 'Product data not found.']);
        }   
    }
}
