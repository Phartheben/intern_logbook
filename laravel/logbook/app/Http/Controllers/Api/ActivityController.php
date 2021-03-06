<?php
namespace App\Http\Controllers\Api;

use \App\Http\Controllers\AppController;
use \App\Models\Activity;

class ActivityController extends AppController
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

            $model = new \App\Models\Activity;
            $model = $model->where('user_id', '=', \Auth::id())
                           ->where('isactive', '=', 1);
            $data  = $model->paginate();

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

        $data = new \App\Models\Activity;

        // setup validator
        $rules    = [];
        $messages = [];
        $input    = request()->all();

        // rules
        $rules['description'] = 'required';
        $rules['date'] = 'required|date|after:today';
        $rules['date'] = 'required|date';

        // validate
        $validator = \Validator::make($input, $rules, $messages);
        $fails = $validator->fails();

        if (!$fails) {
            try {
                \DB::beginTransaction();

                // ----@ set data here

                $this->bindInput($data, $input);
                $data->user_id = session('myUserId');
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
        // $activity = \App\Models\User::find(\Auth::user_id());

        \Log::debug($id);

        $activity = \App\Models\Activity
                        ::where('user_id', '=', \Auth::id())
                        ->where('id', '=', $id)
                        ->first();

        return view('show', ['activity' => $activity]);
    
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

        $model = new \App\Models\Activity;
        $model = $model->where('id', '=', $id);
        $data  = $model->first();


        if ($data) {

            // setup validator
            $rules    = [];
            $messages = [];
            $input    = request()->all();

            // rules
            // $rules['field']     = 'required';

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

        $model = new \App\Models\Activity;
        $model = $model 
                        ->where('id', '=', $id)
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

            // show error on savings message
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
        $data->description = array_get($input, 'description');
        $data->date = \Carbon\Carbon::parse(array_get($input, 'date'), 'Asia/Kuala_Lumpur');
    }
}
