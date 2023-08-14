<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Phone extends Model
{
    protected $table = 'phone';

    protected $fillable = ['phone_num', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }}
