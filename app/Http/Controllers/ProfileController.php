<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use App\Models\Request;
use App\Models\User;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $item = Lending::where('id_user', Auth::id())
            ->where('status', 'returned')
            ->count();

        $send = Request::where('id_user', Auth::id())
            ->count();

        $approved = Request::where('id_user', Auth::id())
            ->where('status', 'approved')
            ->count();

        return view('index.user.profile', [
            'items' => $item,
            'sends' => $send,
            'approved' => $approved
        ]);
    }

    public function update(HttpRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username' => 'required|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:3',
            'avatar' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if (!isset($validated['avatar'])) {
            $validated['avatar'] = $user->avatar ?? 'avatars/default_profile.jpg';
        }

        if (isset($validated['password']) && !empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function apiUpdate(HttpRequest $request, string $id)
    {
        try {
            $user = User::findOrFail($id);

            // Validate incoming data
            $validated = $request->validate([
                'username' => 'required|max:50',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|min:3',
                'avatar' => 'nullable|image|max:1024',
            ]);

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // Delete old avatar if it exists
                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }
                // Store new avatar
                $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
            } else {
                // Retain current avatar if no new file is uploaded
                $validated['avatar'] = $user->avatar ?? 'avatars/default_profile.jpg';
            }

            // Hash password if provided
            if (isset($validated['password']) && !empty($validated['password'])) {
                $validated['password'] = bcrypt($validated['password']);
            } else {
                unset($validated['password']); // Keep current password if not updated
            }

            // Update user data
            $user->update($validated);

            // Return success response
            return response()->json([
                'message' => 'Profile updated successfully!',
                'user' => $user,
            ], 200);
        } catch (\Exception $e) {
            // Handle errors and return error response
            return response()->json([
                'message' => 'An error occurred while updating the profile.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
