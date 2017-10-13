<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Models\UserInvite;

use Illuminate\Http\Request;
use Mail;

class UsersController extends ApiController
{

	public function destroyForReSend($email, Request $request)
	{
		$email = decrypt($email);
		
		// Delete User
		User::where('email', $email)->forceDelete();
		
		// User invited
		$row = UserInvite::where('email', $email)->first();

		// Update claimed_at in user_invites
		$row->update(['claimed_at' => null]);
		
        // send the invitation mail
		Mail::send('emails.admin.auth.invite', ['userInvite' => $row],
			function ($message) use ($row) {
				$message->to($row->email, $row->email)
						->subject('Invité par l\'administration ' . config('app.name'));
			});

		return 'Invitation renvoyée à ' . $row->email;
	}
	
}