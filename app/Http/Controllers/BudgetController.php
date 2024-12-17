<?php

namespace App\Http\Controllers;

use App\Models\BudgetForecasting;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    // Display all budget forecasts
    public function index()
    {
        $budgets = BudgetForecasting::all();
        return view('budgets.index', compact('budgets'));
    }

    // Show form to create a new budget
    public function create()
    {
        return view('budgets.create');
    }

    // Store new budget in the database
    public function store(Request $request)
    {
        $request->validate([
            'forecast_period' => 'required',
            'forecast_amount' => 'required|numeric',
            'created_by' => 'required|exists:users,user_id',
        ]);

        BudgetForecasting::create($request->all());
        return redirect()->route('budgets.index');
    }

    // Show form to edit an existing budget
    public function edit($id)
    {
        $budget = BudgetForecasting::findOrFail($id);
        return view('budgets.edit', compact('budget'));
    }

    // Update budget in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'forecast_period' => 'required',
            'forecast_amount' => 'required|numeric',
            'created_by' => 'required|exists:users,user_id',
        ]);

        $budget = BudgetForecasting::findOrFail($id);
        $budget->update($request->all());
        return redirect()->route('budgets.index');
    }

    // Delete a budget
    public function destroy($id)
    {
        $budget = BudgetForecasting::findOrFail($id);
        $budget->delete();
        return redirect()->route('budgets.index');
    }
}
