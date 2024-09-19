<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersDataAnswer extends Model
{
    protected $table = 'users_data_answer';

    protected $fillable = [
        'id',
        'user_id',
        'question_id',
        'answer',
        'explain',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
