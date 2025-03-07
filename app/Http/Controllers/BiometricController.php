<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class BiometricController extends Controller
{
    public function validate(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'fingerprints' => 'required|array',
                'fingerprints.*' => 'required|string',
                'email' => 'required|email'
            ]);

            $user = User::where('email', $validatedData['email'])->first();

            if (!$user || !$user->fingerprints) {
                Log::warning('Biometric authentication failed: User not found or no fingerprints', [
                    'email' => $validatedData['email']
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'User not found or no fingerprint data registered'
                ], 404);
            }

            $storedFingerprints = json_decode($user->fingerprints, true) ?? [];
            $isValid = false;

            foreach ($validatedData['fingerprints'] as $fingerprintData) {
                foreach ($storedFingerprints as $storedFingerprint) {
                    if (Hash::check($fingerprintData, $storedFingerprint)) {
                        $isValid = true;
                        break 2;
                    }
                }
            }

            if ($isValid) {
                Auth::login($user, true);
                Log::info('Biometric authentication successful', ['user_id' => $user->id]);

                return response()->json([
                    'success' => true,
                    'redirect' => route('dashboard')
                ]);
            }

            Log::warning('Biometric authentication failed: Invalid fingerprint', [
                'user_id' => $user->id
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Invalid fingerprint data'
            ], 401);

        } catch (\Exception $e) {
            Log::error('Biometric authentication error', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Authentication failed'
            ], 500);
        }
    }
}
