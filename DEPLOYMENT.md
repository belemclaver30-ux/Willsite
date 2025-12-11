# Guide de Déploiement - Willsite

## Prérequis

- Serveur web avec PHP 7.4+ et MySQL/MariaDB
- Accès SSH/FTP au serveur
- Hébergement supportant .htaccess (Apache recommandé)

## Étapes de Déploiement

### 1. Préparation des fichiers

1. Téléchargez tous les fichiers du projet vers votre serveur
2. Assurez-vous que le dossier racine pointe vers le dossier contenant `index.php`

### 2. Configuration de l'environnement

1. Créez un fichier `.env` dans le dossier racine avec les variables suivantes :

```env
# URL de base du site (sans slash final)
BASE_URL=https://votredomaine.com

# Mode debug (true pour développement, false pour production)
APP_DEBUG=false

# Configuration de la base de données
DB_HOST=localhost
DB_NAME=votre_base_donnees
DB_USER=votre_utilisateur_db
DB_PASS=votre_mot_de_passe_db
```

2. Importez le fichier SQL `boutique_informatique (1).sql` dans votre base de données MySQL

### 3. Permissions des fichiers

Définissez les permissions appropriées :
```bash
chmod 755 -R /chemin/vers/votre/site
chmod 644 -R /chemin/vers/votre/site/assets
chmod 755 /chemin/vers/votre/site/assets/img/uploads
```

### 4. Configuration du serveur

#### Pour Apache :
- Assurez-vous que `mod_rewrite` est activé
- Le fichier `.htaccess` à la racine gère déjà la réécriture d'URL

#### Pour Nginx :
Ajoutez cette configuration dans votre bloc server :

```nginx
server {
    listen 80;
    server_name votredomaine.com;
    root /chemin/vers/votre/site;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

### 5. Vérifications post-déploiement

1. **Test de la page d'accueil** : Accédez à `https://votredomaine.com`
2. **Test de l'admin** : Accédez à `https://votredomaine.com/admin_wws`
3. **Test des erreurs 404** : Essayez une URL inexistante
4. **Test de la base de données** : Vérifiez que les données s'affichent correctement

### 6. Sécurité

1. Changez la clé `SECURITY_KEY` dans `config/config.php`
2. Assurez-vous que les dossiers sensibles ne sont pas accessibles :
   - `config/`
   - `admin_wws/function/`
   - `fonctions/`

### 7. Optimisations

1. **Cache navigateur** : Le `.htaccess` inclut déjà des règles de cache
2. **Compression GZIP** : Activée dans le `.htaccess`
3. **Images** : Optimisez les images dans `assets/img/`

## Dépannage

### Erreur de connexion à la base de données
- Vérifiez les variables d'environnement dans `.env`
- Assurez-vous que la base de données existe et que l'utilisateur a les droits

### Erreurs 404
- Vérifiez que `mod_rewrite` est activé sur Apache
- Pour Nginx, assurez-vous d'avoir la configuration ci-dessus

### Permissions
- Les dossiers `assets/img/uploads` doivent être accessibles en écriture pour les uploads

## Support

Si vous rencontrez des problèmes, vérifiez :
1. Les logs d'erreur PHP (`error_log`)
2. Les logs du serveur web
3. Les permissions des fichiers
4. La configuration de la base de données
