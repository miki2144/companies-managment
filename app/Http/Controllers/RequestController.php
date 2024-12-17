<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\PaymentRequest;
use App\Models\PurchaseRequest;

class RequestController extends Controller
{
    // Leave Requests
    public function createLeaveRequest()
    {
        // Retrieve leave requests for the authenticated user
        $leaveRequests = LeaveRequest::where('user_id', auth()->id())->get();
    
        // Pass the leave requests to the view
        return view('leave_requests.create', compact('leaveRequests'));
    }
    
    public function storeLeaveRequest(Request $request)
    {
        // Ensure the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create a leave request.');
        }
    
        $user = auth()->user();
    
        // Debugging step to ensure user data is correct
        \Log::info('User Data', ['user' => $user]);
    
        // Validate request
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);
    
        // Check if user_id is set
        if (!$user->id) {
            return redirect()->back()->with('error', 'User ID is not set. Please log in again.');
        }
    
        // Create leave request
        LeaveRequest::create([
            'user_id' => $user->id, // Ensure this matches the authenticated user ID
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);
    
        return redirect()->route('leave.requests.index')->with('success', 'Leave request submitted successfully.');
    }
    

    public function indexLeaveRequests()
{
    // Retrieve leave requests for the authenticated user
    $leaveRequests = LeaveRequest::where('user_id', auth()->id())->get();

    // Pass the leave requests to the view
    return view('leave_requests.index', compact('leaveRequests'));
}
    public function approveLeaveRequest($id)
    {
        $request = LeaveRequest::findOrFail($id);
        $request->status = 'approved';
        $request->approved_by = auth()->user()->id;
        $request->save();

        return redirect()->route('leave.requests.index')->with('success', 'Leave request approved successfully.');
    }

    public function rejectLeaveRequest($id)
    {
        $request = LeaveRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->approved_by = auth()->user()->id;
        $request->save();

        return redirect()->route('leave.requests.index')->with('success', 'Leave request rejected successfully.');
    }

    // Payment Requests
    public function createPaymentRequest()
    {
        return view('payment_requests.create');
    }

    public function storePaymentRequest(Request $request)
    {
        // Ensure the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create a payment request.');
        }

        $request->validate([
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);

        PaymentRequest::create([
            'user_id' => auth()->user()->id,
            'amount' => $request->amount,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->route('payment.requests.index')->with('success', 'Payment request submitted successfully.');
    }

    public function indexPaymentRequests()
    {
        $paymentRequests = PaymentRequest::with('user')->get();
        return view('payment_requests.index', compact('paymentRequests'));
    }

    public function approvePaymentRequest($id)
    {
        $request = PaymentRequest::findOrFail($id);
        $request->status = 'approved';
        $request->approved_by = auth()->user()->id;
        $request->save();

        return redirect()->route('payment.requests.index')->with('success', 'Payment request approved successfully.');
    }

    public function rejectPaymentRequest($id)
    {
        $request = PaymentRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->approved_by = auth()->user()->id;
        $request->save();

        return redirect()->route('payment.requests.index')->with('success', 'Payment request rejected successfully.');
    }

    // Purchase Requests
    public function createPurchaseRequest()
    {
        return view('purchase_requests.create');
    }

    public function storePurchaseRequest(Request $request)
    {
        // Ensure the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to make a purchase request.');
        }

        $request->validate([
            'item_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'estimated_cost' => 'required|numeric|min:0',
        ]);

        PurchaseRequest::create([
            'user_id' => auth()->user()->id,
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'estimated_cost' => $request->estimated_cost,
            'status' => 'pending',
        ]);

        return redirect()->route('purchase.requests.index')->with('success', 'Purchase request submitted successfully.');
    }

    public function indexPurchaseRequests()
    {
        $purchaseRequests = PurchaseRequest::with('user')->get();
        return view('purchase_requests.index', compact('purchaseRequests'));
    }

    public function approvePurchaseRequest($id)
    {
        $request = PurchaseRequest::findOrFail($id);
        $request->status = 'approved';
        $request->approved_by = auth()->user()->id;
        $request->save();

        return redirect()->route('purchase.requests.index')->with('success', 'Purchase request approved successfully.');
    }

    public function rejectPurchaseRequest($id)
    {
        $request = PurchaseRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->approved_by = auth()->user()->id;
        $request->save();

        return redirect()->route('purchase.requests.index')->with('success', 'Purchase request rejected successfully.');
    }
}
