@extends('layouts.table-layout')

@section('title')
    Leave Types List
@endsection

@section('create_route', 'admin.leave-types.create')

@section('content')
    {{ $dataTable->table() }}
@endsection

@section('scripts')
    {{ $dataTable->scripts() }}
@endsection