<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncedLgaResult extends Model
{
    use HasFactory;
    
    protected $table = 'announced_lga_results';
    protected $primaryKey = 'result_id';
    public $timestamps = false;

}
