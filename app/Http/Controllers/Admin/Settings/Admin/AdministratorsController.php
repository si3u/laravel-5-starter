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
        return $this->view('settings.admin.users.invite')->with('invited', UserInvite::all());
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function postInvite(Request $request)
    {
        $this->validate($request, [ 'email' => 'required|email|unique:users|unique:user_invites' ]);

        // create row
        $row = UserInvite::create($request->only('token', 'email', 'invited_by'));

        // send the invitation mail
        $mail = Mail::send('emails.admin.auth.invite', ['userInvite' => $row],
            function ($message) use ($row) {
                $message->to($row->email, $row->email)
                    ->subject('Invité en tant qu\'administrateur à ' . config('app.name'));
            });
		if($mail)
		{
			notify()->success('Succès', 'Invitation envoyée à ' . $row->email, 'thumbs-up bounce animated');
		} else {
			notify()->error('Erreur', 'Une erreur est survenue à l\'envoi de l\'invitation à <b>' . $row->email. '</b>', 'thumbs-up bounce animated');
		}
        

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
	 * Store a newly created User in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
	    $this->validate($request, User::$rules);
// TODO	
        $this->createEntry(User::class, $request->all());

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

        if ($user->id > 1) {
            notify()->warning('Oops', 'Vous ne pouvez pas éditer cet utilisateur.');

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
        if ($user->id > 1) {
            notify()->warning('Oops', 'Vous ne pouvez pas supprimer cet utilisateur.');
        }
        else {
            $this->deleteEntry($user, $request);
        }

        return redirect_to_resource();
    }
}
