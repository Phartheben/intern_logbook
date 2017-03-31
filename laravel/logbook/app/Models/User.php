<?php

namespace App\Models;

use \App\Vetter\Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // ---- constants

    // ---- properties

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    // ---- relationships

    // ---- setters & getters

    // ---- methods

    // ---- resource

    public function toResource($params = [])
    {
        $resource = parent::toResource($params);

        return $resource;
    }

    // ---- statics methods

    // ---- queries

    // ---- boot

    public static function boot()
    {
        parent::boot();

        // on create
        static::creating(function ($record) {
        });

        // on update
        static::updating(function ($record) {
        });

        // after save
        static::saved(function ($record) {
        });
    }
}
