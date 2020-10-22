<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'header_id', 'noind', 'hari', 'tanggal', 'kegiatan', 'keterangan'
    ];

    public function header()
    {
        return $this->belongTo(Header::class);
    }
}
