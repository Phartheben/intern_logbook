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

            // $record->touchBusinessId();
            // $record->touchCreatedBy();
            // $record->touchUuid();
            // $record->touchIndex();

            // force to stop. please check if there is any pre/post hook in PropelORM
            throw new \Exception("FIX THIS! creating : ".get_class($record));
        });

        // on update
        static::updating(function ($record) {

            // $record->touchUpdatedBy();

            // force to stop. please check if there is any pre/post hook in PropelORM
            throw new \Exception("FIX THIS! updating : ".get_class($record));
        });

        // after save
        static::saved(function ($record) {

            // force to stop. please check if there is any pre/post hook in PropelORM
            throw new \Exception("FIX THIS! saved : ".get_class($record));
        });
    }
}
