<?php
namespace App\Vetter\Helpers;

class DBHelper
{
    public static function toResource($resources, $params = [])
    {
        $arr = [];

        if ($resources instanceof \Illuminate\Database\Eloquent\Collection ||
            $resources instanceof \Illuminate\Pagination\LengthAwarePaginator) {

            foreach ($resources as $resource) {
                $arr[] = $resource->toResource($params);
            }
        } else {
            $arr = $resources->toResource($params);
        }

        return $arr;
    }

    public static function toMeta($resources) {
        $arr = [];

        if ($resources instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $arr['total']       = $resources->total();
            $arr['perPage']     = $resources->perPage();
            $arr['currentPage'] = $resources->currentPage();
            $arr['lastPage']    = $resources->lastPage();
            $arr['nextPageUrl'] = $resources->nextPageUrl();
            $arr['prevPageUrl'] = $resources->previousPageUrl();
            $arr['from']        = $resources->firstItem();
            $arr['to']          = $resources->lastItem();
        }

        return $arr;
    }

    public static function lastQuery() {
        $queries = \DB::getQueryLog();

        $sql = end($queries);

        if(! empty($sql['bindings'])) {
            $pdo = \DB::getPdo();
            foreach($sql['bindings'] as $binding) {
                $sql['query'] = preg_replace('/\?/', $pdo->quote($binding), $sql['query'], 1);
            }
        }

        return $sql['query'];
    }

}

