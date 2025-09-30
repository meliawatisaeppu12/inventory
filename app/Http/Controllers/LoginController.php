<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordAkun;
use App\Models\Pengguna;
use App\Util\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{

    public function index()
    {
        // untuk halaman login
        return view('login');
    }

    public function verify(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Coba login sebagai admin
        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'admin'
        ])) {
            return redirect()->intended('/admin/dashboard');
        }

        // Coba login sebagai staff
        if (Auth::guard('staff')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'staff'
        ])) {
            return redirect()->intended('/staff/index');
        }

        // Coba login sebagai atasan
        if (Auth::guard('atasan')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'atasan'
        ])) {
            return redirect()->intended('/atasan/dashboard');
        }

        // Jika semua gagal
        return redirect(route('login.index'))->with('pesan', 'Email atau password salah!');
    }
    // function untuk logout
    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('staff')->check()) {
            Auth::guard('staff')->logout();
        } elseif (Auth::guard('atasan')->check()) {
            Auth::guard('atasan')->logout();
        }

        return redirect(route('login.index'));
    }

    public function reset()
    {
        return view('reset');
    }

    public function forgot(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->validate($request, [
            'email' => 'email:rfc,dns',
        ]);

        if (Pengguna::where('email', $request->email)->exists()) {
            $pengguna = Pengguna::where('email', $request->email)->first();
            $token = $this->generateToken(24);

            $pengguna->remember_token = $token;

            try {
                $pengguna->save();

                $email = Helper::encrypt($request->email);
                $reset_token = $pengguna->remember_token;

                $link = route('login.password', [$email, $reset_token]);

                Mail::to($request->email)->send(new ResetPasswordAkun($pengguna->name, $link));

                return redirect(route('login.reset'))->with('success', 'Silahkan cek email Anda untuk melakukan reset');
            } catch (\Exception $e) {
                return redirect(route('login.reset'))->with('error', 'Gagal mengatur ulang password. Pastikan Input email yang tepat');
            }
        } else {
            return redirect(route('login.reset'))->with('pesan', 'Email belum Terdaftar');
        }
    }

    public function password($emailHash, $token)
    {
        date_default_timezone_set('Asia/Jakarta');

        $email = Helper::decrypt($emailHash);
        $pengguna = Pengguna::where('email', $email)->first();

        if ($pengguna->remember_token == $token) {
            return view('renew', compact('emailHash'));
        } else {
            return redirect(route('login.reset'))->with('pesan', 'Token tidak valid');
        }
    }

    public function renew(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
            'new_password' => 'required|same:password',
            'remember_token' => 'required'
        ], [
            'password.min'      => 'Password Minimal 6 Karakter',
            'new_password.same' => 'Konfirmasi Password berbeda!',
        ]);

        $email = Helper::decrypt($request->remember_token);
        $pengguna = Pengguna::where('email', $email)->first();
        $pengguna->password = bcrypt($request->password);

        try {
            $pengguna->save();
            return redirect(route('login.reset'))->with('success', 'Selamat, Password Anda Berhasil Diubah');
        } catch (\Exception $e) {
            return redirect(route('login.renew'))->with('error', 'Gagal mengatur ulang password.');
        }
    }

    private function generateToken($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
