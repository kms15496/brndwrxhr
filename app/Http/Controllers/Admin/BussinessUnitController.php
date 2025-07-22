<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BussinessUnit;
use App\Models\Country;
use Illuminate\Http\Request;
use Kaung\CrudKit\Http\Controllers\BaseCrudController;
use App\DataTables\BussinessUnitDataTable;
class BussinessUnitController extends BaseCrudController
{
    public function __construct()
    {
        parent::__construct(
            model: BussinessUnit::class,
            view_base: 'admin.bussiness-unit',
            selectFields: [
                'country_id' => Country::pluck('name', 'id')->toArray()
            ],
            fields: [
                'country_id' => 'required',
                'name' => 'required|string',
                'description' => 'nullable|string|max:255',
                'lat' => 'required|string',
                'long' => 'required|string',
            ],
            form_name: 'Bussiness Unit',
            collectionName: 'thumbnails',
        );
    }

    public function index()
    {
        $countryDataTable = new BussinessUnitDataTable();
        return $countryDataTable->render('admin.bussiness-unit.index');
    }
}
