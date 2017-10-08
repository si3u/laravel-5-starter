<?php
use App\Http\Controllers\Website\ParametersController as Params;


if (!function_exists('infos')) {
    /**
     * Get infos
	 * 
	 * Example:
	 * {{ infos($var1, $var2, $var3) }}  return  var1 var2 var3
	 * OU
	 * {{ infos($var) }}  return var
     *
     * @param string $vars
     * @return Infos
     */
    function infos( ...$vars )
    {
		// TODO : singleton on Params
		$Params = new Params();
		
		$infos = json_decode($Params->getParams('infos')->value);
		$socials = json_decode($Params->getParams('socials')->value);
		
		$tab_society = [
			'societe' => $infos->societe,
			'slogan' => $infos->slogan,
			'siret' => $infos->siret,
			'statut' => $infos->statut,
			'capital' => $infos->capital,
			
			'nom' => $infos->nom,
			'prenom' => $infos->prenom,
			'email' => 'web@mail.com',
			
			'rue' => $infos->rue,
			'cp' => $infos->cp,
			'ville' => $infos->ville,
			'region' => $infos->region,
			'pays' => 'France',
			'tel-mobile' => $infos->telmobile,
			'tel-fixe' => $infos->telfixe,
			'longitude' => $infos->longitude,
			'latitude' => $infos->latitude,
		
			'keywords' => implode(',', json_decode($Params->getParams('keywords')->value)),
			'description' => json_decode($Params->getParams('description')->value),
			
			'logo' => asset('uploads/images/logo_'. str_slug($infos->societe).'.png'),
			'logo-mini' => asset('uploads/images/logo_'.str_slug($infos->societe).'-mini.png'),
			
			'site-url' => 'https://www.domaine.com',
			'title' => $infos->nom.' - '.$infos->cp.' '.$infos->ville,
			
			'facebook_app_id' => $socials->facebookappid,
			'twitter_page' => $socials->twitterpage,
			
			// WEBMASTER
			'webmaster_name' => 'WICOD',
			'webmaster_url' => 'https://www.wicod.fr',
			'webmaster_link' => '<a href="https://www.wicod.fr" target="_blank" title="https://www.wicod.fr">WICOD.fr</a>',
			'webmaster_logo' => 'https://www.wicod.fr/img/logo/logo-wicod-mini.png',
			'webmaster_rue' => '',
			'webmaster_cp' => '',
			'webmaster_ville' => '',
			'webmaster_telmobile' => '',
			'webmaster_telfixe' => '',
			
		];
		if ( count($vars) >= 2 ) {
			$res = '';
			foreach ($vars as $k => $v) {

				if (isset($tab_society[$v])) {
					$res .= " $tab_society[$v]";
				}
				else {
					$res .= $v;
				}
			}
		} else {
			return $tab_society[$vars[0]];
		}
			
		
        return $res;
    }
}



if (!function_exists('logo')) {
    /**
     * Get Logo
     * @param string $size (full OR mini)
     * @return path logo
     */
    function logo($size = 'full')
    {
		$logo = [
			'full' => 'logo_'.str_slug(infos('societe')).'.png',
			'mini' => 'logo_'.str_slug(infos('societe')).'-mini.png',
		];
		return '/uploads/images/'.$logo[$size].'?'.time();
	}
}