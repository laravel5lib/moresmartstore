<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\User;

class Vendor extends Model
{
    use Notifiable;
    protected $fillable = [
        'status',
        'type',
        'user_id',
        'taxid',
        'paymenttype',
        'creditterm',
        'name',
        'address',
        'sub_district',
        'district',
        'province',
        'postal_code',
        'country',
        'description',
        'contractname',
        'imagefile',
        'logofile',
        'phoneno',
        'weburl',
        'facebook',
        'line',
        'email',
        'image_file',
        'logo_file',
        'location_lat',
        'location_lng',
        'businesstype_id',
    ];

    protected $with = ['businesstype'];


    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return url('storage/'.$this->imagefile);
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function businesstype()
    {
        return $this->belongsTo('App\Businesstype');
    }

    /*
	Provide the Location value to the Nova field
	*/
    public function getLocationAttribute()
    {
        return (object) [
            'latitude' => $this->location_lat,
            'longitude' => $this->location_lng,
        ];
    }


    /*
	Transform the returned value from the Nova field
	*/
    public function setLocationAttribute($value)
    {
        $location_lat = round(object_get($value, 'latitude'), 7);
        $location_lng = round(object_get($value, 'longitude'), 7);
        $this->attributes['location_lat'] = $location_lat;
        $this->attributes['location_lng'] = $location_lng;
    }

    // public function posts()
    // {
    //     return $this->hasMany('App\Post');
    // }
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function visits()
    {
        return visits($this);
    }

    public function routeNotificationForMail($notification)
    {
        // Return admin email address only...
        if(auth()->user()->role != 'admin') {
            $adminuser = User::where('role','admin')->first();
            return $adminuser->email;
        }
        return $this->email;

    }
}
