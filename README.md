
# Projet 7 - Openclassrooms

BeliMo est une application web exposant une API


## Prérequis

Avant de commencer, assurez-vous d'avoir installé les éléments suivants :

- PHP 8.1+
- Symfony 6.3+
- MySQL

## Installation

Suivez les étapes ci-dessous pour installer et configurer le projet sur votre machine locale.

### 1. Clonez le dépôt Git

```bash
git clone https://github.com/cactuseure/BileMo.git
```

### 2. Installez les dépendances via Composer

```bash
cd BileMo
composer install
```

### 3. Configurez le fichier .env

Ajouter les informations de connexion à votre base de données. Vous pouvez copier le fichier `.env.dist` et le renommer en `.env` :
```
cp .env.dist .env
```

Assurez-vous de remplir les valeurs appropriées pour votre configuration. Des expliquations sont fournit dans le fichier `.env`



### 4. Adaptez le fichier .env

Ouvrez le fichier .env et modifiez les lignes :
`DATABASE_URL` avec vos informations de connexion à la base de données 
mettez en place une clé secret pour APP_SECRET et JWT_PASSPHRASE.


### 5. Générer les clés privée et publique pour l'authentification par JWT

```bash
php bin/console lexik:jwt:generate-keypair
```

### 6. Créez la base de données

```bash
php bin/console doctrine:database:create
```

Exécutez les migrations pour créer les tables dans votre base de données

```bash
php bin/console doctrine:migrations:migrate
```

### 7. Générer le jeu de données dans votre base de données.

```bash
php bin/console doctrine:fixtures:load
```

### 8. Ajouter un utilisateur

```bash
php bin/console bilemo:create-user
```

### 9. Lancez le serveur Symfony
```bash
symfony server:start
```

Vous pouvez maintenant accéder à la documentation à l'adresse https://127.0.0.1:8000/api/docs


## Contribution

Si vous souhaitez contribuer à ce projet, veuillez suivre les étapes suivantes :

Fork du dépôt sur GitHub.
Clonez votre fork sur votre machine locale.
Créez une branche pour votre contribution :
- git checkout -b ma-contribution.
- Faites vos modifications et committez-les : git commit -m "Ajout de fonctionnalité X".
- Poussez votre branche vers votre fork : git push origin ma-contribution.
- Créez une pull request depuis votre fork vers ce dépôt principal.

## Licence

Ce projet est sous licence GNU GPLv3. Pour plus de détails, veuillez consulter le fichier `LICENSE.md`.

[![GNU License](https://img.shields.io/badge/License-GNU%20GPL-blue)](https://choosealicense.com/licenses/gpl-3.0/)