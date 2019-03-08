<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DropInReservations extends Model
{
    use SoftDeletes;
    public $table= 'drop_in_reservations';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id';
    public $fillable = [
        'name',
        'telephone',
        'type',
    ];

    protected $casts = [
        'name'=>'string',
        'telephone'=>'string',
        'type'=>'string',
    ];

    public function __construct($input) {
        $this->name=$input['name'];
        $this->telephone=$input['telephone'];
        $this->type=$input['type'];
    }
}
