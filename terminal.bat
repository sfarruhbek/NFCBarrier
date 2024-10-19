composer install
npm install
npm run build
copy .env.example .env
php artisan migrate:fresh
php artisan db:seed
php artisan key:generate
php artisan serve
