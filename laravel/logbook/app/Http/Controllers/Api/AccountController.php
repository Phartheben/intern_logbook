<?php
namespace App\Http\Controllers\Api;

use \App\Http\Controllers\AppController;

class AccountController extends AppController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signUp()
    {
        // $businessId = session('myBusinessId');

        $data = new \App\Models\User;

        // setup validator
        $rules    = [];
        $messages = [];
        $input    = request()->all();

        // rules
        $rules['firstname'] = 'required';
        $rules['lastname']  = 'required';
        $rules['email']     = 'required|email';
        $rules['password']  = 'required';


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


    private function bindInput($data, $input)
    {
        $data->firstname = array_get($input, 'firstname');
        $data->lastname  = array_get($input, 'lastname');
        $data->email     = array_get($input, 'email');
        $data->password  = \Hash::make(array_get($input, 'password'));
    }
}
