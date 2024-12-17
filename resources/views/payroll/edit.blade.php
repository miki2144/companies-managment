@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Payroll</h1>

        <form action="{{ route('payroll.update', $payroll->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="employee_id">Employee</label>
                <select name="employee_id" id="employee_id" class="form-control" required>
                    <option value="{{ $payroll->employee_id }}">{{ $payroll->employee->name }}</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="pay_period">Pay Period</label>
                <input type="text" name="pay_period" id="pay_period" class="form-control" value="{{ $payroll->pay_period }}" required>
            </div>

            <div class="form-group">
                <label for="basic_salary">Basic Salary</label>
                <input type="number" step="0.01" name="basic_salary" id="basic_salary" class="form-control" value="{{ $payroll->basic_salary }}" required>
            </div>

            <div class="form-group">
                <label for="allowances">Allowances</label>
                <input type="number" step="0.01" name="allowances" id="allowances" class="form-control" value="{{ $payroll->allowances }}">
            </div>

            <div class="form-group">
                <label for="deductions">Deductions</label>
                <input type="number" step="0.01" name="deductions" id="deductions" class="form-control" value="{{ $payroll->deductions }}">
            </div>

            <div class="form-group">
                <label for="net_salary">Net Salary</label>
                <input type="number" step="0.01" name="net_salary" id="net_salary" class="form-control" value="{{ $payroll->net_salary }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Active" {{ $payroll->status == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ $payroll->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Prepared_by">Prepared By</label>
                <select name="Prepared_by" id="Prepared_by" class="form-control" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $payroll->Prepared_by == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-3">Update Payroll</button>
        </form>
    </div>
@endsection
