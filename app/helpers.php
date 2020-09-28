<?php
if (function_exists('gettingUser')) {
    function gettingUser($user_id)
    {
        $objUser = \App\Entities\User::find($user_id);
        if(!$objUser) {
            return abort(404);
        }
        return $objUser;
    }
}
