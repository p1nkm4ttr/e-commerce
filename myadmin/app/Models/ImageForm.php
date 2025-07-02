<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageForm extends Model
{
    use HasFactory;

    protected $table = 'imageform';
    
    protected $guarded = [
        'id'
    ];
}
