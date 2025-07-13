# Use node:22 for both build and serve
FROM node:22 AS build

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build

FROM node:22 AS prod

WORKDIR /app

COPY --from=build /app/dist ./dist

EXPOSE 5173

CMD ["npm", "run", "dev"]
