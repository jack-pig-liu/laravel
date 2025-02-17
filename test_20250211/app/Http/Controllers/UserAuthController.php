<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Hash;
use App\Shop\Entity\User;
use Illuminate\Support\Facades\Mail;

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
                ->withErrors(['暱稱不得為空', '請重新輸入'])
                ->withInput();
        } else if ($input['password'] == '') {
            print('密碼不得為空');
            return redirect('/user/auth/signup')
                ->withErrors(['密碼不得為空', '請重新輸入'])
                ->withInput();
        } else if (User::where('email', $input['email'])->count() > 0) {
            return redirect('/user/auth/signup')
                ->withErrors(['帳號已經被註冊', '請重新輸入'])
                ->withInput();
        } else {
            $input['password'] = Hash::make($input['password']);
            User::create($input);

            Mail::send(
                'email.signUp',
                ['nickname' => $input['nickname']],
                function ($message) use ($input) {
                    $message->to($input['email'], $input['nickname'])
                        ->from('gtaped14876@gmail.com')
                        ->subject('恭喜恭喜 恭喜你註冊成功');
                }
            );
        }
    }

    public function SignInPage()
    {
        $binding = [
            'title' => '登入',
            'note' => '使用者登入頁面'
        ];
        return view('auth.signin', $binding);
    }

    public function SignInProcess()
    {
        $input = request()->all();
        print_r($input);

        //  將登入邏輯寫進去
        // 1. 判斷資料庫裏面有沒有該帳號
        // 2. 若有該帳號則判斷密碼加密後是否一致
        $tmpuser = User::where('email', $input['email'])->first();
        // dd($tmpuser);
        if (is_null($tmpuser)) {
            return redirect('/user/auth/signin')
                ->withErrors(['查無此帳號', '請重新輸入'])
                ->withInput();
        } else {
            $after_password = Hash::make($input['password']);
            if ($tmpuser['password'] === $after_password) {
                return redirect('/user/auth/signin')
                    ->withErrors(['密碼正確', '請重新輸入'])
                    ->withInput();
            } else {
                return redirect('/user/auth/signin')
                    ->withErrors(['密碼錯誤', '請重新輸入'])
                    ->withInput();
            }
        }
    }
}
