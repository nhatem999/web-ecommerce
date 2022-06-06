<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Notifications\Notifiable;
class Account extends Model implements 
\Illuminate\Contracts\Auth\Authenticatable
{
    use AuthenticableTrait;
     use Notifiable;
    use SoftDeletes;
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // function pages() {
    //     return $this->hasMany('App\Models\Page', 'user_id', 'id');
    // }

    // function role() {
    //     return $this->belongsTo('App\Models\Role', 'role_id');
    // }

    // public function hasPermission(Permission $permission) {
    //     return !!optional(optional($this->role)->permissions)->contains($permission);
    // }
}
