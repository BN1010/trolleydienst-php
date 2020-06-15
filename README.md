# trolleydienst-php
Plane den Trolleydienst für deine Versammlung kinderleicht. Du kannst das Trolley Programm auf deinen Server installieren und nach belieben in der Programmiersprache PHP an die Bedürfnisse deiner Versammlung anpassen.

# Docker
## Build Docker Image
> cd /path/to/project
> docker build -t trolley .
## Create Docker Container
> docker run --name trolley -v $PWD:/trolleydienst-php/app -p 80:80 -d trolley
## Connect To Docker Container
> docker exec -ti trolley bash
