<?php

namespace App\Models;

use \App\Vetter\Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // ---- constants

    // ---- properties

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role';

    // ---- relationships

    // ---- setters & getters

    // ---- methods

    // ---- resource

    public function toResource($params = [])
    {
        $resource = parent::toResource($params);

        // ---- use this to format output, else remove
        // $tmpResource = [];
        // foreach ($resource as $key => $value) {

        //     switch ($key) {
                // case 'fieldName' :
                //     $key = 'newFieldName';

                //     if ($object = $this->object) {
                //         $value = $object->asIdLabel();
                //     } else {
                //         $value = [];
                //     }
                //     break;
        //     }

            // $tmpResource[$key] = $value;
        // }
        // $resource = $tmpResource;


        // ---- use this to format output from extended keys, else remove
        // $extended = array_get($params, 'extended', []);

        // if ($extended) {
        //     if (in_array('key', $extended)) {
        //         $resource['extended']['key'] = 'resource here';
        //     }
        // }


        return $resource;
    }

    // public function asIdLabel() {
    //     return [
    //         'id' => $this->id,
    //         'label' => ''
    //     ];
    // }

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
