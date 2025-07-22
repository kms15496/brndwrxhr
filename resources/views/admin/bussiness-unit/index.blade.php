@extends('layouts.table-layout')

@section('title')
    Bussiness Unit List
@endsection

@section('create_route', 'admin.bussiness-unit.create')

@section('content')
    {{ $dataTable->table() }}
@endsection

@section('scripts')
    {{ $dataTable->scripts() }}
@endsection