# Développement Web : projet d'application web en PHP Symfony

#### Elouan PRIME - Stéphane CHAIGNE

## Procédure d'installation du projet

0. Votre machine possède déjà php version 8
1. Installation de composer : https://getcomposer.org/download/
2. Récupérer les fichiers sources et se placer dans le répertoire du projet avec un terminal
3. Faire la commande : **composer install**
4. Créer la base de données SQL Lite : php bin/console d:d:c
5. Créer le schéma de la base : php bin/console d:s:c
6. Ajouter des données via les fixtures (uniquement les utilisateur) : php bin/console doctrine:fixtures:load
7. Toujours dans la répertoire du projet, lancer le serveur local avec : **symfony server:start**
8. Se rendre dans un navigateur à l'adresse indiquée par Symfony (souvent *http://127.0.0.1:8000/*)
9. Vous êtes sur notre site web intitulé **"GroovyCrypto"** !

Les utilisateurs créer avec les fixtures
login : admin
mdp : adminadmin

login : utilisateur1
mdp : utilisateur1
