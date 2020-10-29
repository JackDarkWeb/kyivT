<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    public $timestamps = true;

    protected $table = 'products';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'promotion',
        'image'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @return BelongsToMany
     */
    function categories(){
        return $this->belongsToMany(Category::class);
    }
}
