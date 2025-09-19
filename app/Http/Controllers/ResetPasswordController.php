<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPassword\ResetPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show reset password page
     */
    public function index()
    {
        // get logged in user (you can pass any necessary data to view)
        $user = Auth::user();
        $page_data['page_title'] = 'Reset Password';
        $page_data['form_title'] = 'Change Password';

        return view('content.apps.reset_password.index', compact('page_data', 'user'));
    }

    /**
     * Handle password change
     */
    public function save(ResetPasswordRequest $request)
    {
        try {
            $user = Auth::user();

            // Verify old password
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->withInput()->with('error', 'Old password is incorrect.');
            }

            // Prevent reusing same password (optional)
            if (Hash::check($request->password, $user->password)) {
                return redirect()->back()->withInput()->with('error', 'New password cannot be the same as the old password.');
            }

            // Update password
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('reset-password.index')->with('success', 'Password changed successfully.');
        } catch (\Exception $e) {
            // log($e->getMessage()); // optionally log
            return redirect()->back()->withInput()->with('error', 'An error occurred while changing the password.');
        }
    }
}
