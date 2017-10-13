<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use App\Models\UserInvite;
use Illuminate\Http\Request;
use Titan\Controllers\TitanController;

use Mail;

class RegisterController extends TitanController
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('web');//'guest');
    }

    /**
     * Show the application registration form.
     *
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm($token)
    {
        $this->title = 'S\'enregistrer';

        // check if token is valid
        $row = UserInvite::whereToken($token)->whereNull('claimed_at')->first();
        if (!$row) {
            alert()->error('Oops!', 'Le jeton n\'est pas valide pour cet enregistrement.');
            return redirect(route('login'));
        }

        return $this->view('auth.register')->with('token', $token)->with('email', $row->email);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
		$this->validate($request, User::$rules, []);

		$genderImage = (input('gender') == 'Mme') ? 'female.png' : 'male.png';
        // create new user
        $user = User::create([
            'firstname'          => input('firstname'),
            'lastname'           => input('lastname'),
            'gender'             => input('gender'),
            'email'              => input('email'),
			'image'				 => $genderImage,
            'password'           => bcrypt(input('password')),
            'confirmation_token' => null,
        ]);
		
		// Save Roles User
		$userRoles = UserInvite::where('email', input('email'))->first()->roles;
		$user->roles()->sync(json_decode($userRoles));

        // set invite claimed
        UserInvite::where('token', input('token'))->update(['claimed_at' => Carbon::now()]);

        // send the confirmation mail
        Mail::send('emails.admin.auth.register_confirm',
            ['name' => $user->fullname, 'token' => $user->confirmation_token],
            function ($message) use ($user) {
                $message->to($user->email, $user->fullname)
						->subject('Confirmation Enregistrement');
            });

        alert()->success('Merci,',
            'Votre compte a été créé, veuillez surveiller votre boîte de réception pour retrouver les instructions afin de l\'activer.');

        log_activity('User Enregistré',
            $user->fullname . ' enregistré le ' . Carbon::now()->format('d M Y'), $user);

        return redirect(route('login'));
    }

    /**
     * User click on register confirmation link in mail
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmRegister($token)
    {
        $user = User::where('confirmation_token', $token)->first();
		
        if ($user) {
            if ($user->confirmed_at && strlen($user->confirmed_at) > 6) {
                alert()->info('Compte activé',
                    'Votre compte est déjà actif, essayez de vous connecter.');
            }
            else {
                $user->confirmed_at = Carbon::now();
                $user->update();

                alert()->success('Succès', 'Félicitations, votre compte a été activé.');

                log_activity('User Confirmé',
                    $user->fullname . ' compte confirmé ' . Carbon::now()->format('d M Y'),
                    $user);
            }
        }
        else {
            alert()->error('Oops!', 'Désolé, le jeton n\'existe pas');

            log_activity('User NON Confirmé', 'INVALID TOKEN');
        }

        return redirect(route('login'));
    }
}
