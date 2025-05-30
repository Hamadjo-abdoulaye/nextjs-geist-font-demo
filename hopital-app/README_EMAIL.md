# Configuration du système d'envoi d'emails

Pour activer l'envoi d'emails de confirmation de rendez-vous, suivez ces étapes :

1. **Configuration de Gmail**
   - Connectez-vous à votre compte Gmail
   - Allez dans les paramètres de sécurité : https://myaccount.google.com/security
   - Activez la "Validation en deux étapes" si ce n'est pas déjà fait
   - Créez un "Mot de passe d'application" :
     * Dans "Validation en deux étapes", cliquez sur "Mots de passe des applications"
     * Sélectionnez "Application" -> "Autre (nom personnalisé)"
     * Donnez un nom (ex: "Hopital App")
     * Copiez le mot de passe généré

2. **Configuration du fichier mail.php**
   Modifiez le fichier `config/mail.php` avec vos informations :
   ```php
   return [
       'smtp' => [
           'host' => 'smtp.gmail.com',
           'port' => 587,
           'username' => 'votre-email@gmail.com', // Votre email Gmail
           'password' => 'xxxx xxxx xxxx xxxx',   // Le mot de passe d'application généré
           'encryption' => 'tls',
           'from_email' => 'hopital@example.com', // Email qui apparaîtra comme expéditeur
           'from_name' => 'Hôpital'               // Nom qui apparaîtra comme expéditeur
       ]
   ];
   ```

3. **Test du système**
   - Faites une prise de rendez-vous test
   - Vérifiez que l'email de confirmation est bien reçu
   - Vérifiez le contenu et la mise en forme de l'email

4. **Sécurité**
   - Ne partagez jamais votre mot de passe d'application
   - Ne commitez pas le fichier `mail.php` avec vos informations réelles
   - Considérez l'utilisation de variables d'environnement pour les informations sensibles

5. **Dépannage**
   Si les emails ne sont pas envoyés :
   - Vérifiez les logs PHP pour les erreurs
   - Assurez-vous que les extensions PHP requises sont activées (openssl, etc.)
   - Vérifiez que le mot de passe d'application est correct
   - Vérifiez que le port 587 n'est pas bloqué par votre pare-feu
