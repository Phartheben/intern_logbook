<?php

namespace App\Vetter\Illuminate\Database\Eloquent;

class Model extends \Illuminate\Database\Eloquent\Model {

    // ---- method

    public function isNew() {
        $primaryKey = $this->primaryKey;

        return $this->exists ? false : true;
    }

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function hasAttribute($name) {
        $columns = $this->getTableColumns();

        return in_array($name, $columns);
    }

    // ---- resource

    public function toResource ($params = []) {
        $resource = [];

        $only   = array_get($params, 'only', []);
        array_walk($only, function (&$value, $index) {
            $value = trim(snake_case($value));
        });

        $except = array_get($params, 'except', []);

        foreach (array_keys($this->getAttributes()) as $column) {

            if (in_array($column, $this->getHidden())) {
                continue;
            }

            if (in_array($column, $except)) {
                continue;
            }

            if ($only && !in_array($column, $only)) {
                continue;
            }

            $key = camel_case($column);

            if (starts_with($column, '_')) {
                continue;
            }

            if ($key == 'isactive') {
                $key = 'isActive';
            }

            if (in_array($column, array_merge($this->dates, [self::CREATED_AT, self::UPDATED_AT]))) {
                $resource[$key] = \DateTimeHelper::toIso8601String($this->$column);
            } else {
                $resource[$key] = $this->$column === null ? '' : $this->$column;
            }
        }

        return $resource;
    }

    // ---- boot

    public static function boot()
    {
        parent::boot();

        static::creating(function ($record) {
        });
    }

}
