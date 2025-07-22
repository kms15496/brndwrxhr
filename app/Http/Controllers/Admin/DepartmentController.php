<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountryDataTable;
use App\DataTables\DepartmentDataTable;
use App\Http\Controllers\Controller;
use App\Models\BussinessUnit;
use App\Models\Country;
use App\Models\Department;
use Illuminate\Http\Request;
use Kaung\CrudKit\Http\Controllers\BaseCrudController;


class DepartmentController extends BaseCrudController
{
    public function __construct()
    {
        parent::__construct(
            model: Department::class,
            view_base: 'admin.department',
            fields: [
                'bussiness_unit_id' => 'required',
                'name' => 'required|string',
                'description' => 'nullable|string|max:255',
            ],
            selectFields: [
                'bussiness_unit_id' => BussinessUnit::pluck('name', 'id')->toArray()
            ],
            form_name: 'Department',
            collectionName: 'thumbnails',
        );
    }

    public function index()
    {
        $countryDataTable = new DepartmentDataTable();
        return $countryDataTable->render('admin.department.index');
    }
}
