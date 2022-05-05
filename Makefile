up:
	composer install
	npm install
	npm run dev
	touch database/database.sqlite
migrate:
	php artisan key:generate
	php artisan migrate
start:
	php artisan serve --port=8001
