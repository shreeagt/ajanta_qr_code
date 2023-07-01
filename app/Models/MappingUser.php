<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingUser extends Model
{
    use HasFactory;
    protected $table = 'mapping_user';
    protected $fillable = [
        'mapping_user_id',
        'user_id',        
        'created_at',
        'created_by',
        'updated_at',
        'update_by',
    ];
}
