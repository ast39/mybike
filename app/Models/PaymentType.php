<?php

namespace App\Models;

use App\Http\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentType extends Model {

    use HasFactory, Filterable, SoftDeletes;


    protected $table      = 'payment_types';

    protected $primaryKey = 'type_id';

    protected $keyType    = 'int';


    public $incrementing  = true;

    public $timestamps    = true;


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    protected $fillable = [
        'type_id', 'title', 'created_at', 'updated_at',
    ];

    protected $hidden = [
        'deleted_at',
    ];
}
