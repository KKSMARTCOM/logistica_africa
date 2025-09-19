<?php

namespace App\Models;

use App\Traits\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Machine extends Model
{
    use HasFactory, GeneratesUuid, Notifiable;

    protected $fillable = [
        'name',
        'description',
        'image',
        'additionnal_images',
        'price',
        'characteristics',
        'category_id'
    ];

    protected $table = 'machines';

    protected $primaryKey = 'id';

    protected $casts = [
        'characteristics' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
