<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordAkun;
use App\Models\pengguna;
use App\Util\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            return redirect()->intended('/staff/dashboard');
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

    // 1️⃣ Form lupa password
    public function forgot()
    {
        return view('forgot-password');
    }

    // 2️⃣ Kirim link reset via email
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = pengguna::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        $resetLink = route('password.reset', $token);

        Mail::send('emails.reset-password', ['resetLink' => $resetLink], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password Akun Anda');
        });

        return back()->with('success', 'Link reset password telah dikirim ke email Anda.');
    }

    // 3️⃣ Tampilkan form reset password
    public function showResetForm($token)
    {
        $record = DB::table('password_resets')->where('token', $token)->first();

        if (!$record) {
            return redirect()->route('login.index')->with('error', 'Token tidak valid atau sudah kadaluarsa.');
        }

        $emailHash = $record->email;

        return view('reset-password', compact('emailHash'));
    }

    // Proses ubah password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|same:new_password',
            'new_password' => 'required|min:6'
        ]);

        $email = $request->remember_token; // ini email yang dikirim dari form

        $user = pengguna::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where('email', $email)->delete();

        return redirect()->route('login.index')->with('success', 'Password berhasil diubah. Silakan login kembali.');
    }
}
