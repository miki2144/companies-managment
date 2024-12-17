<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $table = 'payroll';  // Specifies the table name

    protected $fillable = [
        'user_id',
        'pay_period',
        'basic_salary',
        'allowances',
        'deductions',
        'net_salary',
        'status',
        'Prepared_by',
        'approved_by',
    ];

    // Define relationships (optional, assuming 'users' table exists)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function preparedBy()
    {
        return $this->belongsTo(User::class, 'Prepared_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    // Add the 'company_id' relationship
public function company()
{
    return $this->belongsTo(Company::class); // Assuming 'Company' is a model for companies
}

}
