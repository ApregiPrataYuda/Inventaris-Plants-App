<?php

use Illuminate\Support\Facades\Session;
use App\Models\users;

if (! function_exists('getUserData')) {
    function dataUser()
    {
        $userId = Session::get('id_user');
        if ($userId) {
            return users::find($userId);
        }
        return null;
    }
}