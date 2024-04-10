<?php

namespace App\Models;

use App\Http\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model {

    use HasFactory, Filterable, SoftDeletes;


    protected $table      = 'articles';

    protected $primaryKey = 'article_id';

    protected $keyType    = 'int';


    public $incrementing  = true;

    public $timestamps    = true;


    /**
     * Клиент
     *
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    /**
     * Машина
     *
     * @return BelongsTo
     */
    public function bike(): BelongsTo
    {
        return $this->belongsTo(Bike::class, 'bike_id', 'bike_id');
    }


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    protected $fillable = [
        'article_id', 'client_id', 'bike_id', 'article', 'title', 'price', 'additional',
        'created_at', 'updated_at',
    ];

    protected $hidden = [
        'deleted_at',
    ];
}
