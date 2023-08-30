# Description
Ce projet est une API REST développée avec Laravel à des fins de tests. Cette API fourni de fausses données sur des films et des critiques d'utilisateurs sur ces films. Cette API peut être utilisée pour développer une application web permettant à des utilisateurs de commenter des films.

Cette API offre des fonctionnalités d'authentification avec Sanctum. Il est possible de créer des comptes administrateurs ou des comptes membres.

# Installation
## Prérequis
PHP 8.0

[Composer](https://getcomposer.org/doc/00-intro.md) : Composer est un outil de gestion des dépendances en PHP. Il permet de déclarer les bibliothèques dont dépend votre projet et il les gérera (installation/mise à jour) pour vous.

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

# Utilisation

## Route
| Verb   | Route                                   | Description                                                    | Précisions                                 |
|--------|-----------------------------------------|----------------------------------------------------------------|--------------------------------------------|
| POST   | api/films                               | Ajouter un film                                                | Connexion en tant qu'admin nécessaire      |
| GET    | api/films                               | Consulter les films                                            |                                            |
| DELETE | api/films/{id}                          | Supprimer un film                                              | Connexion en tant qu'admin nécessaire      |
| GET    | api/films/{id}                          | Consulter un film                                              |                                            |
| GET    | api/films/{id}/actors                   | Consuler les acteurs d'un films                                |                                            |
| POST   | api/films/{id}/critics                  | Ajouter une critique                                           | Connexion en tant que membre nécessaire    |
| POST   | api/login                               | Connexion                                                      |                                            |
| POST   | api/logout                              | Déconnexion                                                    |                                            |
| GET    | api/user                                | Consulter les information de l'utilisateur connecté            | Connexion avec cet utilisateur nécessaire  |
| POST   | api/users                               | Ajouter un user                                                |                                            |
| GET    | api/users/{id}                          | Consulter les information d'un utilisateur                     | Connexion avec cet utilisateur nécessaire  |
| PUT    | api/users/{id}                          | Modifier les information d'un utilisateur                      | Connexion avec cet utilisateur nécessaire  |
| PUT    | api/users/{id}/update_password          | Modifier le mot de passe d'un utilisateur                      | Connection avec cet utilisateur nécessaire |

## Documentation OpenAPI
Une documentation OpenAPI complète est générée par [Scramble](https://scramble.dedoc.co/).
Lorsque l'API est lancée, la route `/docs/api` permet de consulter la documentation OpenAPI.

![image](https://github.com/LoicDelas/TP1_API_H23/assets/97980855/ed15d2ee-395b-4de9-9e92-cd96c1593f37)

