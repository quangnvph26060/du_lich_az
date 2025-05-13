<?php

namespace App\Http\Controllers\admin\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginUserRequest;

class AuthController extends Controller
{

    public function login()
    {
       
        return view('auth.login');
    }

    public function authenticate(LoginUserRequest $request)
    {

        $credentials = $request->only(['email', 'password']);

        $remember = $request->boolean('remember');

        if (auth()->guard('admin')->attempt($credentials, $remember)) {

            $account = auth()->guard('admin')->user();

            if ($account->role !== 'admin') {
                auth()->guard('admin')->logout();
                toastr()->error('Bạn không có quyền truy cập vào trang quản lý!');
                return back();
            }

            toastr()->success('Đăng nhập thành công.');

            return redirect()->route('admin.dashboard');
        } else {
            toastr()->error('Tài khoản hoặc mật khẩu không chính xác!');
            return back();
        }
    }

    public function logout()
    {

        auth()->logout();

        toastr()->success('Đăng xuất thành công.');

        return redirect()->route('admin.login');
    }
}
