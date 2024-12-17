<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

// Protected routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Superadmin Dashboard Route
Route::get('/dashboards/superadmin', function () {
    if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login'); // Redirect to login if not authorized
    }
    return app(DashboardController::class)->superadminDashboard();
})->name('superadmin.dashboard');


// Admin Dashboard Route
Route::get('/dashboards/admin', function () {
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        return redirect('/login'); // Redirect to login if not authorized
    }
    return app(DashboardController::class)->adminDashboard();
})->name('admin.dashboard');

// Superadmin Company CRUD Routes
Route::get('/companies', function () {
    if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login'); // Redirect to login if not authorized
    }
    return app(CompanyController::class)->index();
})->name('companies.index');

Route::get('/companies/create', function () {
    if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login'); // Redirect to login if not authorized
    }
    return app(CompanyController::class)->create();
})->name('companies.create');

Route::post('/companies', function (Request $request) {
    if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login'); // Redirect to login if not authorized
    }
    return app(CompanyController::class)->store($request);
})->name('companies.store');

Route::get('/companies/{company}', function (Company $company) {
    if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login'); // Redirect to login if not authorized
    }
    return app(CompanyController::class)->show($company);
})->name('companies.show');

Route::get('/companies/{company}/edit', function (Company $company) {
    if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login'); // Redirect to login if not authorized
    }
    return app(CompanyController::class)->edit($company);
})->name('companies.edit');

Route::put('/companies/{company}', function (Request $request, Company $company) {
    if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login'); // Redirect to login if not authorized
    }
    return app(CompanyController::class)->update($request, $company);
})->name('companies.update');

Route::delete('/companies/{company}', function (Company $company) {
    if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login'); // Redirect to login if not authorized
    }
    return app(CompanyController::class)->destroy($company);
})->name('companies.destroy');

// Admin User CRUD Routes
Route::get('/users', function () {
    if (!auth()->check() || (auth()->user()->role !== 'admin' && auth()->user()->role !== 'superadmin')) {
        return redirect('/login'); // Redirect to login if not authorized
    }
    return app(UserController::class)->index();
})->name('users.index');

Route::get('/users/create', function () {
    if (!auth()->check() || (auth()->user()->role !== 'admin' && auth()->user()->role !== 'superadmin')) {
        return redirect('/login'); // Redirect to login if not authorized
    }
    return app(UserController::class)->create();
})->name('users.create');

Route::post('/users', function (Request $request) {
    if (!auth()->check() || (auth()->user()->role !== 'admin' && auth()->user()->role !== 'superadmin')) {
        return redirect('/login'); // Redirect to login if not authorized
    }
    return app(UserController::class)->store($request);
})->name('users.store');

Route::get('/users/{user}/edit', function (User $user) {
    if (!auth()->check() || (auth()->user()->role !== 'admin' && auth()->user()->role !== 'superadmin')) {
        return redirect('/login'); // Redirect to login if not authorized
    }
    return app(UserController::class)->edit($user);
})->name('users.edit');

Route::put('/users/{user}', function (Request $request, User $user) {
    if (!auth()->check() || (auth()->user()->role !== 'admin' && auth()->user()->role !== 'superadmin')) {
        return redirect('/login'); // Redirect to login if not authorized
    }
    return app(UserController::class)->update($request, $user);
})->name('users.update');

Route::delete('/users/{user}', function (User $user) {
    if (!auth()->check() || (auth()->user()->role !== 'admin' && auth()->user()->role !== 'superadmin')) {
        return redirect('/login'); // Redirect to login if not authorized
    }
    return app(UserController::class)->destroy($user);
})->name('users.destroy');

/////////////////////////////////////////////
use App\Http\Controllers\AdminController;

// Admin CRUD Routes (accessible by superadmin)
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    // List all admins
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');

    // Show form to create a new admin
    Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');

    // Store a new admin
    Route::post('/users',
    [AdminController::class, 'store'])->name('users.store');

    // Show the edit form for an admin
    Route::get('/users/{admin}/edit', [AdminController::class, 'edit'])->name('users.edit');

    // Update an admin
    Route::put('/users/{admin}', [AdminController::class, 'update'])->name('users.update');

    // Delete an admin
    Route::delete('/users/{admin}', [AdminController::class, 'destroy'])->name('users.destroy');
});

// Protected routes for Superadmin
Route::get('/dashboards/superadmin', function () {
    if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login');
    }
    return app(DashboardController::class)->superadminDashboard();
})->name('superadmin.dashboard');

// Show Create Company Form
Route::post('/superadmin/create', function () {
    if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login');
    }
    return app(DashboardController::class)->showCreateCompany();
})->name('superadmin.create-company');

 //Store New Company
 Route::post('/superadmin', function (Request $request) {
     if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login');
    }
    return app(DashboardController::class)->createCompany($request);
 })->name('superadmin.store-company');

// User creation routes
Route::get('/users/create', function () {
    if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login');
    }
    return app(DashboardController::class)->showCreateUser();
})->name('superadmin.create-user');

////////////////////
////dashbord me 
// Show Create Company Form (GET)
Route::get('/superadmin/create-company', function () {
    if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login');
    }
    return app(DashboardController::class)->showCreateCompany();
})->name('superadmin.create-company');

// Store New Company (POST)
Route::post('/superadmin/create-company', function (Request $request) {
    if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login');
    }
    return app(DashboardController::class)->createCompany($request);
})->name('superadmin.store-company');

// Show Create User Form (GET)
Route::get('/superadmin/create-user', function () {
    if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login');
    }
    return app(DashboardController::class)->showCreateUser();
})->name('superadmin.create-user');


Route::get('/superadmin/create-user', [DashboardController::class, 'showCreateUser'])->name('superadmin.create-user');

// Store New User (POST)
Route::post('/superadmin/create-user', function (Request $request) {
    if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        return redirect('/login');
    }
    return app(DashboardController::class)->createUser($request);
})->name('superadmin.store-user');

////////////////////
// Show Create Company Form (GET)
Route::get('/superadmin/create-company', [DashboardController::class, 'showCreateCompany'])->name('superadmin.create-company');

// Store New Company (POST)
Route::post('/superadmin/create-company', [DashboardController::class, 'createCompany'])->name('superadmin.store-company');

//////////////////////////////
// create user in admin dashbord 

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
// User routes for creating and storing users
Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');
Route::post('/users', [AdminController::class, 'store'])->name('users.store');

});

//////////////////
/// admin functionlity

// Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');

// User management
Route::resource('users', AdminController::class);

Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');
Route::post('/users/store', [AdminController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');


Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

// Admin dashboard
Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])
    ->name('admin.dashboard')
    ->middleware('auth');

// User Routes (admin role required)
Route::group(['middleware' => ['auth']], function () {
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');
});

// Example Route Protection (Manual Role Check)
Route::get('/admin', function () {
    if (Auth::check() && Auth::user()->role == 'admin') {
        return view('admin.dashboard'); // Admin Dashboard
    }

    return redirect('/'); // If not an admin, redirect to home or another page
})->name('admin');
Route::get('/profile', [AdminController::class, 'showProfile'])->name('profile.show');


//////////////////////
Route::get('dashboards/superadmin', [DashboardController::class, 'superadminDashboard'])->name('superadmin.dashboard');
Route::get('dashboards/admin', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('dashboards/manager', [DashboardController::class, 'managerDashboard'])->name('manager.dashboard');
Route::get('dashboards/finance', [DashboardController::class, 'financeDashboard'])->name('finance.dashboard');
Route::get('dashboards/storekeeper', [DashboardController::class, 'storekeeperDashboard'])->name('storekeeper.dashboard');
Route::get('dashboards/employee', [DashboardController::class, 'employeeDashboard'])->name('employee.dashboard');


//////fianace
Route::get('/finance/dashboard', [FinanceController::class, 'financeDashboard'])->name('finance.dashboard');
Route::resource('requests', RequestController::class);
Route::resource('plans', PlanController::class);
Route::resource('payrolls', PayrollController::class);
Route::resource('inventories', InventoryController::class)->only(['index']);
Route::resource('budgets', BudgetController::class);
Route::resource('archived', ArchivedDocumentController::class);
Route::resource('payrolls', PayrollController::class);





use App\Http\Controllers\ReportController;

// Home route (optional)
Route::get('/', function () {
    return view('welcome'); // Adjust this to your main view
});

// Resource route for reports without middleware
Route::get('reports', [ReportController::class, 'index'])->name('reports.index'); // Index
Route::get('reports/create', [ReportController::class, 'create'])->name('reports.create'); // Create
Route::post('reports', [ReportController::class, 'store'])->name('reports.store'); // Store
Route::get('reports/{report}', [ReportController::class, 'show'])->name('reports.show'); // Show
Route::get('reports/{report}/edit', [ReportController::class, 'edit'])->name('reports.edit'); // Edit
Route::put('reports/{report}', [ReportController::class, 'update'])->name('reports.update'); // Update
Route::delete('reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy'); // Destroy


Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
// Additional Custom Routes for Roles
Route::get('/payment/requests/review', [RequestController::class, 'reviewPaymentRequests'])->name('payment.requests.review');
Route::get('/requests/approval', [RequestController::class, 'sendRequestsForApproval'])->name('requests.approval');
Route::get('/budget/forecast', [BudgetController::class, 'forecast'])->name('budget.forecast');

///////manager

// Dashboard route
Route::get('/manager/dashboard', [DashboardController::class, 'managerDashboard'])->name('manager.dashboard');

// Approval routes (example)
Route::get('/manager/purchase/approval', [ApprovalController::class, 'approvePurchase'])->name('purchase.approval');
Route::get('/manager/leave/approval', [ApprovalController::class, 'approveLeave'])->name('leave.approval');
Route::get('/manager/payment/approval', [ApprovalController::class, 'approvePayment'])->name('payment.approval');
Route::get('/manager/stockout/approval', [ApprovalController::class, 'approveStockOut'])->name('stockout.approval');
use App\Http\Controllers\RequestController;

// Route::get('/leave-requests', [RequestController::class, 'indexLeaveRequests'])->name('leave.requests.index');
// Route::get('/leave-requests/create', [RequestController::class, 'createLeaveRequest'])->name('leave.requests.create');
// Route::post('/leave-requests', [RequestController::class, 'storeLeaveRequest'])->name('leave.requests.store');
// Route::post('/leave-requests/{id}/approve', [RequestController::class, 'approveLeaveRequest'])->name('leave.requests.approve');
// Route::post('/leave-requests/{id}/reject', [RequestController::class, 'rejectLeaveRequest'])->name('leave.requests.reject');

// Route::get('/payment-requests', [RequestController::class, 'indexPaymentRequests'])->name('payment.requests.index');
// Route::get('/payment-requests/create', [RequestController::class, 'createPaymentRequest'])->name('payment.requests.create');
// Route::post('/payment-requests', [RequestController::class, 'storePaymentRequest'])->name('payment.requests.store');
// Route::post('/payment-requests/{id}/approve', [RequestController::class, 'approvePaymentRequest'])->name('payment.requests.approve');
// Route::post('/payment-requests/{id}/reject', [RequestController::class, 'rejectPaymentRequest'])->name('payment.requests.reject');

// Route::get('/purchase-requests', [RequestController::class, 'indexPurchaseRequests'])->name('purchase.requests.index');
// Route::get('/purchase-requests/create', [RequestController::class, 'createPurchaseRequest'])->name('purchase.requests.create');
// Route::post('/purchase-requests', [RequestController::class, 'storePurchaseRequest'])->name('purchase.requests.store');
// Route::post('/purchase-requests/{id}/approve', [RequestController::class, 'approvePurchaseRequest'])->name('purchase.requests.approve');
// Route::post('/purchase-requests/{id}/reject', [RequestController::class, 'rejectPurchaseRequest'])->name('purchase.requests.reject');


// ///

// Route::get('/leave-requests', [RequestController::class, 'indexLeaveRequests'])->name('leave.requests.index');
// Route::get('/leave-requests/create', [RequestController::class, 'createLeaveRequest'])->name('leave.requests.create');
// Route::post('/leave-requests', [RequestController::class, 'storeLeaveRequest'])->name('leave.requests.store');
// Route::post('/leave-requests/{id}/approve', [RequestController::class, 'approveLeaveRequest'])->name('leave.requests.approve');
// Route::post('/leave-requests/{id}/reject', [RequestController::class, 'rejectLeaveRequest'])->name('leave.requests.reject');

// Leave Requests
Route::prefix('leave-requests')->group(function () {
    Route::get('/create', [RequestController::class, 'createLeaveRequest'])->name('leave.requests.create');
    Route::post('/', [RequestController::class, 'storeLeaveRequest'])->name('leave.requests.store');
    Route::get('/', [RequestController::class, 'indexLeaveRequests'])->name('leave.requests.index');
    Route::post('/{id}/approve', [RequestController::class, 'approveLeaveRequest'])->name('leave.requests.approve');
    Route::post('/{id}/reject', [RequestController::class, 'rejectLeaveRequest'])->name('leave.requests.reject');
});

// Payment Requests
Route::prefix('payment-requests')->group(function () {
    Route::get('/create', [RequestController::class, 'createPaymentRequest'])->name('payment.requests.create');
    Route::post('/', [RequestController::class, 'storePaymentRequest'])->name('payment.requests.store');
    Route::get('/', [RequestController::class, 'indexPaymentRequests'])->name('payment.requests.index');
    Route::post('/{id}/approve', [RequestController::class, 'approvePaymentRequest'])->name('payment.requests.approve');
    Route::post('/{id}/reject', [RequestController::class, 'rejectPaymentRequest'])->name('payment.requests.reject');
});

// Purchase Requests
Route::prefix('purchase-requests')->group(function () {
    Route::get('/create', [RequestController::class, 'createPurchaseRequest'])->name('purchase.requests.create');
Route::post('/leave-requests', [RequestController::class, 'storeLeaveRequest'])->name('leave.requests.store');    Route::get('/', [RequestController::class, 'indexPurchaseRequests'])->name('purchase.requests.index');
    Route::post('/{id}/approve', [RequestController::class, 'approvePurchaseRequest'])->name('purchase.requests.approve');
    Route::post('/{id}/reject', [RequestController::class, 'rejectPurchaseRequest'])->name('purchase.requests.reject');
});


Route::post('/leave-requests', [RequestController::class, 'storeLeaveRequest'])->name('leave.requests.store');

Route::get('/reports', [ReportController::class, 'index'])->name('Reports.index');


////////// with middle ware 
Route::middleware(['auth'])->group(function () {
    // Leave Requests
    Route::prefix('leave-requests')->group(function () {
        Route::get('/create', [RequestController::class, 'createLeaveRequest'])->name('leave.requests.create');
        Route::post('/', [RequestController::class, 'storeLeaveRequest'])->name('leave.requests.store');
        Route::get('/', [RequestController::class, 'indexLeaveRequests'])->name('leave.requests.index');
        Route::post('/{id}/approve', [RequestController::class, 'approveLeaveRequest'])->name('leave.requests.approve');
        Route::post('/{id}/reject', [RequestController::class, 'rejectLeaveRequest'])->name('leave.requests.reject');
    });

    // Payment Requests
    Route::prefix('payment-requests')->group(function () {
        Route::get('/create', [RequestController::class, 'createPaymentRequest'])->name('payment.requests.create');
        Route::post('/', [RequestController::class, 'storePaymentRequest'])->name('payment.requests.store');
        Route::get('/', [RequestController::class, 'indexPaymentRequests'])->name('payment.requests.index');
        Route::post('/{id}/approve', [RequestController::class, 'approvePaymentRequest'])->name('payment.requests.approve');
        Route::post('/{id}/reject', [RequestController::class, 'rejectPaymentRequest'])->name('payment.requests.reject');
    });

    // Purchase Requests
    Route::prefix('purchase-requests')->group(function () {
        Route::get('/create', [RequestController::class, 'createPurchaseRequest'])->name('purchase.requests.create');
        Route::post('/', [RequestController::class, 'storePurchaseRequest'])->name('purchase.requests.store');
        Route::get('/', [RequestController::class, 'indexPurchaseRequests'])->name('purchase.requests.index');
        Route::post('/{id}/approve', [RequestController::class, 'approvePurchaseRequest'])->name('purchase.requests.approve');
        Route::post('/{id}/reject', [RequestController::class, 'rejectPurchaseRequest'])->name('purchase.requests.reject');
    });
});

Route::get('dashboard/storekeeper', [DashboardController::class, 'storekeeperDashboard'])->name('storekeeper.dashboard');

Route::get('dashboard/employee', [DashboardController::class, 'employeeDashboard'])->name('employee.dashboard');


///////////
use App\Http\Controllers\PayrollController;
Route::resource('payrolls', PayrollController::class);

// Grouping payroll-related routes under the 'payroll' prefix
Route::prefix('payroll')->group(function () {
    Route::get('/', [PayrollController::class, 'index'])->name('payroll.index');
    Route::get('/create', [PayrollController::class, 'create'])->name('payroll.create');
    Route::post('/', [PayrollController::class, 'store'])->name('payroll.store');
    Route::get('/{id}/edit', [PayrollController::class, 'edit'])->name('payroll.edit');
    Route::put('/{id}', [PayrollController::class, 'update'])->name('payroll.update');
    Route::delete('/{id}', [PayrollController::class, 'destroy'])->name('payroll.destroy');
});


////////////////inventorey
use App\Http\Controllers\InventoryController;

Route::get('inventories', [InventoryController::class, 'index'])->name('inventories.index');
Route::get('inventories/create', [InventoryController::class, 'create'])->name('inventories.create');
Route::post('inventories', [InventoryController::class, 'store'])->name('inventories.store');
Route::get('inventories/{inventory_id}/edit', [InventoryController::class, 'edit'])->name('inventories.edit');
Route::put('inventories/{inventory_id}', [InventoryController::class, 'update'])->name('inventories.update');
Route::delete('inventories/{inventory_id}', [InventoryController::class, 'destroy'])->name('inventories.destroy');

Route::get('requests', [RequestController::class, 'index'])->name('requests.index');
Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    /////////////
    use App\Http\Controllers\BudgetController;

Route::resource('budgets', BudgetController::class);


