<?php

use App\Models\Parameters;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ParametersTableSeeder extends Seeder
{
    public function run(Faker\Generator $faker)
    {
        Parameters::truncate();

        //-------------------------------------------------
        // KEYWORDS
        //-------------------------------------------------
        Parameters::create([
            'params'    => 'keywords',
            'value'     => '["mot","mots","deux mots"]',
        ]);

        //-------------------------------------------------
        // DESCRIPTION
        //-------------------------------------------------
        Parameters::create([
            'params'    => 'description',
            'value'     => json_encode('Description Description Description Description Description Description Description'),
        ]);
		
        //-------------------------------------------------
        // HORAIRES
        //-------------------------------------------------
        Parameters::create([
            'params'    => 'horaires',
            'value'     => json_encode(["open1_lundi" => "10h00","close1_lundi" => "12h00","open2_lundi" => "14h00","close2_lundi" => "18h00","open1_mardi" => "10h00","close1_mardi" => "12h00","open2_mardi" => "14h00","close2_mardi" => "18h00","open1_mercredi" => "10h00","close1_mercredi" => "12h00","open2_mercredi" => "ferm\u00e9","close2_mercredi" => null,"open1_jeudi" => "10h00","close1_jeudi" => "12h00","open2_jeudi" => "14h00","close2_jeudi" => "18h00","open1_vendredi" => "10h00","close1_vendredi" => "12h00","open2_vendredi" => "14h00","close2_vendredi" => "18h00","open1_samedi" => "10h00","close1_samedi" => "12h00","open2_samedi" => "ferm\u00e9","close2_samedi" => null]),
        ]);
		
        //-------------------------------------------------
        // INFOS
        //-------------------------------------------------
        Parameters::create([
            'params'    => 'infos',
            'value'     => json_encode( ["nom" => "NOM","prenom" => "PRENOM","societe" => "SOCIETE","slogan" => null,"siret" => "123456789 12345","statut" => "STATUT","capital" => "36","telfixe" => "01 23 45 67 89","telmobile" => null,"rue" => "","cp" => "","ville" => "","region" => "","longitude" => "47.99567438543637","latitude" => "6.595046332478518"] ),
        ]);
		
        //-------------------------------------------------
        // SOCIALS
        //-------------------------------------------------
        Parameters::create([
            'params'    => 'socials',
            'value'     => json_encode( [ "facebookappid" => "12345678","twitterpage" => "@twitterpage" ] ),
        ]);
    }
}
