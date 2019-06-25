<?php

namespace App\DataTables;

use App\Product;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    public function dataTable()
    {
        return datatables()
            ->eloquent($this->query())
            ->editColumn('action', function ($Product) {
                return '
                    <a href="'.route('product.edit', ['id' => $Product->id]) . '" class="btn btn-sm btn-primary mr-05" title="Edit Product Data">
                        <i class="fa fa-pencil-square-o edit-icon" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('product.delete', ['id' => $Product->id]) . '" 
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
        $query = \App\Product::query()->select('*');
        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                // 'DT_Row_Index' =>  ['title' => 'Sr No.' ,'orderable' => false, 'searchable' => false, 'width' => '50px' ],
                'id' => ['title' => 'Id'],
                'name' => ['title' => 'Product Name'],                
                'price' => ['title' => 'Product Price'],                
                'in_stock' => ['title' => ' In Stock'],                
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