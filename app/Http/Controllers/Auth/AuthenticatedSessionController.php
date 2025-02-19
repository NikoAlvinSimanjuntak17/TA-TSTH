<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;


class AuthenticatedSessionController extends Controller
{
//     public function authenticated(Request $request, $user)
// {
//     if ($user->hasRole('admin')) {
//         return redirect()->intended('/admin-dashboard');
//     } else if ($user->hasRole('user')) {
//         return redirect()->intended('/user-dashboard');
//     }
// }
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }
    
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ], 200);
    }
    
    protected function sendFailedLoginResponse(Request $request): void
{
    throw ValidationException::withMessages([
        'message' => 'Username atau password Anda salah.',
    ]);
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        $request->user()->tokens()->delete(); // Hapus semua token pengguna
    
        return response()->json([
            'message' => 'Logout successful',
        ], 200);
    }
    
}
