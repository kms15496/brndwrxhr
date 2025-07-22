<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Kaung\CrudKit\Http\Controllers\BaseCrudController;


class CountryController extends BaseCrudController
{
    public function __construct()
    {
        parent::__construct(
            model: Country::class,
            view_base: 'admin.country',         
            fields: [
                'name' => 'required|string',
                'description' => 'nullable|string|max:255',
            ],
            form_name: 'Country',
            collectionName: 'thumbnails',
        );
    }

    public function index()
    {
        $countryDataTable = new CountryDataTable();
        return $countryDataTable->render('admin.country.index');
    }
}
