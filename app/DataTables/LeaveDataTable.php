<?php

namespace App\DataTables;

use App\Models\BussinessUnit;
use App\Models\Country;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LeaveDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Country> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $user = Auth::user();

        return (new EloquentDataTable($query))
            ->addColumn('name', function ($row) use ($user) {

                return $row->user_id !== $user->id ? ($row->user->name ?? '') : 'Self';
            })
            ->addColumn('leave_type', function ($row) use ($user) {

                return $row->leaveType?->name;
            })
            ->addColumn('status', function ($row) {
                $status = $row->status ?? 'unknown';
                $class = $status === 'approved' ? 'success' : 'danger';

                return '<span class="badge bg-' . $class . '">' . ucfirst($status) . '</span>';
            })
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
    public function query(Leave $model): QueryBuilder
    {
        $user = Auth::user();
        $role = $user->getRoleNames()->first();
        $isDepartmentHead = $user->is_department_head;

        if ($role === 'admin') {
            return $model->with('user')->newQuery();

        }

        if ($isDepartmentHead) {
            $department_id = $user->department_id;
            $users = User::where('department_id', $department_id)->pluck('id')->toArray();
            return $model->with('user')->whereIn('leaves.user_id', $users)->newQuery();
        }

        return $model->with('user')->where('leaves.user_id', $user->id)->newQuery();

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

        $user = Auth::user();

        return array_filter([
            Column::make('id'),
            $user->hasRole('admin') || $user->is_department_head ? Column::make('name') : null,

            Column::make('date'),
            Column::make('status'),


            Column::make('leave_type'),


            Column::make('updated_at'),
            $user->hasRole('admin') || $user->is_department_head ? Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center') : null,
        ]);
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Country_' . date('YmdHis');
    }
}
