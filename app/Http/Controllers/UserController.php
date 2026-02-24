<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{

    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(): Response
    {
        return response()->view('features.login',[
                'title' => 'Login | U-Canteen'
            ]);
    }

    public function postLogin(UserRequest $request):RedirectResponse
    {
        try {
            $validate = $request->validated();

            $result = $this->userService->login($validate['username'], $validate['password']);
            if ($result) {
                $find = User::query()->where('username', '=', $validate['username'])->first();
                $request->session()->put([
                    'name' => $find->first_name . $find->last_name,
                    'username' => $find->username
                ]);

                // Redirect berdasarkan role
                if ($find->role === 'admin') {
                    return redirect('/admin');
                }

                return redirect('/');
            }else{
                return redirect('/login')
                    ->with('error', 'Username atau password salah!');
            }
        } catch (ValidationException $exception) {
            return redirect('/login')
                ->with('validate', $exception->errors());
        }
    }

    public function postLogout(): RedirectResponse
    {
        $this->userService->logout();
        return redirect('/login');
    }

    public function register(): Response
    {
        return response()->view('features.register', [
            'title' => 'Register | U-Canteen'
        ]);
    }

    public function postRegister(Request $request): RedirectResponse
    {
        try {
            $validate = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'username' => 'required|unique:users,username',
                'email' => 'required|email:rfc,dns|unique:users,email',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password'
            ], [
                'first_name.required' => 'Nama depan wajib diisi',
                'last_name.required' => 'Nama belakang wajib diisi',
                'username.required' => 'Username wajib diisi',
                'username.unique' => 'Username sudah digunakan',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah digunakan',
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 6 karakter',
                'password_confirmation.required' => 'Konfirmasi password wajib diisi',
                'password_confirmation.same' => 'Konfirmasi password tidak cocok'
            ]);

            $user = new User();
            $user->id = Uuid::uuid4()->toString();
            $user->first_name = trim($validate['first_name']);
            $user->last_name = trim($validate['last_name']);
            $user->username = trim($validate['username']);
            $user->email = trim($validate['email']);
            $user->password = Hash::make($validate['password']);
            $user->save();

            return redirect('/login')
                ->with('success', 'Registrasi berhasil! Silakan login.');

        } catch (ValidationException $exception) {
            return redirect('/register')
                ->withErrors($exception->errors())
                ->withInput();
        }
    }
}

