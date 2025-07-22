<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountryDataTable;
use App\DataTables\DepartmentDataTable;
use App\DataTables\RoleDataTable;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\BussinessUnit;
use App\Models\Country;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Kaung\CrudKit\Http\Controllers\BaseCrudController;
use Spatie\Permission\Models\Role;


class RoleController extends BaseCrudController
{
    public function __construct()
    {
        parent::__construct(
            model: Role::class,
            view_base: 'admin.role',
            fields: [
                'name' => 'required|string',

            ],
            form_name: 'Role',
            collectionName: 'thumbnails',
            hideFields: [],
            multiple: [],
            checkBoxFields: [],
            radioFields: []
        );

        $this->selectFields = [

        ];
    }

    public function index()
    {
        $countryDataTable = new RoleDataTable();
        return $countryDataTable->render('admin.role.index');
    }
}
