<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client; // <--- untuk ssl

class GoogleAuthController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirect()
    {
        $intent = request()->query('intent', 'login');
        session(['google_auth_intent' => $intent]);
        
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account']) // <--- INI KUNCI BIAR MUNCUL PILIH AKUN
            ->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->setHttpClient(new Client(['verify' => false])) 
                ->user();
            // -------------------------------------

            $intent = session('google_auth_intent', 'login');
            
            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();
            
            // LOGIKA REGISTER
            if ($intent === 'register') {
                if ($user) {
                    return redirect()->route('login')
                        ->with('error', 'Akun sudah terdaftar. Silakan login.');
                }
                
                // Create new user
                $newUser = User::create([
                    'nama' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(32)),
                    'email_verified_at' => now(),
                    'role' => 'user',
                ]);
                
                return redirect()->route('login')
                    ->with('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');
            }
            
            // LOGIKA LOGIN
            if (!$user) {
                return redirect()->route('login')
                    ->with('error', 'Akun belum terdaftar. Silakan daftar terlebih dahulu.');
            }
            
            // Update google_id if not set
            if (!$user->google_id) {
                $user->google_id = $googleUser->getId();
            }
            
            // Ensure email is verified
            if (!$user->email_verified_at) {
                $user->email_verified_at = now();
            }
            
            $user->save();
            
            Auth::login($user);
            return redirect()->intended('/dashboard')
                ->with('success', 'Berhasil masuk dengan Google!');
            
        } catch (\Exception $e) {
            Log::error('Google OAuth Error: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}