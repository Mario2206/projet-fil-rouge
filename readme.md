# Projet Sondage (POO / SQL / AJAX)

## Configuration pour démarrer le projet

### Pour la base de données

* Importer la base de données du projet via le fichier sql présent dans Configuration\db

* Aller dans le dossier Configuration\db
* Créer un fichier dbConfiguration.php
* Copier-Coller le contenu présent dans dbConfiguration.example.php dans le fichier dbConfiguration.php que vous venez de créer
* Remplacer les informations de connexion à la base de données par les vôtres 

### Pour le système de routage

* Aller dans le dossier Configuration
* Créer un fichier configuration.php
* Copier-Coller le contenu présent dans configuration.example.php dans le fichier nouvellement créé configuration.php 
* Modifier la variable "projectDir" selon le dossier de pointage de votre serveur et le chemin qu'il faut parcourir afin d'accéder au dossier public du projet


Par exemple, si le serveur pointe sur un dossier "/www/" et que le projet se trouve à l'intèrieur de ce même dossier "/www/", on a donc :
$projectDir = "/www/myproject/public"

**ATTENTION A NE PAS METTRE DE "/" après "public"**

### Infos supplémentaires 

En important la base de données, vous pourrez trouver des utilisateurs déjà crées. Leurs mots de passe sont tous "password2206"

### Participants

Vauthier Alexandre, Abir Mahrzi, Raimbault Mathieu 