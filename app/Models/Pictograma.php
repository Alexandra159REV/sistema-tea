<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pictograma extends Model
{
    protected $table = 'pictogramas';


    protected $fillable = [
        'Title',
        'ImagePath',
        'CategoryId',
        'SearchText',
        'Embedding',
        'EmbeddingModel'
    ];
}