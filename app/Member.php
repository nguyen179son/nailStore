<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Member extends Model
{
    use SoftDeletes;
    public $table= 'customers';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id';
    public $fillable = [
        'email',
        'point'
    ];

    protected $casts = [
        'email'=>'string',
        'point'=>'integer',
    ];
}
