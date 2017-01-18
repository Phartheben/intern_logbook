<?php
namespace App\Http\Controllers\Api;

use \App\Http\Controllers\AppController;

class UserController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $businessId = session('myBusinessId');

        try {
            \DB::beginTransaction();

            $model = new \App\Models\User;
            $model = $model->where('isactive', '=', 1);
            $data  = $model->paginate(null);

            $this->setResponseVar('response.meta', \DBHelper::toMeta($data));
            $this->setResponseVar('response.resources', \DBHelper::toResource($data));

            \DB::commit();
        } catch (Exception $e) {
            \DB::rollback();

            $this->setResponseMessage($e->getMessage(), 400);
        }

        return response()->json($this->getResponseData(), $this->getResponseCode());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // $businessId = session('myBusinessId');

        $data = new \App\Models\User;

        // setup validator
        $rules    = [];
        $messages = [];
        $input    = request()->all();

        // rules
        $rules['email']     = 'required|email';

        // validate
        $validator = \Validator::make($input, $rules, $messages);
        $fails = $validator->fails();

        if (!$fails) {
            try {
                \DB::beginTransaction();

                // ----@ set data here

                $this->bindInput($data, $input);
                $data->save();

                // set data to response
                $this->setResponseVar('response.resource', \DBHelper::toResource($data));

                // show success message
                $this->setResponseMessage(trans('messages.scope.created'));

                \DB::commit();
            } catch (Exception $e) {
                \DB::rollback();
                $fails = true;
            }
        } else {
            // add response errors
            $this->setResponseError($validator->errors());
        }

        // show error on savings message
        if ($fails) {
            $this->setResponseMessage(trans('messages.error-on-save'), 400);
        }

        return response()->json($this->getResponseData(), $this->getResponseCode());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $businessId = session('myBusinessId');

        try {
            \DB::beginTransaction();

            $model = new \App\Models\User;
            $model = $model
                        ->where('id', '=', $id)
                        ->where('isactive', '=', 1);
            $data  = $model->first();

            if ($data) {
                $this->setResponseVar('response.resource', \DBHelper::toResource($data));
            } else {
                $this->setResponseMessage(trans('messages.not_found'), 404);
            }

            \DB::commit();
        } catch (Exception $e) {
            \DB::rollback();

            $this->setResponseMessage($e->getMessage(), 400);
        }

        return response()->json($this->getResponseData(), $this->getResponseCode());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        // $businessId = session('myBusinessId');

        $model = new \App\Models\User;
        $model = $model->where('id', '=', $id);
        $data  = $model->first();

        if ($data) {

            // setup validator
            $rules    = [];
            $messages = [];
            $input    = request()->all();

            // rules
            $rules['email']     = 'required|email';
            $rules['firstname'] = 'required';
            $rules['lastname']  = 'required';            

            // validate
            $validator = \Validator::make($input, $rules, $messages);
            $fails = $validator->fails();

            if (!$fails) {
                try {
                    \DB::beginTransaction();

                    $this->bindInput($data, $input);
                    $data->save();

                    // show success message
                    $this->setResponseMessage(trans('messages.scope.updated'));

                    \DB::commit();
                } catch (Exception $e) {
                    \DB::rollback();
                    $fails = true;
                }
            } else {
                // add response errors
                $this->setResponseError($validator->errors());
            }

            // show error on savings message
            if ($fails) {
                $this->setResponseMessage(trans('messages.error-on-save'), 400);
            }

            // set data to response
            $this->setResponseVar('response.resource', \DBHelper::toResource($data));
        } else {
            // show record not found message
            $this->setResponseMessage(trans('messages.not_found'), 404);
        }

        return response()->json($this->getResponseData(), $this->getResponseCode());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $businessId = session('myBusinessId');

        $model = new \App\Models\User;
        $model = $model->where('id', '=', $id)
                       ->where('isactive', '=', 1);           
        $data  = $model->first();

        if ($data) {
            $fails = false;

            try {
                \DB::beginTransaction();

                $data->isactive = 0;
                $data->save();

                // show success message
                $this->setResponseMessage(trans('messages.scope.deleted'));

                \DB::commit();
            } catch (Exception $e) {
                \DB::rollback();
                $fails = true;
            }

            // show error on savings messag
            if ($fails) {
                $this->setResponseMessage(trans('messages.error-on-delete'), 400);
            }
        } else {
            // show record not found message
            $this->setResponseMessage(trans('messages.not_found'), 404);
        }

        return response()->json($this->getResponseData(), $this->getResponseCode());
    }

    private function bindInput($data, $input)
    {
        $data->email     = array_get($input, 'email');
        $data->firstname = array_get($input, 'firstname');
        $data->lastname  = array_get($input, 'lastname');

    }
}
