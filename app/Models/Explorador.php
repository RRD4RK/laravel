<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explorador extends Model{

    use HasFactory;

    protected $fillable =[
        'name',
        'idade',
        'latitude',
        'longitude',
        'inventario',
    ];
    protected $table = "explorers";

}
