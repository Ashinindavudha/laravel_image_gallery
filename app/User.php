<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar') ->acceptsFile(function (File $file) {
            return $file->mimeType === 'image/jpeg';
        })
        ->registerMediaConversions(function(Media $media){
            $this->addMediaConversion('card')
            ->width(400)
            ->height(300);
             $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100);
        });
        
    }
    public function avatar()
    {
        return $this->hasOne(Media::class, 'id', 'avatar_id');
    }
    public function getAvatarUrlAttribute()
    {
        return $this->avatar->getUrl('thumb');
    }
}
