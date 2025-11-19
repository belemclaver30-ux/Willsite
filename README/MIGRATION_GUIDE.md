# 📋 Guide de Migration - Willsite

## ✅ Ce qui a été réorganisé

### 1. Nouvelle Structure Créée ✔️

```
Willsite/
├── public/              # Nouveau dossier public (point d'entrée)
│   ├── index.php        # ✅ Créé
│   ├── about.php        # ✅ Créé
│   ├── contact.php      # ✅ Créé
│   ├── afficage_produit.php  # ✅ Créé
│   ├── product-detail.php    # ✅ Créé
│   ├── assets/          # ✅ Créé (CSS, JS, IMG copiés)
│   ├── vendor/          # ✅ Copié
│   └── uploads/         # ✅ Créé
│
├── app/
│   └── views/
│       └── includes/    # ✅ Composants créés
│           ├── head.php
│           ├── navbar.php
│           └── footer.php
│
├── config/              # ✅ Configuration centralisée
│   ├── config.php       # ✅ Créé
│   └── database.php     # ✅ Créé
│
├── includes/            # ✅ Système créé
│   ├── autoload.php     # ✅ Créé
│   └── helpers.php      # ✅ Créé (50+ fonctions utilitaires)
│
└── storage/             # ✅ Créé
    ├── logs/
    └── cache/
```

### 2. Fichiers de Configuration ✔️

- ✅ `config/config.php` - Configuration principale
- ✅ `config/database.php` - Connexion DB unifiée
- ✅ `.htaccess` - Sécurité et redirections
- ✅ `public/.htaccess` - URLs propres

### 3. Nouvelles Fonctionnalités ✔️

**Fonctions helpers disponibles :**
- `escape()` - Protection XSS
- `url()`, `asset()`, `upload()` - Génération d'URLs
- `formatPrice()` - Formatage des prix
- `redirect()` - Redirections
- `setFlashMessage()`, `getFlashMessage()` - Messages flash
- `isLoggedIn()`, `isAdmin()` - Authentification
- `generateCsrfToken()` - Protection CSRF
- Et bien d'autres...

## 🔄 Actions à Compléter

### Étape 1 : Copier les uploads existants

```bash
# Dans le terminal Git Bash
cp -r assets/img/uploads/* public/uploads/ 2>/dev/null || true
cp -r website_wws/uploads/* public/uploads/ 2>/dev/null || true
```

### Étape 2 : Tester les nouvelles pages

1. Ouvrir dans le navigateur :
   - `http://localhost/Willsite/public/index.php`
   - `http://localhost/Willsite/public/about.php`
   - `http://localhost/Willsite/public/contact.php`
   - `http://localhost/Willsite/public/afficage_produit.php`

2. Vérifier :
   - [ ] Les images s'affichent correctement
   - [ ] Les liens de navigation fonctionnent
   - [ ] Les catégories s'affichent
   - [ ] Les produits sont visibles
   - [ ] Le formulaire de contact fonctionne

### Étape 3 : Créer la table messages (si nécessaire)

```sql
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

### Étape 4 : Mettre à jour Apache Virtual Host (Optionnel)

Pour pointer directement vers `public/` :

```apache
<VirtualHost *:80>
    ServerName willsite.local
    DocumentRoot "C:/xampp/htdocs/Willsite/public"
    
    <Directory "C:/xampp/htdocs/Willsite/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Puis ajouter dans `C:\Windows\System32\drivers\etc\hosts` :
```
127.0.0.1  willsite.local
```

### Étape 5 : Réorganiser l'admin (TODO)

L'admin dans `admin_wws/` doit être restructuré :

```
app/admin/
├── views/
│   ├── dashboard.php
│   ├── products/
│   │   ├── list.php
│   │   ├── add.php
│   │   └── edit.php
│   └── includes/
│       ├── header.php
│       └── sidebar.php
├── controllers/
│   ├── ProductController.php
│   └── AdminController.php
└── middleware/
    └── auth.php
```

**Actions pour l'admin :**
1. Créer `app/admin/` avec la nouvelle structure
2. Migrer les fichiers de `admin_wws/`
3. Mettre à jour les chemins
4. Ajouter l'authentification sécurisée
5. Implémenter le système de sessions

### Étape 6 : Nettoyer les anciens fichiers (Après tests)

⚠️ **NE PAS SUPPRIMER AVANT D'AVOIR TESTÉ LES NOUVELLES PAGES**

Une fois que tout fonctionne, archiver :
```bash
mkdir _old_files
mv index.php _old_files/
mv about.php _old_files/
mv contact.php _old_files/
mv afficage_produit.php _old_files/
mv product-detail.php _old_files/
mv gestionDusite _old_files/
mv fonctions _old_files/
```

## 🎯 Configuration de BASE_URL

Selon votre environnement, dans `config/config.php` :

**Local (XAMPP) :**
```php
define('BASE_URL', 'http://localhost/Willsite');
```

**Virtual Host :**
```php
define('BASE_URL', 'http://willsite.local');
```

**Production :**
```php
define('BASE_URL', 'https://www.willsite.bf');
define('APP_ENV', 'production');
define('APP_DEBUG', false);
```

## 🔍 Vérifications de Sécurité

Avant la mise en production :

- [ ] Changer `SECURITY_SALT` dans `config/config.php`
- [ ] Mettre `APP_DEBUG = false`
- [ ] Mettre `APP_ENV = 'production'`
- [ ] Vérifier les permissions des dossiers
- [ ] Tester tous les formulaires
- [ ] Vérifier la protection CSRF
- [ ] Tester l'échappement des données
- [ ] Vérifier les requêtes SQL (prepared statements)
- [ ] Activer HTTPS
- [ ] Configurer les backups de la DB

## 📊 Avantages de la Nouvelle Structure

### Sécurité
✅ Protection des dossiers sensibles (config, app, includes)
✅ Point d'entrée unique via public/
✅ Fonctions de sécurité intégrées
✅ Protection CSRF, XSS, SQL Injection

### Maintenabilité
✅ Code organisé et modulaire
✅ Configuration centralisée
✅ Réutilisation des composants
✅ Séparation des responsabilités

### Performance
✅ Autoloading des classes
✅ Cache intégré
✅ Compression GZIP
✅ Mise en cache des assets

### Développement
✅ Helpers utilitaires
✅ Gestion d'erreurs
✅ Logs structurés
✅ URLs propres

## 🆘 Résolution de Problèmes

### Les images ne s'affichent pas
```bash
# Vérifier que les images sont dans public/assets/img/
ls -la public/assets/img/uploads/
# Copier si nécessaire
cp -r assets/img/uploads/* public/assets/img/uploads/
```

### Erreur de connexion DB
```php
// Vérifier dans config/database.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'boutique_informatique');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### Erreur 500
```php
// Activer le debug dans config/config.php
define('APP_DEBUG', true);
// Consulter storage/logs/app.log
```

### Les liens ne fonctionnent pas
```php
// Vérifier BASE_URL dans config/config.php
define('BASE_URL', 'http://localhost/Willsite');
```

## 📞 Support

Pour toute question sur la nouvelle structure :
1. Consulter `README_NEW.md`
2. Vérifier `includes/helpers.php` pour les fonctions disponibles
3. Examiner les exemples dans `public/index.php`

---

**Bonne migration ! 🚀**
