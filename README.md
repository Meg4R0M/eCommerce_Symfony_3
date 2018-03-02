e-Commerce Symfony 3
========================

Site eCommerce, résultat d'un projet de formation, CODA by Simplon.

Si vous souhaitez tester ce site vous devez ajouter ceci à votre installation.

Installation
--------------
+ composer install # Installation des dependances
+ php bin/console doctrine:database:create # Creation de la Base de donnees
+ php bin/console doctrine:schema:update --force # Creation des tables
+ php bin/console doctrine:fixtures:load # (Optionnel) Donnees de demonstration

Vous referer à cette page pour les droits des repertoires : http://symfony.com/doc/3.4/setup/file_permissions.html
 + chmod 777 web/uploads/ # Droit pour l'upload d'image via le BO
 
Si vous avez injecter les donnes de tests vous devrez passer un utilisateur en ROLE_ADMIN afin de pouvoir acceder au BO.
``` 
$ php bin/console fos:user:promote
Please choose a username:Admin1
Please choose a role:ROLE_ADMIN
Role "ROLE_ADMIN" has been added to user "Admin1". This change will not apply until the user logs out and back in again.
```

Paramêtres à ajouter
--------------

Paramêtrages Twig (app/config/config.yml):
```
twig:
    globals:
        telephone: 'Votre num Telephone'
        facebook: 'Votre lien facebook'
        adresse: 'Votre adresse'
        cpville: ' Code postal - Ville'
        pathDefault: 'Url/vers/RepertoireSymfony/Web/'
    ...
```
