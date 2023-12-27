<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'songs';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'title',
                  'album',
                  'singer_id',
                  'release_year',
                  'song_category_id',
                  'file'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the singer for this model.
     *
     * @return App\Models\Singer
     */
    public function singer()
    {
        return $this->belongsTo('App\Models\Singer','singer_id');
    }

    /**
     * Get the songCategory for this model.
     *
     * @return App\Models\SongCategory
     */
    public function songCategory()
    {
        return $this->belongsTo('App\Models\SongCategory','song_category_id');
    }



}
