<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Api response standardization
 * 
 * @author Massimo Nicolardi
 * */
trait ApiResponse {
       
    /**
     * Success Response
     *
     * @param  mixed $data
     * @param  mixed $message
     * @param  mixed $code
     * @return Response
     */
    protected function successResponse($data, $message = null, $code = 200): JsonResponse
	{
		return response()->json([
			'status'=> 'OK', 
			'message' => $message, 
			'data' => $data
		], $code);
	}
	
	/**
	 * Error Response
	 *
	 * @param  mixed $message
	 * @param  mixed $code
	 * @return void
	 */
	protected function errorResponse($message = null, $code=401): JsonResponse
	{
		return response()->json([
			'status'=>'ERROR',
			'message' => $message,
			'data' => null
		], $code);
	}
}