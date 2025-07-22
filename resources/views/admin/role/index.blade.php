@extends('layouts.table-layout')

@section('title')
    Role List
@endsection

@section('create_route', 'admin.role.create')

@section('content')
    {{ $dataTable->table() }}
@endsection

@section('scripts')
    {{ $dataTable->scripts() }}
@endsection