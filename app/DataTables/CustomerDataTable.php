<?php

namespace App\DataTables;

use App\Customer;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
{
    public function dataTable()
    {
        return datatables()
            ->eloquent($this->query())

            ->editColumn('action', function ($customerData) {
                return '
                    <a href="'.route('customer.edit', ['id' => $customerData->id]) . '" class="btn btn-sm btn-primary mr-05" title="Edit customerData Data">
                        <i class="fa fa-pencil-square-o edit-icon" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('customer.delete', ['id' => $customerData->id]) . '" 
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
        $query = \App\Customer::query()->select('*');
        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                // 'DT_Row_Index' =>  ['title' => 'Sr No.' ,'orderable' => false, 'searchable' => false, 'width' => '50px' ],
                'id' => ['title' => 'Id'],
                'name' => ['title' => 'Customer Name'],                
                'email' => ['title' => 'Customer Email'],                
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