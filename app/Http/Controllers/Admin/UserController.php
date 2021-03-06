<?php
namespace App\Http\Controllers\Admin;

use App\Entities\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = (new User())->get();
        $params = [
            'users' => $users,
        ];
        return view('admin.users.index', $params);
    }
}