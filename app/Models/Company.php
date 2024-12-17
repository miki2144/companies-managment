<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    // use HasFactory;

    // Specify the table and primary key
    protected $table = 'companies';
    protected $primaryKey = 'company_id';
    public $incrementing = true; // Change to `true` if the primary key auto-increments
    protected $keyType = 'int';

    protected $fillable = [
        'name', 
        'country', 
        'city', 
        'contact_email', 
        'contact_phone', 
        'created_by',
    ];

    /**
     * A company can have multiple users (admins or others).
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'company_id');
    }
}