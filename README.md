# wicod/laravel-5-starter
#### v0.0.1

Laravel 5 starter en Français sur la base de <a href="https://github.com/bpocallaghan/laravel-admin-starter" target="_blank">bpo-callaghan/laravel-admin-starter</a>.

Version Laravel <b>5.5.9</b>

Tout prêt, tout y est, jusqu'au système de corbeille (ajouté) en passant par sa classe Notify() revue pour afficher plusieurs messages à la suite et d'autres petites améliorations.

## Installation

Il suffit télécharger le paquet et de créer une base de données pour le projet.

<code>git clone https://github.com/wicod/laravel-5-starter.git</code>

<!-- OU <code>composer require wicod/laravel-5-starter</code> -->

Ensuite remplir correctement le .env, régénérer la clé <code>php artisan key:generate</code> puis <code>php artisan migrate</code> avec un coup de <code>php artisan db:seed</code> (ou utiliser l'archive contenant la bdd) et de suivre quelques recommendations de <a href="https://github.com/bpocallaghan/laravel-admin-starter" target="_blank">Mr callaghan</a>.

##### Connexion Admininstration : admin@mail.com &nbsp; &nbsp; 12345678

Pour de meilleurs résultats, l'utilisation d'hôte virtuel est recommendé.
Penser peut-être à un <code>sudo chmod -R 777 path/to/racine</code>.

Penser aux php <code>artisan config:clear</code> et <code>php artisan config:cache</code>.

### Notes

Ce package est surtout là pour me diminuer la charge de travail à l'initialisation d'un projet laravel.

Certaines infos se gèrent depuis /app/Helpers/infos_helpers.php

Pour pouvoir utiliser webpack.mix pour la compression des assets, installer nodejs :

<code>npm install</code> depuis la racine.

## Thanks
<ul>
<li><a href="https://github.com/almasaeed2010/AdminLTE" target="_blank">ADMIN LTE</a>.</li>
<li>Thank you <a href="https://github.com/taylorotwell" target="_blank">Taylor Ottwell for <a href="http://laravel.com/" target="_blank">Laravel</a>.</li>
<li>Thank you <a href="https://github.com/JeffreyWay" target="_blank">Jeffrey Way</a> for the awesome resources at <a href="https://laracasts.com/" target="_blank">Laracasts</a>.</li>
<li>Thanks <a href="https://github.com/bpocallaghan/laravel-admin-starter" target="_blank">BPO Callaghan</a>.</li>
</ul>

