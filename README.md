# arcadia_zoo
Project Arcadia Study

* Instalacion de proyecto en local:

Una ves conectado el proyecto de Github en la aplicacion de VS Code

- Instalar las dependencias de Node abriendo la terminal (en VS Code) con el siguiente comando: 
"npm init -y"

- Después la instalación de Bootstrap con el siguiente comando : 
"npm install bootstrap"

- Aun en la terminal colocamos el siguiente comando para la connéction a php:
"php -S localhost:8888" + enter
Y esto nos arroja un lien para poder ver en directo el proyecto.


Explication plus detallée :

Pour le développement du projet, j’ai utilisé VS Code comme environnement de travail. 
Ce choix s’explique principalement par sa flexibilité, son intégration avec GitHub et sa facilité de gestion des dépendances.

L’un des avantages de VS Code est sa capacité à se connecter directement à GitHub, ce qui m’a permis de gérer facilement les branches, 
de suivre m’évolution du projet et d’effectuer des mises à jour sans avoir passer par une interface web. 
Grâce à son terminal integré, il est possible d’exécuter directement des commandes Git sans quitter l’éditeur.

La gestion de dépendances, j’ai simplement téléchargé nom afin d’installer rapidement 
les bibliothèques nécessaires comme Bootstrap qui vont ceux situés dans node_modules, sans le faire de manières manuel dans le projet.

En fin, pour le développement et les tests en local avec PHP, j’ai utilisé la commande suivante dans le terminal :
php -S localhost:8888
Ce système est pratique car il permet d’avoir une vue immédiate des modifications effectuées dans le projet et de 
tester les fonctionnalités en conditions réelles avant le déploiement.


Integration du MySQL dans le projet :

Ouvre un terminal et connecte-toi à MySQL avec ton utilisateur et mot de passe :
mysql -u root -p
(Il te demandera ton mot de passe MySQL).

Si la base de données n’existe pas, crée-la avant d’importer le fichier SQL :
CREATE DATABASE a_zoo;

Puis, utilise cette base de données :
USE a_zoo;

Si ton fichier a_zoo.sql est sur le bureau, tu dois aller dans ce dossier.
Sur macOS :
cd ~/Desktop

Sur Windows, tape :
cd C:\Users\TON_NOM\Desktop

Une fois dans le bon dossier, exécute cette commande pour importer le fichier :
mysql -u root -p a_zoo < a_zoo.sql
(Et enconre, il te demandera ton mot de passe MySQL et exécutera l’importation).

Reviens dans MySQL et liste les tables pour vérifier :
SHOW TABLES;

Si les tables apparaissent, l’importation est réussie.