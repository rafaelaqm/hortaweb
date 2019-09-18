<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class UserSocial extends Model
{
  use SoftDeletes;
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  public $timestamps = true;
  protected $table = 'users';
  protected $fillable = ['user_id', 'social_network', 'social_id', 'social_email', 'social_avatar'];
  protected $hidden = [];
}
