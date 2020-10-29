<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public $timestamps = true;

    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @return BelongsTo
     */
    function products(){
        return $this->belongsTo('products', 'categories');
    }

    /**
     * @return HasMany
     */
    function under_categories(){
        return $this->hasMany(UnderCategory::class);
    }
}
