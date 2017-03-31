<?php
namespace App\Http\Controllers\Api;

use \App\Http\Controllers\AppController;
use Illuminate\Http\Request;

class ProfileController extends AppController
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $businessId = session('myBusinessId');

        try {
            \DB::beginTransaction();

            $data = \App\Models\User::find(\Auth::id());

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

    public function showAvatar()
    {
        $path = storage_path() . '/app/avatars/bfd0987903fe1d3cb8aea6d6bb2ec151.jpeg';
        
        if ($data = \App\Models\User::find(\Auth::id())) {

            if ($data->avatar) {
                $path = storage_path() . '/app/' . $data->avatar;

                if(!\File::exists($path)) {
                    $path = storage_path() . '/app/avatars/bfd0987903fe1d3cb8aea6d6bb2ec151.jpeg';
                }
            }
        }


        $file = \File::get($path);
        $type = \File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function update()
    {
        // $businessId = session('myBusinessId');

        $data = new \App\Models\User;

        // setup validator
        $rules    = [];
        $messages = [];
        $input    = request()->all();

        // rules
        $rules['field'] = 'required';

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

    public function password(Request $request)
    {
        $data = \App\Models\User::find(\Auth::id());

        // setup validator
        $rules    = [];
        $messages = [];
        $input    = request()->all();

        // rules
        $rules['password'] = 'required';

        // validate
        $validator = \Validator::make($input, $rules, $messages);
        $fails = $validator->fails();

        if (!$fails) {
            try {
                \DB::beginTransaction();

                // ----@ set data here
                $data->password = \Hash::make(array_get($input, 'password'));
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

    public function avatar()
    {
        $data = \App\Models\User::find(\Auth::id());

        // setup validator
        $rules    = [
            'avatar' => 'sometimes|file|image'
        ];
        $messages = [];
        $input    = request()->all();

        // validate
        $validator = \Validator::make($input, $rules, $messages);
        $fails = $validator->fails();

        if (!$fails) {
            try {
                \DB::beginTransaction();

                $path = '';
                if (request()->file('avatar')) {
                    $path = request()->file('avatar')->store('avatars');
                }
                $data->avatar = $path;

                $data->save();

                // set data to response
                $this->setResponseVar('response.resource', $data->toResource());

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

    // public function showIns()
    // {
    //     // $activity = \App\Models\User::find(\Auth::user_id());

    //     // \Log::debug($id);

    //     // $institution = \App\Models\Institution
    //     //                 ::where('id', '=', \Auth::id())
    //     //                 ->where('id', '=', $id)
    //     //                 ->first();

    //     return view('showIns', ['institution' => $institution]);
    
    // }



    private function bindInput($data, $input)
    {
        $data->avatar = array_get($input, 'avatar');
    }
}
