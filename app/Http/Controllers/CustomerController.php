<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Datatables;
use App\DataTables\CustomerDataTable as CustomerDataTable;
use \App\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomerDataTable $dataTable, Request $request) {
        if(\Auth::user()->id != 2 AND \Auth::user()->id != 1){
            return redirect()->route('home')->withErrors("Sorry, You don't have permission");
        }
        $title = 'Customer Data List';
        $button_link = '<a href="'.route('customer.create').'" class="btn btn-primary extrasmall pull-right"><i class="fa fa-plus"></i> Add New</a>';
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
        if(\Auth::user()->id != 2 AND \Auth::user()->id != 1){
            return redirect()->route('home')->withErrors("Sorry, You don't have permission");
        }
        $id = -1;
        if($request->id){
            $id = $request->id;
        }

        if($id == -1){
            $title = "Add Customer";
            $customer_data = new Customer;
        }else{
            $title = "Edit Customer";
            $customer_data = Customer::where('id',$id)->first();
        }
        return view('customer.create',compact('customer_data','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $property_data = array(
            "name"         => $request->name,
            "email"         => $request->email,
        );
        $validator = \Validator::make($property_data,
        [ 
            'name'         => 'required',
            'email'        => 'required',
        ]); 
            
        if($validator->fails()) 
        { 
            foreach($validator->getMessageBag()->toArray() as $error_data){
                foreach($error_data as $error){
                    $errors[] = ucwords(" ".$error);
                }
            }
            return redirect()->back()->withErrors($errors);
        }

        $saveData = array(
            "id"         => $request->customer_id,
            "name"       => $request->name,
            "email"      => $request->email,
        );

        if($request->customer_id == ''){
            $data = Customer::create($saveData);
            return redirect()->route('customer.index')->withSuccess("Customer data has been added successfully.");
        }else{
            Customer::where('id',$request->customer_id)->update($saveData);
            return redirect()->route('customer.index')->withSuccess("Customer data has been updated successfully.");
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
        if(\Auth::user()->id != 2 AND \Auth::user()->id != 1){
            return redirect()->route('home')->withErrors("Sorry, You don't have permission");
        }
        $del_status = Customer::where('id',$id)->first();
        if(count($del_status) == 0){
            return redirect()->back()->withErrors("Sorry, This Information Is Not Found");
        }
        Customer::where('id',$id)->delete();
        return redirect()->route('customer.index')->withSuccess("Customer has been deleted successfully.");
    }
}
