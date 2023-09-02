<?php

namespace App\Models;

use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable= ['content', 'status', 'user_id' ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts= [
        'status' => TaskStatusEnum::class
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function scopeMyTask($query)
    {
        return $query->where('user_id', Auth::id());
    }

    public function scopeFilter($query, $filter)
    {
        return $query->where('status', '!=', $filter );
    }

}
