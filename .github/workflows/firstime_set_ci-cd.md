name: Laravel CI/CD

on:
  push:
    branches:
      - main

jobs:
  deploy:
    runs-on: ubuntu-latest

    steps:
      # Step 1: Checkout the code
      - name: Checkout code
        run: |
          git clone https://github.com/${{ github.repository }} .
          git checkout ${{ github.ref }}

      # Step 2: Install PHP 8.3 and required extensions
      - name: Install PHP 8.3 and required extensions
        run: |
          sudo apt update
          sudo add-apt-repository ppa:ondrej/php -y
          sudo apt install -y php8.3 php8.3-cli php8.3-fpm php8.3-mbstring php8.3-bcmath php8.3-intl php8.3-gd php8.3-mysql php8.3-xml git
          php -m | grep dom # Verify the extension is installed

      # Step 3: Install Node.js and NPM
      - name: Install Node.js and NPM
        run: |
          curl -sL https://deb.nodesource.com/setup_16.x | sudo -E bash -
          sudo apt install -y nodejs
          node -v
          npm -v

      # Step 4: Install Composer and dependencies
      - name: Install Composer dependencies
        run: |
          curl -sS https://getcomposer.org/installer | php
          sudo mv composer.phar /usr/local/bin/composer
          composer install --prefer-dist --no-dev --optimize-autoloader
      
      # Step 5: Configure SSH for VPS
      - name: Configure SSH private key
        run: |
          mkdir -p ~/.ssh
          echo "${{ secrets.SSH_PRIVATE_KEY }}" > ~/.ssh/id_thy
          chmod 600 ~/.ssh/id_thy

      # Step 6: Add VPS to known hosts
      - name: Add VPS to known hosts
        run: |
          ssh-keyscan -H ${{ secrets.VPS_HOST }} >> ~/.ssh/known_hosts

      # Step 7: Deploy to VPS
      - name: Deploy to VPS
        env:
          VPS_USER: ${{ secrets.VPS_USER }}
          VPS_HOST: ${{ secrets.VPS_HOST }}
          VPS_PATH: /var/www/thy/thernthy.site
          NGINX_SERVICE: nginx
          PHP_SERVICE: php8.3-fpm
        run: |
          echo "VPS_PATH is set to: $VPS_PATH"
          ssh -i ~/.ssh/id_thy -o StrictHostKeyChecking=no -o BatchMode=yes $VPS_USER@$VPS_HOST << EOF
          set -e

          # Export variables for use in the session
          export VPS_PATH="${{ env.VPS_PATH }}"
          export NGINX_SERVICE="${{ env.NGINX_SERVICE }}"
          export PHP_SERVICE="${{ env.PHP_SERVICE }}"

          # Debug: Print VPS_PATH inside the session
          echo "VPS_PATH inside SSH session: $VPS_PATH"

          # Check if VPS_PATH is set
          if [ -z "$VPS_PATH" ]; then
              echo "Error: VPS_PATH is empty"
              exit 1
          fi

          # Navigate to project directory
          echo "Navigating to $VPS_PATH"
          cd "$VPS_PATH" || { echo "Error: $VPS_PATH does not exist"; exit 1; }

          # Check if the directory is a Git repository
          if [ ! -d ".git" ]; then
              echo "Error: $VPS_PATH is not a Git repository"
              exit 1
          fi

          # Pull latest changes
          echo "Pulling latest changes..."
          git fetch --all
          git reset --hard origin/main

          # Install/update Composer dependencies
          echo "Installing Composer dependencies..."
          composer require laravel/reverb --ignore-platform-req=ext-curl
          # php artisan install:broadcasting

          # composer require pusher/pusher-php-server

          # Run database migrations
          # echo "Running migrations..."
          # php artisan migrate --force

          # Clear and cache configurations
          echo "Clearing and caching configurations..."
          php artisan config:clear
          php artisan config:cache
          php artisan route:cache
          php artisan view:clear
          php artisan view:cache

          # Build assets
          echo "Building assets..."
          npm ci
          npm run build

          # Adjust permissions
          echo "Adjusting permissions..."
          chown -R www-data:www-data storage bootstrap/cache
          chmod -R 775 storage bootstrap/cache

          # Restart services
          echo "Restarting services..."
          sudo systemctl restart "$NGINX_SERVICE"
          sudo systemctl restart "$PHP_SERVICE"

          echo "Deployment complete!"
          EOF
