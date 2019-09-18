<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Moviment extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['user_id', 'group_id', 'plant_id', 'value','type'];

    public function scopePlant($query, $plant)
    {
      return $query->where('plant_id', $plant->id);
    }
    public function scopeApplications($query)
    {
      return $query->where('type', 1);
    }

    public function scopeOutflow($query){
      return $query->where('type', 2);
    }

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function group(){
      return $this->belongsTo(Group::class);
    }

    public function plant(){
      return $this->belongsTo(Plant::class);
    }
}
