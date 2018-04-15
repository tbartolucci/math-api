FROM node:8.11.1-stretch

WORKDIR /srv
ADD . .
RUN npm install

EXPOSE 3000
CMD ["node", "./bin/www"]
