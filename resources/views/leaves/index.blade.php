@extends('layouts.table-layout')

@section('title')
    Leaves
@endsection

@section('create_route', 'leaves.create')

@section('content')
    {{ $dataTable->table() }}
@endsection

@section('scripts')
    {{ $dataTable->scripts() }}
@endsection