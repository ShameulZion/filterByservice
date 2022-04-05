<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = ['id'];    

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function childs() {
        return $this->hasMany(Category::class,'parent_id','id') ;
    }

    /**
     * Get the Service name for the model.
     *
     * @return string
    */
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function filterProfiles()
    {
        return $this->belongsToMany(FilterProfile::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
