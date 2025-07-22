@extends('layouts.table-layout')

@section('title')
    Users List
@endsection

@section('create_route', 'admin.user.create')

@section('content')
    {{ $dataTable->table() }}
@endsection

@section('scripts')
    {{ $dataTable->scripts() }}
@endsection