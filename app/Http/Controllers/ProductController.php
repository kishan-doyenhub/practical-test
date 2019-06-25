<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Datatables;
use App\DataTables\ProductDataTable as ProductDataTable;
use \App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $dataTable, Request $request) {
        if(\Auth::user()->id != 3 AND \Auth::user()->id != 1){
            return redirect()->route('home')->withErrors("Sorry, You don't have permission");
        }
        $title = 'Product Data List';
        $button_link = '<a href="'.route('product.create').'" class="btn btn-primary extrasmall pull-right"><i class="fa fa-plus"></i> Add New</a>';
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
            $title = "Add Product";
            $product_data = new Product;
        }else{
            $title = "Edit Product";
            $product_data = Product::where('id',$id)->first();
        }
        return view('product.create',compact('product_data','title'));
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
            "price"        => $request->price,
            "in_stock"     => $request->in_stock,
        );
        $validator = \Validator::make($property_data,
        [ 
            'name'         => 'required',
            'price'        => 'required',
            'in_stock'     => 'required',
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
            "id"         => $request->product_id,
            "name"       => $request->name,
            "price"      => $request->price,
            "in_stock"   => $request->in_stock,
        );

        if($request->product_id == ''){
            $data = Product::create($saveData);
            return redirect()->route('product.index')->withSuccess("Product data has been added successfully.");
        }else{
            Product::where('id',$request->product_id)->update($saveData);
            return redirect()->route('product.index')->withSuccess("Product data has been updated successfully.");
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
        if(\Auth::user()->id != 3 AND \Auth::user()->id != 1){
            return redirect()->route('home')->withErrors("Sorry, You don't have permission");
        }
        $del_status = Product::where('id',$id)->first();
        if(count($del_status) == 0){
            return redirect()->back()->withErrors("Sorry, This Information Is Not Found");
        }
        Product::where('id',$id)->delete();
        return redirect()->route('product.index')->withSuccess("Product has been deleted successfully.");
    }
}
