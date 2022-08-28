<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelLink extends Model
{
    protected $table = 'link';
    protected $fillable = ['user_id','link','institution','created_at'];


    public function relUser()
    {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function getFullInstitutionAttribute($value)
	{
	    return $value;
	}
	public function getIconAttribute($value)
	{
	    return $value;
	}
	public function getAccessModeAttribute($value)
	{
	    return $value;
	}
	public function getStatusAttribute($value)
	{
	    return $value;
	}
}
