@extends('crudkit::layouts.form-layout')

@section('title')
    Update Leave
@endsection

@section('form')
    <form method="post" class="p-4 rounded shadow-sm bg-white">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Name</label>
            <input type="text" value="{{ $leave->user->name }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Leave Type</label>
            <input type="text" value="{{ $leave->leaveType->name }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Reason</label>
            <textarea class="form-control" rows="3" disabled>{{ $leave->message }}</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="pending" {{ $leave->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $leave->status === 'approved' ? 'selected' : '' }}>Approved</option>
            </select>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection