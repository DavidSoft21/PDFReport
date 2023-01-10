<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PDF extends Model
{
    protected $table = 'pdf';
    protected $fillable = [
        'pdf_code',
        'title',
        'state'
    ];
}
