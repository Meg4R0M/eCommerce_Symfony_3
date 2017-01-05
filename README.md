e-Commerce Symfony 3
========================

Site eCommerce, résultat d'un projet de formation, CODA by Simplon.

Si vous souhaitez tester ce site vous devez ajouter ceci à votre installation.

Paramêtres à ajouter
--------------

Veuillez ajouter au fichier app/config/parameters.yml:

Paramêtrages Mail:
```
    mailer_transport: smtp
    mailer_encryption: ssl
    mailer_host: smtp.gmail.com
    mailer_user: votremail@gmail.com
    mailer_password: votreMDP
```


Paramêtrages Twig:
```
twig:
    globals:
        telephone: 'Votre num Telephone'
        facebook: 'Votre lien facebook'
        adresse: 'Votre adresse'
        cpville: ' Code postal - Ville'
        pathDefault: 'Url/vers/RepertoireSymfony/Web/'
```

Veuillez également ajouter cette ligne dans votre app/config/config.yml

Paramêtrage swiftmailer:
```
swiftmailer:
    ...
    encryption: "%mailer_encryption%"
    ...
```