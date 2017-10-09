<?php

/**
 * For Views (and getActiveKeywords() )
 * @param ARRAY/STRING $words
 * @return ARRAY
 */
function getKeywords($words)
{
	// les mots clé à marquer comme sélectionnés
	$keywords = (($words) ? ( ( ! is_array($words) ) ? explode(',', $words) : $words ) : explode(',', infos('keywords')) );

	foreach ($keywords as $k => $v) // ça pour que le select2 marque ceux enregistrés comme selected (form_helpers.php)
	{
		$keywords[$v] = $v; // il faut que la clé soit identique à la valeur...pour être selected
		unset($keywords[$k]);
	}
	$keywords = array_merge( array_diff( explode(',', infos('keywords') ), $keywords), $keywords ); // ajoute ceux de base à la liste ( pas sélectionnés..)
	
	if(isset($keywords[0])) { $keywords[158000] = $keywords[0]; unset($keywords[0]); } // Cette connerie car sinon l'index 0 s'ajoute à la liste des sélectionnés (dans le select)
	
	// Forcer des mots clé obligatoirement selected au chargement
	$keywords['mot_cle_obligatoire'] = 'mot_cle_obligatoire';
	$keywords['mot'] = 'mot';
	
//dd('$words :',$words, 'explode infos(keywords) :',explode(',', infos('keywords')), '$keywords :',$keywords);
	return $keywords;
}

/**
 * For UPDATE
 * 
 * @param REQUEST $req
 * @return REQUEST
 */
function getActiveKeywords($req)
{
	$keywords = getKeywords($req);
	
	foreach($req as $k => $v)
	{
		if((int) $v)
		{
			$req[$k] = $keywords[$v];
		}
	}
//	dd('req :', $req, 'keywords :', $keywords);
	return $req;
}

/**
 * Compte les mots clé
 * @param STRING $words
 * @return INT
 */
function countKeywords($words)
{
	if(is_array($words))
	{
		return count($words);
	}
	return isset($words) ? (str_word_count($words) -1) : 0; // -1 pour l'espace du MV Bois
}
