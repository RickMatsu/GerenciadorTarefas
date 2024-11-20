<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'status'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = 'tasks';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    

    // Relacionamento com usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
