<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayrollController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fetch payrolls for the authenticated user
        $payrolls = Payroll::where('user_id', $user->id)->get();

        return view('payroll.index', compact('payrolls'));
    }

    public function create()
    {
        $user = Auth::user();
        // Get users from the same company
        $users = User::where('company_id', $user->company_id)->get();

        return view('payroll.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        // Calculate net salary
        $net_salary = $this->calculateNetSalary(
            $request->basic_salary,
            $request->allowances,
            $request->deductions
        );
        $request->merge(['net_salary' => $net_salary]);

        // Store payroll data
        Payroll::create($request->all());

        return redirect()->route('payroll.index')->with('success', 'Payroll record created successfully.');
    }

    public function edit($id)
    {
        $payroll = Payroll::findOrFail($id);
        $users = User::where('company_id', Auth::user()->company_id)->get();

        return view('payroll.edit', compact('payroll', 'users'));
    }

    public function update(Request $request, $id)
    {
        $this->validateRequest($request);

        // Calculate net salary
        $net_salary = $this->calculateNetSalary(
            $request->basic_salary,
            $request->allowances,
            $request->deductions
        );
        $request->merge(['net_salary' => $net_salary]);

        $payroll = Payroll::findOrFail($id);
        $payroll->update($request->all());

        return redirect()->route('payroll.index')->with('success', 'Payroll record updated successfully.');
    }

    public function destroy($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();

        return redirect()->route('payroll.index')->with('success', 'Payroll record deleted successfully.');
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'pay_period' => 'required|string',
            'basic_salary' => 'required|numeric',
            'allowances' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'status' => 'required|string',
            'Prepared_by' => 'required|exists:users,id',
        ]);
    }

    private function calculateNetSalary($basic_salary, $allowances = 0, $deductions = 0)
    {
        return $basic_salary + ($allowances ?? 0) - ($deductions ?? 0);
    }
}