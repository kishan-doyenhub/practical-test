<?php

namespace App\DataTables;

use App\Order;
use Yajra\DataTables\Services\DataTable;

class orderDataTable extends DataTable
{
    public function dataTable()
    {
        return datatables()
            ->eloquent($this->query())
            ->filterColumn('customer_id', function($query, $keyword) {
                $query->whereRaw('(customer_id IN (SELECT id FROM customers WHERE name LIKE "'.$keyword.'%"))');
            })
            ->editColumn('customer_id', function ($orderData) {
                if(isset($orderData->CustomerName->name)){
                    return $orderData->CustomerName->name;
                }else{
                    return 'Record Delete';
                }
            })
            
            ->editColumn('action', function ($orderData) {
                return '
                    <a href="'.route('order.view', ['id' => $orderData->id]) . '" class="btn btn-sm btn-success mr-05" title="View orderData Data">
                        <i class="fa fa-eye edit-icon" aria-hidden="true"></i>
                    </a>
                    <a href="'.route('order.edit', ['id' => $orderData->id]) . '" class="btn btn-sm btn-primary mr-05" title="Edit orderData Data">
                        <i class="fa fa-pencil-square-o edit-icon" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('order.delete', ['id' => $orderData->id]) . '" 
                        class="btn btn-sm btn-danger mr-05 " onclick="return confirm(\'Are you sure?\')"
                        title="Delete"><i class="fa fa-trash-o deletable"></i>
                    </a>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['action','status']);
    }

    public function query()
    {
        $query = \App\Order::query()->select('*');
        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                // 'DT_Row_Index' =>  ['title' => 'Sr No.' ,'orderable' => false, 'searchable' => false, 'width' => '50px' ],
                'customer_id' => ['title' => 'Customer Name'],
                'invoice_number' => ['title' => 'Invoice Number'],
                'total_amount' => ['title' => 'Total Amount'],                
                'status' => ['title' => ' Status'],                
                'action' => ['title' => 'Actions','searchable' => false],
            ])
            ->ajax('')
            // ->addAction(['title' => 'Actions','width' => '100px', 'printable' => false])
            ->parameters($this->getBuilderParameters());
    }


    protected function getBuilderParameters()
    {
        return [
            'lengthMenu' => [[50, 100, 500, -1], [50, 100, 500, "All"]],
            'dom' => 'lBfrtip',
            'buttons' => [],
            // 'initComplete' => "function () {
            //     this.api().columns().every(function ( index ){
            //         $('#dataTableBuilder_wrapper thead').append($('#dataTableBuilder_wrapper tfoot tr'));
            //     });
            // }"
        ];
    }

    protected function filename()
    {
        return 'Flowboard_' . time();
    }
}