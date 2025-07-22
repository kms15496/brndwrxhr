@extends('layouts.table-layout')

@section('title')
    Country List
@endsection

@section('create_route', 'admin.country.create')

@section('content')
    {{ $dataTable->table() }}
@endsection

@section('scripts')
    {{ $dataTable->scripts() }}
@endsection