<?php

namespace App\Http\Controllers;


use App\DataTables\LeaveDataTable;
use App\DataTables\LeaveTypeDataTable;
use App\Models\Leave;
use App\Models\LeaveType;
use Kaung\CrudKit\Http\Controllers\BaseCrudController;
use App\DataTables\BussinessUnitDataTable;
class LeaveController extends BaseCrudController
{
    public function __construct()
    {
        parent::__construct(
            model: Leave::class,
            view_base: 'leaves',

            fields: [

                'date' => 'required|date',
                'leave_type' => 'required',
                'message' => 'required|string|max:255',


            ],
            form_name: 'Leaves',
            selectFields: [
                'leave_type' => LeaveType::pluck('name', 'id')->toArray()
            ]
        );
    }

    public function index()
    {
        $countryDataTable = new LeaveDataTable();
        return $countryDataTable->render('leaves.index');
    }
}
