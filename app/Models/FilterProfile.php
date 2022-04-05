<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function filters()
    {
        return $this->belongsToMany(Filter::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
