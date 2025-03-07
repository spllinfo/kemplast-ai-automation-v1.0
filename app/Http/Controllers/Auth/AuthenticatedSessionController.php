<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
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
    public function store(LoginRequest $request): RedirectResponse
    {
        try {

            $request->authenticate();

            $request->session()->regenerate();

            // Log successful login
            Log::info('User logged in successfully', ['email' => $request->email]);

            return redirect()->intended(route('dashboard'))->with('status', 'Welcome back!');
        } catch (ValidationException $e) {
            Log::warning('Login validation failed', ['email' => $request->email, 'error' => $e->getMessage()]);
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => $e->getMessage(),
                ]);
        } catch (\Exception $e) {
            Log::error('Login error occurred', ['email' => $request->email, 'error' => $e->getMessage()]);
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => 'An error occurred during login. Please try again.',
                ]);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
