<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollingUnit extends Model
{
    use HasFactory;

     protected $table = 'polling_unit';
    protected $primaryKey = 'uniqueid';
    public $timestamps = false;

    protected $fillable = [
        'polling_unit_id',
        'ward_id',
        'lga_id',
        'polling_unit_name',
        'polling_unit_number',
        'entered_by_user',
    ];

    public function results()
    {
        return $this->hasMany(AnnouncedPuResult::class, 'polling_unit_uniqueid', 'uniqueid');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'ward_id');
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class, 'lga_id', 'lga_id');
    }

}
