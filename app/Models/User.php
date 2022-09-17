<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'whatsapp_no',
        'gender',
        'address',
        'birth_date',
        'photo_profile',
        'country_id',
        'church_branch_id',
        'role_id',
        'device_token',
        'regency_id'


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role_id',
        // 'device_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function chats()
    {
        return $this->hasMany(Chat::class, 'to_id');
    }

    public function haschats()
    {
        return $this->hasMany(Chat::class, 'from_id');
    }
    public function lastChat()
    {
        return $this->hasMany(Chat::class, 'from_id');
    }


    public function church_branch()
    {
        return $this->belongsTo(ChurchBranch::class, 'church_branch_id', 'id')->with('church');
    }


    public function group()
    {
        return $this->belongsToMany(Group::class, GroupMember::class);
    }
    public function adminGroup()
    {
        return $this->hasMany(GroupAdmin::class, 'user_id');
    }

    public function member()
    {
        return $this->hasMany(GroupMember::class);
    }
    public function memberactive()
    {
        return $this->hasMany(GroupMember::class)->orderBy("id", "DESC")->take(1);
    }
    // Country
    public function country()
    {
        return $this->belongsTo(CountryCode::class, 'country_id', 'id');
    }
    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regency_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }


    public function waitinglist()
    {
        return $this->hasOne(WaitingList::class, 'user_id');
    }


    public function hasRole($role)
    {
        // check param $role dengan field usertype
        if ($role == 2) {
            return true;
        }
        return false;
    }
}
