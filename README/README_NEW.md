# 🛒 Willsite - Boutique Informatique

Plateforme e-commerce moderne pour la vente de matériel informatique (ordinateurs portables, batteries, accessoires).

## 📁 Structure du Projet

```
Willsite/
├── 📂 public/                    # Point d'entrée web (DocumentRoot)
│   ├── index.php                 # Page d'accueil
│   ├── about.php                 # Page à propos
│   ├── contact.php               # Page contact
│   ├── afficage_produit.php      # Liste des produits
│   ├── product-detail.php        # Détails d'un produit
│   ├── .htaccess                 # Configuration Apache
│   ├── 📂 assets/                # Ressources statiques
│   │   ├── css/                  # Feuilles de style
│   │   ├── js/                   # Scripts JavaScript
│   │   ├── img/                  # Images
│   │   └── fonts/                # Polices
│   ├── 📂 vendor/                # Bibliothèques tierces (Bootstrap, jQuery, etc.)
│   └── 📂 uploads/               # Images uploadées
│
├── 📂 app/                       # Logique applicative
│   ├── 📂 views/                 # Vues et templates
│   │   ├── 📂 includes/          # Composants réutilisables
│   │   │   ├── head.php          # En-tête HTML
│   │   │   ├── navbar.php        # Barre de navigation
│   │   │   └── footer.php        # Pied de page
│   │   ├── 📂 public/            # Vues publiques
│   │   └── 📂 admin/             # Vues admin
│   ├── 📂 controllers/           # Contrôleurs (logique métier)
│   └── 📂 models/                # Modèles (accès données)
│
├── 📂 config/                    # Configuration
│   ├── config.php                # Configuration principale
│   └── database.php              # Configuration base de données
│
├── 📂 includes/                  # Fichiers système
│   ├── autoload.php              # Chargement automatique des classes
│   └── helpers.php               # Fonctions utilitaires globales
│
├── 📂 storage/                   # Données applicatives
│   ├── logs/                     # Fichiers logs
│   └── cache/                    # Cache
│
├── 📂 admin_wws/                 # Panel d'administration (à restructurer)
├── 📂 GestionErreur/             # Pages d'erreur
├── .htaccess                     # Redirection vers public/
├── boutique_informatique.sql     # Base de données
└── README.md                     # Documentation

```

## 🚀 Installation

### Prérequis
- **PHP** >= 7.4
- **MySQL** >= 5.7
- **Apache** avec mod_rewrite activé
- **XAMPP** ou **WAMP** (recommandé pour le développement local)

### Étapes d'installation

1. **Cloner le projet dans htdocs**
   ```bash
   cd C:/xampp/htdocs
   git clone [url-du-repo] Willsite
   cd Willsite
   ```

2. **Importer la base de données**
   - Ouvrir phpMyAdmin : `http://localhost/phpmyadmin`
   - Créer une base de données : `boutique_informatique`
   - Importer le fichier `boutique_informatique.sql`

3. **Configurer la base de données**
   - Éditer `config/database.php`
   - Vérifier les paramètres de connexion :
     ```php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'boutique_informatique');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     ```

4. **Configurer l'URL de base**
   - Éditer `config/config.php`
   - Modifier `BASE_URL` selon votre environnement :
     ```php
     define('BASE_URL', 'http://localhost/Willsite');
     ```

5. **Vérifier les permissions**
   ```bash
   # Windows (PowerShell en admin)
   icacls storage /grant Users:F /T
   icacls public/uploads /grant Users:F /T
   ```

6. **Accéder au site**
   - **Frontend** : `http://localhost/Willsite/public/`
   - **Admin** : `http://localhost/Willsite/admin_wws/`

## 🔧 Configuration

### Configuration principale (`config/config.php`)

```php
// Environnement
define('APP_ENV', 'development'); // ou 'production'
define('APP_DEBUG', true);        // false en production

// URLs
define('BASE_URL', 'http://localhost/Willsite');
define('ASSETS_URL', BASE_URL . '/public/assets');

// Sécurité
define('SECURITY_SALT', 'votre-sel-aleatoire-ici');
```

### Configuration de la base de données (`config/database.php`)

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'boutique_informatique');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');
```

## 📚 Utilisation

### Structure de la base de données

**Tables principales :**
- `products` - Produits
- `categories` - Catégories de produits
- `messages` - Messages de contact
- `admins` - Utilisateurs administrateurs

### Fonctions utilitaires (`includes/helpers.php`)

```php
// Échapper du HTML
escape($data)

// Rediriger
redirect(url('public/index.php'))

// Générer des URLs
url('public/contact.php')
asset('css/main.css')
upload('product.jpg')

// Formater le prix
formatPrice(150000) // "150 000 FCFA"

// Messages flash
setFlashMessage('Message envoyé avec succès')
$message = getFlashMessage()

// Sécurité
isLoggedIn()
isAdmin()
generateCsrfToken()
```

### Créer une nouvelle page

1. **Créer le fichier dans `public/`**
   ```php
   <?php
   require_once __DIR__ . '/../config/config.php';
   
   $pageTitle = 'Ma Page';
   $page_active = 'ma-page';
   ?>
   <!DOCTYPE html>
   <html lang="fr">
   <?php include APP_PATH . '/views/includes/head.php'; ?>
   <body class="animsition">
       <?php include APP_PATH . '/views/includes/navbar.php'; ?>
       
       <!-- Contenu ici -->
       
       <?php include APP_PATH . '/views/includes/footer.php'; ?>
   </body>
   </html>
   ```

2. **Ajouter au menu** (dans `app/views/includes/navbar.php`)

## 🔐 Sécurité

### Mesures de sécurité implémentées

- ✅ Protection CSRF avec tokens
- ✅ Échappement des données (XSS)
- ✅ Requêtes préparées (SQL Injection)
- ✅ Protection des dossiers sensibles via .htaccess
- ✅ Headers de sécurité HTTP
- ✅ Validation des emails
- ✅ Sanitization des inputs

### Bonnes pratiques

```php
// ❌ Mauvais
echo $_GET['name'];
$sql = "SELECT * FROM users WHERE id = " . $_GET['id'];

// ✅ Bon
echo escape($_GET['name']);
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_GET['id']]);
```

## 🐛 Débogage

### Activer le mode debug

Dans `config/config.php` :
```php
define('APP_DEBUG', true);
define('APP_ENV', 'development');
```

### Consulter les logs

```php
// Écrire dans les logs
logMessage('Message de debug', 'debug');
logMessage('Erreur critique', 'error');

// Fichier : storage/logs/app.log
```

## 📦 Dépendances

### Bibliothèques front-end (dans `public/vendor/`)

- **Bootstrap 4** - Framework CSS
- **jQuery 3.2.1** - Manipulation DOM
- **Slick Carousel** - Carrousels
- **Animate.css** - Animations
- **Font Awesome** - Icônes
- **SweetAlert** - Alertes jolies

## 🚧 Roadmap

### Phase 1 : Restructuration (En cours)
- [x] Nouvelle architecture MVC
- [x] Configuration centralisée
- [x] Système d'helpers
- [x] Sécurisation .htaccess
- [ ] Refonte admin

### Phase 2 : Fonctionnalités
- [ ] Système de panier
- [ ] Gestion des commandes
- [ ] Paiement en ligne
- [ ] Système de recherche avancée
- [ ] Filtres par catégorie

### Phase 3 : Optimisation
- [ ] Système de cache
- [ ] Optimisation images
- [ ] Minification CSS/JS
- [ ] SEO

## 👥 Contribution

### Workflow Git

```bash
# Créer une branche
git checkout -b feature/ma-fonctionnalite

# Commiter les changements
git add .
git commit -m "Ajout de ma fonctionnalité"

# Pousser vers le repo
git push origin feature/ma-fonctionnalite
```

## 📝 Licence

Ce projet est sous licence propriétaire. Tous droits réservés.

## 📞 Contact

- **Email** : contact@willsite.bf
- **Téléphone** : +226 64 28 25 75
- **Adresse** : Kalgodin face à la station petrofa, Ouagadougou, Burkina Faso

---

**Développé avec ❤️ par l'équipe Willsite**
