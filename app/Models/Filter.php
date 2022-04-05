<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    public function filterProfiles()
    {
        return $this->belongsToMany(FilterProfile::class);
    }

    public function filterGroups()
    {
        return $this->hasMany(filterGroup::class);
    }
}
