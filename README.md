# desk-boost
Web-Application using Docker, Laravel, MySQL

## Requirements
Docker
WSL (if running windows)

## Usage
1. clone Repo
2. navigate to folder and run `docker-compose up -d --build app`
3. in src directory create .env and change mysql vars matching the docker-compose.yml (connection: `mysql`, username/database: `homestead`, password: `secret`)

- **nginx** - `:80`
- **mysql** - `:3306`
- **php** - `:9000`
- **redis** - `:6379`
- **mailhog** - `:8025` 

Composer, NPM, and Artisan running in their own container:

- `docker-compose run --rm composer update`
- `docker-compose run --rm npm run dev`
- `docker-compose run --rm artisan migrate`