# Développement Web : projet d'application web en PHP Symfony

#### Elouan PRIME - Stéphane CHAIGNE

## Procédure d'installation du projet

0. Votre machine possède déjà php version 8
1. Installation de composer : https://getcomposer.org/download/
2. Récupérer les fichiers sources et se placer dans le répertoire du projet avec un terminal
3. Faire la commande : **composer install**
4. Installer les dépendances npm : **npm install**
5. Créer la base de données : php bin/console d:d:c (configuration dans le .env)
6. Créer le schéma de la base : php bin/console d:s:c
7. Ajouter des données via les fixtures (uniquement les utilisateur) : php bin/console doctrine:fixtures:load
8. Toujours dans la répertoire du projet, lancer le serveur local avec : **symfony server:start**
9. Se rendre dans un navigateur à l'adresse indiquée par Symfony (souvent *http://127.0.0.1:8000/*)
10. Vous êtes sur notre site web intitulé **"GroovyCrypto"** !

Les utilisateurs créer avec les fixtures
login : admin
mdp : adminadmin

login : utilisateur1
mdp : utilisateur1
