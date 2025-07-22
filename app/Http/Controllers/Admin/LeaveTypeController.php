<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\LeaveTypeDataTable;
use App\Models\LeaveType;
use Kaung\CrudKit\Http\Controllers\BaseCrudController;
use App\DataTables\BussinessUnitDataTable;
class LeaveTypeController extends BaseCrudController
{
    public function __construct()
    {
        parent::__construct(
            model: LeaveType::class,
            view_base: 'admin.leave-types',
           
            fields: [
                
                'name' => 'required|string',
                
            ],
            form_name: 'Bussiness Unit',
            collectionName: 'thumbnails',
        );
    }

    public function index()
    {
        $countryDataTable = new LeaveTypeDataTable();
        return $countryDataTable->render('admin.leave-types.index');
    }
}
