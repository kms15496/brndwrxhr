<?php

namespace App\Http\Controllers;


use App\DataTables\LeaveDataTable;

use App\Models\Leave;
use App\Models\LeaveType;
use Auth;
use Kaung\CrudKit\Http\Controllers\BaseCrudController;
use Illuminate\Http\Request;


class LeaveController extends BaseCrudController
{


    public function __construct()
    {
        parent::__construct(
            Leave::class, // $model
            'leaves',     // $view_base
            [             // $fields
                'date' => 'required|date',
                'leave_type' => 'required',
                'message' => 'required|string|max:255',
            ],
            'Leaves',     // $form_name
            'thumbnails', // $collectionName
            [],           // $hideFields
            [],           // $multiple
            [],           // $checkBoxFields
            [],           // $radioFields
            [             // $selectFields
                'leave_type' => LeaveType::pluck('name', 'id')->toArray(),
            ]
        );
    }

    public function index()
    {
        $countryDataTable = new LeaveDataTable();
        return $countryDataTable->render('leaves.index');
    }

    public function editView($id)
    {
        $leave = Leave::with('user', 'leaveType')->where('id', $id)->first();
        return view('leaves.update-status', ['leave' => $leave]);
    }

    public function updateLeave(Request $request, $id)
    {
        $leave = Leave::find($id);
        $leave->status = $request->status;
        $leave->approved_by = Auth::id();
        $leave->save();
        return redirect()->route('leaves.index')->with('success', 'Leave Update Success');
    }
}
