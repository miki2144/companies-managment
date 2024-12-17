@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Payroll Records</h1>

        <!-- Display success message if present -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Link to create new payroll record -->
        <a href="{{ route('payroll.create') }}" class="btn btn-primary">Create New Payroll</a>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Pay Period</th>
                    <th>Basic Salary</th>
                    <th>Net Salary</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payrolls as $payroll)
                    <tr>
                        <td>{{ $payroll->employee->name }}</td>  <!-- Assuming payroll has an employee relation -->
                        <td>{{ $payroll->pay_period }}</td>
                        <td>{{ number_format($payroll->basic_salary, 2) }}</td>
                        <td>{{ number_format($payroll->net_salary, 2) }}</td>
                        <td>{{ $payroll->status }}</td>
                        <td>
                            <a href="{{ route('payroll.edit', $payroll->id) }}" class="btn btn-warning">Edit</a>

                            <!-- Delete Form -->
                            <form action="{{ route('payroll.destroy', $payroll->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this payroll?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
