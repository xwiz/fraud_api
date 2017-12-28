<?php

namespace App\Api\Controllers;

use Mail;
use App\Api\Models\User;
use Illuminate\Http\Request;
use App\Api\Models\PasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;

class PasswordResetController extends Controller
{
	public function sendResetLinkEmail(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email|exists:users,email',
		]);

		//invalidate old tokens
		PasswordReset::whereEmail($request->email)->delete();
		
		$email = $request->email;
		$reset = PasswordReset::create([
			'email' => $email,
			'token' => str_random(25),
		]);

		$token = $reset->token;
		Mail::send('resetpassword', compact('email', 'token'), function ($mail) use ($email) {
            $mail->to($email)
            ->from('info@secapay.com')
            ->subject('Your Password reset link');
        });
        
	}


	public function reset(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'token'    => "required|exists:password_resets,token,email,{$request->email}",
            'password' => 'required',
        ]);
        $user = User::whereEmail($request->email)->firstOrFail();
        $user->password = bcrypt($request->password);
        $user->save();
        
        //delete pending resets
        PasswordReset::whereEmail($request->email)->delete();

        return "Password Updated";
    }
}
