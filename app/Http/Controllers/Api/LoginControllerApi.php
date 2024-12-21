<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\User;

class LoginControllerApi extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        
        $email = $request->input('email');
        $password = $request->input('password');

        // Rate-limiting key
        $rateLimitKey = 'login:' . $email . '|' . $request->ip();

        // Throttle login attempts
        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            return response()->json([
                'error' => 'Too many login attempts. Please try again in ' . RateLimiter::availableIn($rateLimitKey) . ' seconds.',
            ], 429);
        }

        $user = User::where('email', $email)->where('user_type', 3)->first();

        // Verify user and password
        if (!$user || !Hash::check($password, $user->password)) {
            RateLimiter::hit($rateLimitKey, 60); // Record failed attempt (60 seconds decay)
            return response()->json(['error' => 'Invalid credentials.'], 401);
        }

        // Reset rate limit on successful login
        RateLimiter::clear($rateLimitKey);

        // Generate token
        $token = $user->createToken('react-login')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'agent_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token,
            ],
        ])->cookie('token', $token, 60 * 24, '/', null, true, true);
    }

    public function logout(Request $request)
    {
        
        $user = $request->user();
        if (!$user) {
            return response()->json(['error'=> 'User not found'], 404);
        }
        $user->tokens->each(function ($token) {
            $token->delete();
        });
        $cookie = cookie()->forget('token');

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out.',
        ])->cookie($cookie);
    }
}
