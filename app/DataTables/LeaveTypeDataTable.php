<?php

namespace App\DataTables;

use App\Models\BussinessUnit;
use App\Models\Country;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LeaveTypeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Country> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($banner) {
                $html = '
            <div class="d-flex">
                <a href="' . route('admin.leave-types.edit', $banner->id) . '" class="btn btn-sm btn-primary mr-2">
                    <span class="ph-duotone ph-pencil-simple"></span>
                </a>
               
            </div>
            ';
                return $html;
            })

            ->editColumn('updated_at', function ($log) {
                return $log->updated_at ? $log->updated_at->format('Y-m-d H:i:s') : ''; // Handling null cases
            })
            ->setRowId('id')->rawColumns(['action', 'image', 'status']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Country>
     */
    public function query(LeaveType $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('country-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),

            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            // Column::make('add your columns'),
            Column::make('name'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Country_' . date('YmdHis');
    }
}
