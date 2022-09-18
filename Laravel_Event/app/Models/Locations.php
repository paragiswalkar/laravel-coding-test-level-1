<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Locations extends Model
{
    use HasFactory,SoftDeletes, Notifiable;

    protected $table = 'tbl_locations';

    protected $fillable = [
        'id','name'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array $dates
     */
    public $dates = ['deleted_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @return array $dates
     */
    public function getDates()
    {
        return ['created_at', 'updated_at'];
    }

    public function documents()
    {
        return $this->belongsToMany(Documents::class,'tbl_service_location_documents');
    }
}
