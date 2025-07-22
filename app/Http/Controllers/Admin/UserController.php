<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountryDataTable;
use App\DataTables\DepartmentDataTable;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\BussinessUnit;
use App\Models\Country;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Kaung\CrudKit\Http\Controllers\BaseCrudController;
use Spatie\Permission\Models\Role;


class UserController extends BaseCrudController
{
    public function __construct()
    {
        parent::__construct(
            model: User::class,
            view_base: 'admin.user',
            fields: [
                'name' => 'required|string',
                'email' => 'required|string',
                'phone' => 'required|string',
                'password' => 'nullable|string',
                'bussiness_unit_id' => 'required',
                'country_id' => 'required',
                'department_id' => 'required',
                'is_department_head' => 'required',
                'role' => 'required'
            ],
            form_name: 'User',
            collectionName: 'thumbnails',
            hideFields: [],
            multiple: [],
            checkBoxFields: [],
            radioFields: ['is_department_head']
        );

        $this->selectFields = [
            'bussiness_unit_id' => BussinessUnit::pluck('name', 'id')->toArray(),
            'country_id' => Country::pluck('name', 'id')->toArray(),
            'department_id' => Department::pluck('name', 'id')->toArray(),
            'is_department_head' => [
                1 => 'Yes',
                0 => 'No'
            ],
            'role'=>Role::pluck('name', 'id')->toArray()
        ];
    }

    public function index()
    {
        $countryDataTable = new UserDataTable();
        return $countryDataTable->render('admin.user.index');
    }
}
