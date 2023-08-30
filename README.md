# Description
Ce projet est une API REST développée avec Laravel à des fins de tests. Cette API fourni de fausses données sur des films et des critiques d'utilisateurs sur ces films. Cette API peut être utilisée pour développer une application web permettant à des utilisateurs de commenter des films.

# Installation
## Prérequis
PHP 8.0

[Composer](https://getcomposer.org/doc/00-intro.md) : Composer est un outil de gestion des dépendances en PHP. Il vous permet de déclarer les bibliothèques dont dépend votre projet et il les gérera (installation/mise à jour) pour vous.

## Étapes

1. Cloner le projet et changer de répertoire
```
git clone https://github.com/LoicDelas/TP1_API_H23.git
cd TP1_API_H23/TP_API_Laravel
```

2. Installer les dépendances
```
composer install --no-scripts
```

3. Créer une base de donnée MySQL
4. Copier le fichier *.env.example* et le nommer *.env*. Dans ce fichier, renseigner le nom de la BD, le nom d'utilisateur et le mot de passe MySQL
```
DB_DATABASE=nomBD
DB_USERNAME=username
DB_PASSWORD=password
```
5. Lancer la migration
```
php artisan migrate
```
6. Seeder la base de données
```
php artisan db:seed
```
7. Lancer l'API
```
php artisan serve
```

# Routes

| Verb   | Route                                   |
|--------|-----------------------------------------|
| POST   | api/films                               |
| GET    | api/films                               |
| DELETE | api/films/{id}                          |
| GET    | api/films/{id}                          |
| GET    | api/films/{id}/actors                   |
| POST   | api/films/{id}/critics                  |
| POST   | api/login                               |
| POST   | api/logout                              |
| GET    | api/user                                |
| POST   | api/users                               |
| GET    | api/users/{id}                          |
| PUT    | api/users/{id}                          |
| PUT    | api/users/{id}/update_password          |
