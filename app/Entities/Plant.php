<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Plant extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['institution_id', 'name', 'description'];

    public function institution(){

      return $this->belongsTo(Institution::class);
    }

    public function valueFromUser(User $user)
    {

      $inflows  = $this->moviments()->plant($this)->applications()->sum('value');
      $outflows = $this->moviments()->plant($this)->outflows()->sum('value');

      return $inflows - $outflows;

    }

    public function moviments(){

      return $this->hasMany(Moviment::class);
    }

}
