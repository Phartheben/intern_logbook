<?php

namespace App\Http\Controllers;

use \App\Http\Requests;
use \App\Http\Controllers\Controller;
use \App\Vetter\Helpers\ResponseHelper;

use \Illuminate\Http\Request;
use \Illuminate\Support\MessageBag;

class AppController extends Controller
{
    private $response;

    private $errors = [];

    public function __construct(Request $request)
    {
        $this->response['response'] = [
            'message' => [
                'code' => 200,
                'description' => 'Success',
            ],
        ];
    }

    protected function setResponseVar($key, $value)
    {
        array_set($this->response, $key, $value);
    }

    protected function setResponseError($error, $key = '400')
    {
        if ($error instanceof MessageBag) {
            foreach ($error->keys() as $key) {
                array_set($this->response, 'response.message.errors.'.$key, $error->first($key));
            }
        } elseif (is_array($error)) {
            foreach (array_keys($error) as $key) {
                array_set($this->response, 'response.message.errors.'.$key, $error[$key]);
            }
        } else {
            array_set($this->response, 'response.message.errors.'.$key, $error);
        }
    }

    protected function setResponseMessage($description, $code = 200)
    {
        array_set($this->response, 'response.message.code', $code);
        array_set($this->response, 'response.message.description', $description);
    }

    protected function getResponseData()
    {
        return $this->response;
    }

    protected function getResponseCode() {
        return array_get($this->response, 'response.message.code', 200);
    }

    protected function cleanJson($resource)
    {
        return ResponseHelper::cleanJson($resource);
    }

    protected function getOrderByParams($params)
    {
        if ($params) {
            $params = explode(';', $params);

            $order = [];
            foreach ($params as $params) {
                $param = explode(':', $params);

                if ($key = array_get($param, 0))
                    $order[$key] = array_get($param, 1) == 'desc' ? 'desc' : 'asc';
            }

            return array_filter($order);
        }

        return [];
    }

    protected function getPrefix()
    {
        return \Request::route()->getPrefix();
    }

    protected function getPerPage($default = 15) {
        $perPage = (int) request('perPage', $default);

        if ($perPage > 200)
            $perPage = 200;

        if (!$perPage || $perPage <= 0)
            $perPage = $default;

        return $perPage;
    }

}
