<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Event extends Model
{
    use HasFactory, Uuids, SoftDeletes, Notifiable;

    protected $fillable = [
        'id','name', 'slug','start_date','end_date'
    ];

    /**
     * The validation rules
     *
     * @var array $rules
     */
    protected $rules = [
        'name' => ['required'],
        'start_date' => ['required'],
        'end_date' => ['required'],
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array $dates
     */
    public $dates = ['deleted_at'];

    /**
     * The validation error messages.
     *
     * @var array $messages
     */
    protected $messages = [
        'name.required' => 'You must at give a name for your event.',
    ];

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * Boot the model.
     */
    public static function boot()
    {
        parent::boot();

        // registering a callback to be executed upon the creation of an activity AR
        static::created(function ($event) {
            $event->slug = $event->createSlug($event->name);
            $event->save();
        });

    }
  
    /** 
     * Write code on Method
     *
     * @return response()
     */
    private function createSlug($name){
        if (static::whereSlug($slug = \Str::slug($name))->exists()) {
            $max = static::whereTitle($name)->latest('id')->skip(1)->value('slug');
  
            if (is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
  
            return "{$slug}-2";
        }
  
        return $slug;
    }

     /**
     * The attributes that should be mutated to dates.
     *
     * @return array $dates
     */
    public function getDates()
    {
        return ['created_at', 'updated_at', 'start_date', 'end_date'];
    }
}
