<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

        protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'is_read'
    ];


    // Assuming sender is always a user (admin/staff)
    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Assuming receiver can be a customer
    public function receiver() {
        return $this->belongsTo(Customer::class, 'receiver_id');
    }


    
}
