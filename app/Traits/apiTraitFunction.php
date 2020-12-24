<?php

namespace App\Traits;

trait apiTraitFunction {

    /*
     * this function return all
     * error response message
     */
    public function returnResponseError($code , $message = NULL , $statusCode = NULL) {
        return response()->json([
            'code' => $code,
            'status' => FALSE,
            'message' => $message
        ] , $statusCode);
    }

    /*
     * this function return all
     * response with data
     * example registered new user
     */
    public function returnResponseWithData($code , $status , $message = NULL , $key , $value , $statusCode = NULL) {
        return response()->json([
            'code'      => $code,
            'status'    => $status,
            'message'   => $message,
            $key => $value,
        ] , $statusCode);
    }

    /*
     * this function return
     * success messages
     */
    public function returnResponseSuccessMessages($message) {
        return response()->json([
            'message' => $message
        ] , 200);
    }

    /*
     * check the role of user
     * and return boolبlean value ONLY
     */
    public function checkRole($checkRole) {
        if($checkRole->user_id == auth()->id() || auth()->user()->user_level == $this->adminLevel) {
            return true;
        }
        return false;
    }
}

