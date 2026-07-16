<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

class ForgotPasswordController extends Controller
{
 
    public function showLinkRequestForm()
{
    return view('auth.forgot-password', [
        'back_url' => url('/login'),            
        'back_text' => 'Back to Login'     
    ]);
}

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

       
        $token = Str::random(64);

       
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        
        try {
           Mail::send('admin.emails.password_reset', ['token' => $token], function($message) use($request){
    $message->to($request->email);
    $message->subject('Reset Password Notification');
});
            return back()->with('status', 'We have emailed your password reset link!');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Mail sending failed: ' . $e->getMessage()]);
        }
    }
public function showResetForm($token) {
    return view('auth.forgot-password-link', [
        'token' => $token,
        'back_url' => url('/login'),            
        'back_text' => 'Back to Login'     
    ]);
}


public function submitResetForm(Request $request) {
    $request->validate([
        'token'=>'required',
        'email' => 'required|email|exists:users,email',
        'password' => 'required|string|min:6|confirmed',
        'password_confirmation' => 'required'
    ]);


    $passwordReset = DB::table('password_reset_tokens')
        ->where([
            'email' => $request->email,
            'token' => $request->token
        ])
        ->where('created_at','>',Carbon::now()->subHours(1))
        ->first();

    if(!$passwordReset){
        return back()->withErrors(['email' => 'Invalid token or email!']);
    }


    $user = User::where('email', $request->email)->first();
    $user->update(['password'=>bcrypt($request->password)]);

    // $user->password = bcrypt($request->password);
    // $user->save();

    DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

    return redirect('/login')->with('status', 'Your password has been successfully reset! Please login.');
}
}
