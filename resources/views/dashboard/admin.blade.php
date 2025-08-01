@extends('layouts.table-layout')

@section('title',  ' Dashboard')


@section('content')
<div class="container-fluid">
    <div class="row g-4">
        @foreach ($businessUnits as $unit)
            <div class="col-12 col-md-6 col-lg-4 d-flex">
                <div class="card shadow-sm border-0 flex-fill d-flex flex-column">
                    <div class="card-body flex-grow-1 d-flex flex-column">
                        <h5 class="card-title fw-bold border-bottom pb-2 mb-3">{{ $unit->name }}</h5>
                        <ul class="list-unstyled mb-4 flex-grow-1">
                            @forelse ($unit->employee as $user)
                                <li class="d-flex align-items-center mb-2">
                                    <div class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $user->name }}</span>
                                </li>
                            @empty
                                <li class="text-muted fst-italic">No employees</li>
                            @endforelse
                        </ul>

                        <!-- Button placed at bottom right -->
                        <div class="mt-auto text-end">
                            <a href="" class="btn btn-sm btn-primary px-4">
                                View All
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
