@extends('layouts.table-layout')

@section('title')
    Department List
@endsection

@section('create_route', 'admin.department.create')

@section('content')
    {{ $dataTable->table() }}
@endsection

@section('scripts')
    {{ $dataTable->scripts() }}
@endsection