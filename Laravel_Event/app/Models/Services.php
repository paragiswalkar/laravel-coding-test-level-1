<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Services extends Model
{
    use HasFactory,SoftDeletes, Notifiable;

    protected $table = 'tbl_services';

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

    public function locations()
    {
        return $this->belongsToMany(Locations::class, 'tbl_service_locations');
    }
}
