<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class UserAuthController extends Controller
{

    public function SignUpPage()
    {
        $binding = [
            'title' => '註冊',
            'note' => '使用者註冊頁面'
        ];
        return view('auth.signup', $binding);
    }

    public function SignUpProcess()
    {
        $input = request()->all();
        print_r($input);

        if ($input['nickname'] == '') {
            print('暱稱不得為空');
            return redirect('/user/auth/signup')
                ->withErrors(['暱稱不得為空']);
        }
    }
}
