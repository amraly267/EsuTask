<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

trait ResponseTrait{

    /**
     * Building success response
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($message)
    {
        return Session::flash('success', $message);
    }

    /**
     * Building failed response
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function failedResponse($message)
    {
        return Redirect::back()->withErrors(['message' => $message]);
    }

}
