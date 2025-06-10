Projet réalisé dans le cadre de ma formation DWWM
Mon Pokédex
Ce projet Symfony contient un fichier SQL afin d'implémenter les données.

Installation : 
1 : Cloner le projet
git clone https://github.com/bl-berengere/pokedex.git
cd nom-du-projet

2 : Installer les dépendances : 
composer install

3 : Configurer la BDD
Créer un fichier .env.local
DATABASE_URL="mysql://utilisateur:motdepasse@127.0.0.1:3306/nom_de_la_base"

4 : Créer la BDD
php bin/console doctrine:database:create

5 : Importer le dump SQL
mysql -u utilisateur -p nom_de_la_base < database/pokedex.sql

6 : Lancer le serveur
symfony server:start
