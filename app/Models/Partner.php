<?php

namespace App\Models;

use App\Traits\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Partner extends Model
{
    use HasFactory, GeneratesUuid, Notifiable;

    protected $fillable = ['name', 'image', 'website_url', 'status'];

    protected $table = 'partners';

    protected $primaryKey = 'id';
}
