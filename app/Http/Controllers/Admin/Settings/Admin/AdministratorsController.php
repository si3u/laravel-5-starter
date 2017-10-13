<?php

namespace App\Http\Controllers\Admin\Settings\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Role;
use App\Models\UserInvite;
use App\User;
use App\Models\UsersInvite;
use Illuminate\Http\Request;
use Mail;
use Titan\Controllers\TitanAdminController;

class AdministratorsController extends AdminController
{
    /**
     * Show all the administrators
     *
     * @return mixed
     */
    public function index()
    {
        save_resource_url();

        $items = User::with('roles')->get();

        $this->resource = 'Administrator';

        return $this->view('settings.admin.users.administrators', compact('items'));
    }

    /**
     * Show the invites
     *
     * @return mixed
     */
    public function showInvites()
    {
        return $this->view('settings.admin.users.invite')
					->withInvited(UserInvite::where('claimed_at', null)->get()) // without account create
					->withRoles(Role::getAllLists())	;
    }
		

    /**
	 * Send Mail Invitation
	 * @param STR $reSend ReSend invitation
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function postInvite($reSend = false, Request $request)
    {
		if ( ! $reSend) // Si c'est pas un renvoi d'invitation
		{
			$this->validate($request, [
				'email' => 'required|email|unique:users|unique:user_invites',
				'roles' => 'required|array',
			]);

			// create row
			$row = UserInvite::create([
					'email' => input('email'),
					'roles' => json_encode(input('roles')),
					'token' => input('_token'),
					'invited_by' => input('invited_by')
			]);

		} else {
			$row = UserInvite::where('email', input('email'))->first();
		}

        // send the invitation mail
		Mail::send('emails.admin.auth.invite', ['userInvite' => $row],
			function ($message) use ($row) {
				$message->to($row->email, $row->email)
						->subject('Invité par l\'administration ' . config('app.name'));
			});

		notify()->success('Succès', 'Invitation envoyée à ' . $row->email, 'thumbs-up bounce animated');

        return redirect_to_resource();
    }

	/**
	 * Show the form for creating a new Actus.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->view('settings.admin.users.create_edit')
			->withRoles(Role::getAllLists());
	}

	/**
	 * Store a newly created User/Admin in storage.
	 *
	 * @param User $user
	 * @param Request $request
	 * @return Response
	 */
	public function store(User $user, Request $request)
	{
	    $this->validate($request, User::$rulesCreate, []);
		
		$genderImage = (input('gender') == 'Mme') ? 'female.png' : 'male.png';
		$request->merge(['image' => $genderImage]);
		
		$request->merge(['password' => bcrypt(input('password'))]);
		$request->merge(['confirmed_at' => date('Y-m-d H:i:s')]);

		// Create User
        $row = $this->createEntry(User::class, $request->except(['roles', 'password_confirmation']));

		// Roles
		$id = $user->id;
		$user->id = $row->id;
		$user->roles()->sync(input('roles'));
		$user->id = $id;

		log_activity('Create User/Admin', 'Compte pour '.input('gender')." ".input('lastname')." créé");
		
        return redirect_to_resource();
	}

    /**
     * Show the form for editing the specified faq.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $roles = Role::getAllLists();

        return $this->view('settings.admin.users.create_edit', compact('roles'))
            ->with('item', $user);
    }

    /**
     * Update the specified faq in storage.
     * @param User    $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname'  => 'required',
            'roles'     => 'required|array',
        ]);
		
        if ( ! user()->isAdmin() ) {
            notify()->warning('Oops', 'Vous ne pouvez pas modifier cet utilisateur.');

            return redirect_to_resource();
        }

        $this->updateEntry($user, $request->only([
            'firstname',
            'lastname',
            'cellphone',
            'telephone',
            'born_at',
        ]));

        $user->roles()->sync(input('roles'));

        return redirect_to_resource();
    }

    /**
     * Remove the specified faq from storage.
     * @param User    $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(User $user, Request $request)
    {
        if ( ! user()->isAdmin() ) {
            notify()->warning('Oops', 'Vous ne pouvez pas supprimer cet utilisateur.');
        }
        else {
			$this->deleteEntry($user, $request);
        }

        return redirect_to_resource();
    }
}