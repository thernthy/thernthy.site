# Build the Vite application
FROM node:22-alpine AS build

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build

# Serve the generated static site
FROM nginx:alpine

COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY --from=build /app/dist/ /usr/share/nginx/html/
# sitemap.xml is stored at the repository root, not in Vite's public directory.
COPY --from=build /app/sitemap.xml /usr/share/nginx/html/sitemap.xml

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
