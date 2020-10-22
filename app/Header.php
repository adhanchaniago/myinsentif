<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'noind', 'bulan', 'atasan', 'tahun',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function daily()
    {
       return $this->hasMany(Daily::class);
    }
}
