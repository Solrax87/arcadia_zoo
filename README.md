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



* Dentro de la aplicacion Zoo Arcadia


- Accueil:

Nos muestra un resumen de todo lo que se encuentra en el parque para los visitantes. Comenzando en la parte superior el logo del zoologico y el menu. Continuando con un carrusel de imageness de todos los habitats.

Después tenemos un vistaso rapido de los animales en unas tarjetas e invitar a los visitantes a ver mas animales y mas informacion sobre ellos.

En seguida, se muestran los servicios del zoo y la restauración disponible dentro del parque y mas abajo los avisos de los clientes (temoignages) junto con un formulario para enviar tu aviso personalisado.

Finalizando con el "footer" mostrando los horarios del parque, la mencion legal, politica de cookies y la informacion de contacto.



- Services:

Comienza con la restauration mostrando los restaurantes dentro del parque finalizando con las actividades en familia.



- Habitats:

Muestra los 4 habitats dentro del paque los cuales se pueden seleccionar cada uno y despues motrarar a detalle el habitat seleccionado junto con los animales que habitan en el.

Podemos seleccionar cada animal y nos mostrará una tarjeta con toda la informacion extraida de la base de datos dando el ultimo reporte de los veterinarios.



- Connection:

Este boton nos redirige hacia el login para realizar conección con el backend del sitio.

* Administrateur

email: carlos@arcadia.fr
mot de passe: 1122

* Veterinaire

email: cody@arcadia.fr
mot de passe: 1122

* Employer

email: djeila@arcadia.fr
mot de passe: 1122


Al acceder en modo "administrateur" nos permitira acceder al panel de configuracion con todas las opciones:

HABITATS
LES ANIMAUX
RAPPORT VÉTÉRIANIRE
SERVICES
TÉMOIGNAGES
RÔLES

Al acceder en modo "veterinaire" nos permitira acceder al panel de configuracion con opciones limitadas a:

HABITATS
LES ANIMAUX
RAPPORT VÉTÉRIANIRE
SERVICES

Al acceder en modo "employer" nos permitira acceder al panel de configuracion con opciones limitadas a:

LES ANIMAUX
TÉMOIGNAGES


- BACKEND "panel de control o admin"

* HABITATS:
Con un boton de regresar al "admin" y otro para crear un nuevo habitat.
Tenemos una interface que muestra:
Id - Nom - Image - Description - Action
Cada id con un boton para "modifier" o "effacer" en la parte de Action.

* LES ANIMAUX:
Con un boton de regresar al "admin" y otro para crear un nuevo animal.
Tenemos una interface que muestra:
Id - Nom - Animal - Image - Habitat - Descrition - Action
Cada id con un boton para "modifier" o "effacer" en la parte de Action.

* RAPPORT VÉTÉRIANIRE:
Con un boton de regresar al "admin" y otro para crear un nuevo rapport.
Tenemos una interface que muestra:
Id - Date - Veterinaire - Animal - Habitat — État - Nourriture - Quantité(gr) - Commentaires - Action
Cada id con un boton para "modifier" o "effacer" en la parte de Action.

* SERVICES:
Con un boton de regresar al "admin" y otro para crear un nuevo service.
Tenemos una interface que muestra:
Id - Titre - Image - Type - Description - Action
Cada id con un boton para "modifier" o "effacer" en la parte de Action.

* TÉMOIGNAGES:
Con un boton de regresar al "admin".
Tenemos una interface que muestra:
Id - Nom - Qualification - Message - Date - Action
Cada id con un boton para "effacer" en la parte de Action.

* RÔLES:
Con un boton de regresar al "admin" y otro para crear un nuevo rôle.
Tenemos una interface que muestra:
Id - Nom - Email - Role - Action
Cada id con un boton para "effacer" en la parte de Action.


- CONTACT:
Formulario para tener un contacto con el servicio del parque en caso de dudas.
Informacion de contacto.


Domaine du site:

https://zooarcadia.com/


Tecnologias escogidas:

