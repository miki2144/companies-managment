<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories'; // Ensure this matches your table name
    protected $primaryKey = 'inventory_id'; // Set the correct primary key if different
    protected $fillable = ['item_name', 
    'quantity', 'description', 
    'stock_in_date',
     'stock_out_date', 
     'managed_by'];

    // Relation to User model for manager
    public function manager()
    {
        return $this->belongsTo(User::class, 'managed_by');
    }

    // Relation to User model for approver
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
