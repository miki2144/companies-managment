@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Payroll Record</h1>

    <form action="{{ route('payroll.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Select User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="pay_period">Pay Period</label>
            <input type="text" name="pay_period" id="pay_period" class="form-control" required>
            @error('pay_period') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="basic_salary">Basic Salary</label>
            <input type="number" step="0.01" name="basic_salary" id="basic_salary" class="form-control" required>
            @error('basic_salary') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="allowances">Allowances</label>
            <input type="number" step="0.01" name="allowances" id="allowances" class="form-control">
        </div>

        <div class="form-group">
            <label for="deductions">Deductions</label>
            <input type="number" step="0.01" name="deductions" id="deductions" class="form-control">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <div class="form-group">
            <label for="Prepared_by">Prepared By</label>
            <select name="Prepared_by" id="Prepared_by" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Create Payroll</button>
    </form>
</div>
@endsection