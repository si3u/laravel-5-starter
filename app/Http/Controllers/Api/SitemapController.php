<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Models\Actus;
use App\Models\NavigationWebsite;

class SitemapController extends ApiController
{
	private $baseUrl;
	
	public function __construct()
	{
		$this->baseUrl = url('/'); // juste pour passer dans les heredoc
	}
	
	
	
	public function builder()
	{		
		// Début du contenu à écrire dans le fichier sitemaps.xml
		$xml = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
				
	<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
		xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" 
		xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
		
EOT;
		
		$xml .= $this->buildFixes();
		
		$xml .= $this->buildArticles();
		
		$xml .= $this->buildActus();
		
		
		// Fin
		$xml .= <<<EOT
			
	</urlset>
EOT;
		
		return $this->writeSitemap($xml);
	}
	
	
	// FIXES
	public function buildFixes()
	{
		$page_fixes = NavigationWebsite::select('slug', 'updated_at')
												->where('is_hidden', 0)
												->get();
		$xml = "";
		foreach($page_fixes AS $v)
		{
			$url = "$this->baseUrl/$v->slug";
			$last_update = format_date_short($v->updated_at);
			$xml .= <<<EOT
			
		<url>
			<loc>$url</loc>
			<lastmod>$last_update</lastmod>
			<priority>1.0</priority>
		</url>
EOT;
		}
		return $xml;
	}
	
	
	// ARTICLES
	public function buildArticles()
	{
		$pages_articles = Article::select('slug', 'updated_at')
												->where('deleted_by', NULL)
												->get();
		$xml = "";
		foreach($pages_articles AS $k => $v)
		{
			$url = "$this->baseUrl/realisations/$v->slug";
			$last_update = format_date_short($v->updated_at);
			
			$xml .= <<<EOT
				
		<url>
			<loc>$url</loc>
			<lastmod>$last_update</lastmod>
			<priority>0.9</priority>
		</url>
EOT;
		}
		return $xml;
	}
	
	
	// ACTUS
	public function buildActus()
	{
		$pages_actus = Actus::select('slug', 'updated_at')
										  ->where('deleted_by', NULL)
										  ->get();
		$xml = "";
		foreach($pages_actus AS $k => $v)
		{
			$url = "$this->baseUrl/actualites/$v->slug";
			$last_update = format_date_short($v->updated_at);
			
			$xml .= <<<EOT
				
		<url>
			<loc>$url</loc>
			<lastmod>$last_update</lastmod>
			<priority>0.7</priority>
		</url>
EOT;
		}
		return $xml;
		
	}
	
	
	
	// WRITE SITEMAP
	public function writeSitemap($xml)
	{
		$DS = DIRECTORY_SEPARATOR;

		// Ouverture du fichier / Création si inexistant
		$maj = fopen(base_path().$DS.'public'.$DS.'sitemaps.xml', "w", "a");
		
		// Si il n'y a pas de souci à la création ou ouverture du fichier
		if($maj)
		{
			ftruncate($maj, 0); // Vidage du fichier
			
			fwrite($maj, $xml); // Ecriture du nouveau sitemaps
			
			fclose($maj); // Fermeture du fichier
			
			$typeAlert = 'success';
			$alert = 'Fichier « sitemaps.xml » correctement mis à jour avec les liens actuels du site.';
		} else {
			$typeAlert = 'error';
			$alert = 'Impossible d\'ouvrir le fichier « sitemaps.xml » à la racine du site.';
		}
		
		return [$typeAlert, $alert];
	}
	
	
}