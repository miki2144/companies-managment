<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    // Display a listing of the inventory
    // public function index()
    // {
    //     // Allow both finance and storekeeper roles to view inventory
    //     if (Auth::user()->role !== 'finance' && Auth::user()->role !== 'storekeeper') {
    //         abort(403, 'Unauthorized action.');
    //     }

    //     $inventories = Inventory::all();
    //     return view('inventories.index', compact('inventories'));
    // }
    public function index()
    {
        // Allow both finance and storekeeper roles to view inventory
        if (Auth::user()->role !== 'finance' && Auth::user()->role !== 'storekeeper') {
            abort(403, 'Unauthorized action.');
        }
    
        // Fetch inventories for display
        $inventories = Inventory::all();  // Fetch all inventories
        $user = Auth::user();  // Fetch the authenticated user (for dashboard display)
        
        return view('inventories.index', compact('inventories', 'user'));
    }
    
    // Show the form for creating a new inventory
    public function create()
    {
        // Only allow storekeeper to access this
        if (Auth::user()->role !== 'storekeeper') {
            abort(403, 'Unauthorized action.');
        }

        return view('inventories.create');
    }

    // Store a newly created inventory in storage
    public function store(Request $request)
{
    // Only allow storekeeper to perform this action
    if (Auth::user()->role !== 'storekeeper') {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'item_name' => 'required|string|max:255',
        'quantity' => 'required|integer',
        'description' => 'nullable|string',
        'stock_in_date' => 'nullable|date',
        'stock_out_date' => 'nullable|date|after_or_equal:stock_in_date',
        'managed_by' => 'required|exists:users,user_id', // Use 'user_id' here instead of 'id'
    ]);

    Inventory::create($request->all());
    return redirect()->route('inventories.index')->with('success', 'Inventory item created successfully.');
}

public function edit($inventory_id)
{
    // Only allow storekeeper to access this
    if (Auth::user()->role !== 'storekeeper') {
        abort(403, 'Unauthorized action.');
    }

    $inventory = Inventory::findOrFail($inventory_id);  // Use $inventory_id
    return view('inventories.edit', compact('inventory'));
}

public function update(Request $request, $inventory_id)
{
    // Only allow storekeeper to perform this action
    if (Auth::user()->role !== 'storekeeper') {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'item_name' => 'required|string|max:255',
        'quantity' => 'required|integer',
        'description' => 'nullable|string',
        'stock_in_date' => 'nullable|date',
        'stock_out_date' => 'nullable|date|after_or_equal:stock_in_date',
    ]);

    $inventory = Inventory::findOrFail($inventory_id);  // Use $inventory_id
    $inventory->update($request->all());
    return redirect()->route('inventories.index')->with('success', 'Inventory updated successfully.');
}

public function destroy($inventory_id)
{
    // Only allow storekeeper to perform this action
    if (Auth::user()->role !== 'storekeeper') {
        abort(403, 'Unauthorized action.');
    }

    $inventory = Inventory::findOrFail($inventory_id);  // Use $inventory_id
    $inventory->delete();
    return redirect()->route('inventories.index')->with('success', 'Inventory item deleted successfully.');
}

}
