# wp-sitemap
A function to create SITEMAP in Wordpress without plugin

## Comment faire pour installer cette fonction ? 

- Ajouter la fonction (function-wp-sitemap.php) au fichier [functions.php](https://developer.wordpress.org/themes/core-concepts/custom-functionality/) de Wordpress;
- Supprimer les 2 premières lignes évidemment ! >>> /@ package + if (!defined('ABSPATH'));
- Créer un fichier sitemap.xml à la racine du site; 
- Mettre à jour un article ou une page pour générer un nouvelle version du site map;
- Le sitemap est visible à cette adresse https://www.mon-site/sitemap.xml
