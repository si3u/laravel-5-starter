<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\User;

use App\Http\Requests;
use Illuminate\Http\Request;

class ProfileController extends AdminController
{
    public function index()
    {
        return $this->view('profile');
    }

    /**
     * Update the specified banner in storage.
     *
     * @param User    $user
     * @param Request $request
     * @return Response
     */
    public function update(User $user, Request $request)
    {
        // user we want to edit and session user must be the same
        if ($user->id != user()->id) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors(['firstname' => 'Accès Non Autorisé']);
        }

        // submit without a file
        if (is_null($request->file('photo'))) {
            $this->validate($request, array_except(User::$rulesProfile, 'photo'));
        }
        else {
            $this->validate($request, User::$rulesProfile);

            $photo = $this->uploadProfilePicture($request->file('photo'));

            $request->merge(['image' => $photo]);
        }
		
		$tab_to_update = [
            'firstname',
            'lastname',
			'gender',
            'cellphone',
            'telephone',
            'born_at',
            'image',
			'email',
            'password'
        ];
		// if empty password
        if ( $request->input('password') == null ) {
			unset($tab_to_update[8]);
		} else {
			notify('Info', 'Mot de passe correctement modifié.<br>Utilisable à la prochaine connexion.');
		}

        // update user without photo and password
        $this->updateEntry($user, $request->only($tab_to_update));

        return redirect('/admin/profile');
    }

    /**
     * Upload the profile picture image
     *
     * @param        $file
     * @return string|void
     */
    private function uploadProfilePicture($file)
    {
        $name = token();
        $extension = $file->guessClientExtension();

        $filename = $name . '.' . $extension;
        $imageTmp = Image::make($file->getRealPath());

        if (!$imageTmp) {
            return notify()->error('Oops', 'Quelque chose ne va pas !', 'warning shake animated');
        }

        $path = upload_path_images();

        // save the image
        $imageTmp->fit(250, 250)->save($path . $filename);

		notify('Info', 'Image du profil correctement modifiée.');
			
        return $filename;
    }
}