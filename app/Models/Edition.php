<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    use HasFactory;
    protected $table = 'editions';
    protected $guarded = false;



    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
