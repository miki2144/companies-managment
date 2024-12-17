<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetForecasting extends Model
{
    use HasFactory;

    protected $table = 'budget_forecasting'; // Custom table name
    protected $primaryKey = 'Budget_id'; // Custom primary key

    protected $fillable = [
        'created_by', 
        'forecast_period', 
        'forecast_amount', 
        'actual_amount', 
        'description', 
        'comment', 
        'approved_by'
    ];

    // Relationships
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
