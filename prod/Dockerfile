FROM node:22-alpine AS frontend
WORKDIR /app
COPY package*.json tsconfig*.json vite.config.* .env ./
COPY resources/js/ ./resources/
RUN ls
RUN sleep 10
RUN npm ci
RUN npm run build
