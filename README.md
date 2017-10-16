# wicod/laravel-5-starter
#### v0.0.4

Laravel 5 starter en Français sur la base de <a href="https://github.com/bpocallaghan/laravel-admin-starter" target="_blank">bpo-callaghan/laravel-admin-starter</a>.

Version Laravel <b>5.5.14</b>

Tout prêt, tout y est, jusqu'au système de corbeille (ajouté) en passant par la classe Notify() revue pour afficher plusieurs messages à la suite et d'autres petites améliorations.

## Installation

Il suffit télécharger le paquet :
```bash
git clone https://github.com/wicod/laravel-5-starter.git nouveau-projet
```
Puis :
```bash
php artisan package:discover
```

Créer une base de données pour le projet.
Ensuite remplir correctement le .env, régénérer la clé : 
```bash
php artisan key:generate
```
Après cela, la base de données (ou utiliser celle fournie, déjà traduite) :
```bash
php artisan migrate
```
Et pour la remplir :
```bash
php artisan db:seed
```

Peut-être suivre quelques recommandations de <a href="https://github.com/bpocallaghan/laravel-admin-starter" target="_blank">Mr callaghan</a>.

##### Connexion Administration : admin@mail.com &nbsp; &nbsp; 12345678

Pour de meilleurs résultats, l'utilisation d'hôte virtuel est recommendé. Pour ça c'est par <a href="https://memo.wicod.fr/mettre-en-place-virtual-host-simplement/" target="_blank">ici</a>.

Penser peut-être à un <code>sudo chmod -R 777 sur/la/racine</code>.

Penser aux 
```bash
php artisan config:cache
```
En raison de l'utilisation d'Api, <code>php artisan route:cache</code> ne fonctionne pas.

### Notes

Ce package est surtout là pour me diminuer la charge de travail à l'initialisation d'un projet laravel.

Certaines infos se gèrent depuis /app/Helpers/infos_helpers.php

Pour pouvoir utiliser webpack.mix et faire la compression des assets, installer nodejs :

<code>npm install</code> depuis la racine, puis <code>npm run prod</code>.

### Paquets présents

        bpocallaghan/[titan, alert, notify, impersonate, sluggable]
        google/recaptcha
        intervention/image
        spatie/laravel-analytics
        unisharp/laravel-filemanager
        yajra/laravel-datatables-oracle
	    htmlmin/htmlmin

        bpocallaghan/generators
        barryvdh/laravel-debugbar
        barryvdh/laravel-ide-helper

## Thanks
<ul>
<li><a href="https://github.com/almasaeed2010/AdminLTE" target="_blank">ADMIN LTE</a>.</li>
<li>Thank you <a href="https://github.com/taylorotwell" target="_blank">Taylor Ottwell for <a href="http://laravel.com/" target="_blank">Laravel</a>.</li>
<li>Thank you <a href="https://github.com/JeffreyWay" target="_blank">Jeffrey Way</a> for the awesome resources at <a href="https://laracasts.com/" target="_blank">Laracasts</a>.</li>
<li>Thanks <a href="https://github.com/bpocallaghan/laravel-admin-starter" target="_blank">BPO Callaghan</a>.</li>
</ul>

