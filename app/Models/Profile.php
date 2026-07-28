<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'graduation_year',
        'degree',
        'department',
        'current_company',
        'job_title',
        'location',
        'bio',
        'photo_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}