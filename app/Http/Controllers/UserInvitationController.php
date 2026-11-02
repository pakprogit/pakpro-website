<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserInvitationController extends Controller
{
    public function show(string $token)
    {
        $user = User::where('invitation_token', $token)->firstOrFail();

        if ($user->invitation_expires_at && Carbon::now()->greaterThan($user->invitation_expires_at)) {
            return response()->view('auth.invitation-expired', [], 410);
        }

        return view('auth.invitation-accept', compact('user', 'token'));
    }

    public function process(Request $request, string $token)
    {
        $user = User::where('invitation_token', $token)->firstOrFail();

        if ($user->invitation_expires_at && Carbon::now()->greaterThan($user->invitation_expires_at)) {
            return response()->view('auth.invitation-expired', [], 410);
        }

        $request->validate([
            'name' => 'required|string|max:150',
            'password' => [
                'required',
                'confirmed',
                Password::min(12)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ]);

        $user->name = $request->input('name');
        $user->password = Hash::make($request->input('password'));
        $user->password_hash = $user->password;
        $user->invitation_token = null;
        $user->invitation_expires_at = null;
        $user->email_verified_at = Carbon::now();
        $user->is_active = true;
        $user->save();

        return redirect('/admin/login')->with('status', 'Your account has been activated! Please log in with your credentials.');
    }
}

