# Utilisez une image Node.js officielle comme image de base
FROM node:14

# Définissez le répertoire de travail dans le conteneur
WORKDIR /usr/src/app

# Copiez les fichiers package.json et package-lock.json
COPY package*.json ./

# Installez les dépendances de l'application
RUN npm install

# Copiez le reste des fichiers de l'application dans le conteneur
COPY . .

# Exposez le port 8080
EXPOSE 8080

# Définissez la commande pour démarrer l'application
CMD [ "npx", "live-server" ]