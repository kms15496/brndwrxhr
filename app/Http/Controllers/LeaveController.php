<?php

namespace App\Http\Controllers;


use App\DataTables\LeaveDataTable;

use App\Models\Leave;
use App\Models\LeaveType;
use Kaung\CrudKit\Http\Controllers\BaseCrudController;


class LeaveController extends BaseCrudController
{
    public function __construct()
    {
        parent::__construct(
            Leave::class,              // $model
            'leaves',                  // $view_base
            [                          // $fields
                'date' => 'required|date',
                'leave_type' => 'required',
                'message' => 'required|string|max:255',
            ],
            'Leaves',                  // $form_name
            null,                      // $collectionName
            [],                        // $hideFields
            [],                        // $multiple
            [],                        // $checkBoxFields
            [],                        // $radioFields
            [                          // $selectFields
                'leave_type' => LeaveType::pluck('name', 'id')->toArray(),
            ]
        );
    }

   

    public function index()
    {
        $countryDataTable = new LeaveDataTable();
        return $countryDataTable->render('leaves.index');
    }
}
