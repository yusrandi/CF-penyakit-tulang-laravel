<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index($userId)
    {
        $user = User::findOrFail($userId);

        return response()->json([
            'responsecode' => '1',
            'responsemsg' => 'Success',
            'data' => $user,
        ], 201);
    }
    public function login(Request $request)
    {

        // return $request;
        $hasher = app()->make('hash');
        $password = $request->password;
        $email = $request->email;

        $login = User::where('email', $email)
            // ->where('hak_akses', '!=', 1)
            ->where('role_id', 3)
            ->first();



        if (!$login) {

            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Maaf Email anda tidak terdaftar',

            ], 201);
        } else {
            if ($hasher->check($password, $login->password)) {


                $update = $login->update([
                    'remember_token' => $request->token,
                    // 'email_verified_at' => $request->token,
                ]);

                if ($update) {
                    return response()->json([
                        'responsecode' => '1',
                        'responsemsg' => 'Selamat datang',
                        'user' => $login
                    ], 201);
                } else {
                    return response()->json([
                        'responsecode' => '0',
                        'responsemsg' => 'Gagal Update Token',
                        'user' => $login
                    ], 201);
                }
            } else {
                return response()->json([
                    'responsecode' => '0',
                    'responsemsg' => 'Maaf password anda salah',

                ], 201);
            }
        }
    }

    public function alluser()
    {
        return response()->json([
            'responsecode' => '1',
            'responsemsg' => 'Success',
            'data' => User::all(),
        ], 201);
    }
    public function insert(Request $request)
    {
        $daftar = User::where('email', $request->email)

            ->orwhere('phone', $request->phone)
            ->first();

        if (!$daftar) {

            $user = User::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'lahir' => $request->lahir,
                'pekerjaan' => $request->pekerjaan,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 3,
            ]);

            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Selamat Bergabung!',
                'data' => $user

            ], 201);
        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Maaf Email atau Nomor anda sudah terdaftar',
                'data' => $daftar
            ], 201);
        }
    }
}
