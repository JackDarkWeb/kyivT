<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UnderCategory extends Model
{
    public $timestamps = true;

    protected $table = 'under_categories';

    protected $fillable = [
        'name',
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
