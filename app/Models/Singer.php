<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'singers';

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
                  'name',
                  'gender',
                  'music_type',
                  'is_retired'
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
     * Set the music_type.
     *
     * @param  string  $value
     * @return void
     */
    public function setMusicTypeAttribute($value)
    {
        $this->attributes['music_type'] = json_encode($value);
    }

    /**
     * Get music_type in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getMusicTypeAttribute($value)
    {
        return json_decode($value) ?: [];
    }

}
