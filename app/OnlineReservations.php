<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineReservations extends Model
{
    use SoftDeletes;
    public $table= 'online_reservations';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id';
    public $fillable = [
        'mobile',
        'telephone',
        'email',
        'reservations_time',
        'service_type',
        'duration',
        'notice',
        'mail_number',
        'customer_name'
    ];

    protected $casts = [
        'mobile'=>'string',
        'telephone'=>'string',
        'email'=>'string',
        'reservations_time'=>'datetime',
        'service_type'=>'string',
        'duration'=>'integer',
        'notice'=>'string',
        'mail_number'=>'string',
        'customer_name'=>'string',
        'type' => 'string'
    ];
}
