<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveChatMessage extends Model
{
    // The name of the table associated with the model
    protected $table = 'live_chat_messages'; // Adjust the table name if necessary

    // The attributes that are mass assignable
    protected $fillable = [
        'user_id', 
        'message', 
        'sent_at',
        // Add other fields based on your table structure
    ];

    // The attributes that should be hidden for arrays
    protected $hidden = [
        'created_at', 
        'updated_at',
        // Add other fields that should be hidden
    ];

    // Define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class); // Assuming a relationship to the User model
    }
}
