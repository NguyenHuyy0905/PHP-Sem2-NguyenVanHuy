

# Frontend setup
echo "Setting up frontend..."
cd client || exit
npm install
npm run build
npm run start

# Backend setup
echo "Setting up backend..."
cd ../server || exit
composer install
cp .env.example .env
php artisan migrate
php artisan db:seed
php artisan serve
