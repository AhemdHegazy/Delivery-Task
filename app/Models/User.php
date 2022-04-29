<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'delivery_id',
        'tracking_code',
        'lat',
        'lng',
        'barcode',
        'phone',
        'address',
        'role',
        'status',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getStatusTagsAttribute(){
        return '<button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>'.ucfirst($this->status).'';
    }
    public function getStatusTagAttribute()
    {
        if ($this->status == "new"){
            return '<button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>New <br>
              <button class="btn btn-default btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>Approved ';
        }
        if ($this->status == "approved"){
            return '<button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>New <br>
              <button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>Approved<br>
              <button class="btn btn-default btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>Shipped ';
        }
        if ($this->status == "shipped"){
            return '<button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>New <br>
              <button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>Approved<br>
              <button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>Shipped <br>
              <button class="btn btn-default btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>Out For Delivery ';
        }
        if ($this->status == "outForDelivery"){
            return '<button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>New <br>
              <button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>Approved<br>
              <button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>Shipped <br>
              <button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>Out For Delivery <br>
              <button class="btn btn-default btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>Delivered ';
        }
        if ($this->status == "delivered"){
            return '<button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>New <br>
              <button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>Approved<br>
              <button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>Shipped <br>
              <button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>Out For Delivery <br>
              <button class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">check</i>
              <div class="ripple-container"></div></button>Delivered <br><hr> <h6>Completed Delivery</h6>';
        }
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
