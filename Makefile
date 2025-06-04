firstTime: # Разворачивание и запуск в первый раз
	cp .env.example .env
	cp ./nginx/.env.example ./nginx/.env
	docker build -t app .
	make start

start: # Разворачивание и запуск не в первый раз
	docker-compose build
	docker-compose up -d
	docker exec -it -u 0 app make inside
	@echo 'success start: http://localhost'

inside:
	composer install --ignore-platform-reqs
	php artisan optimize:clear
	php artisan migrate
	php artisan db:seed
	php artisan storage:link
	php artisan key:generate
	npm i && npm run build
	find . -path ./.git -prune -o -exec chown 1000:1000 {} +
	chmod -R 777 storage
	chmod -R 777 bootstrap

migrate:
	docker exec -it -u 0 app php artisan migrate

seed:
	docker exec -it -u 0 app php artisan migrate:refresh --seed

front:
	docker exec -it -u 0 app npm i && npm run build

watch:
	docker exec -it -u 0 app npm i && npm run dev
