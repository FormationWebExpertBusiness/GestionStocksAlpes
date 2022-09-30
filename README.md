# GestionStocksAlpes 📦

## Configuration ⚙️

 mysql 8.0.30 :database:
 php 8.0.2 
 laravel 9.19 
 livewire 2.10 
 tailwind 3.1.8
 
        
## Cmd to launch the project 🚀

### Go the project folder 📂
```bash
cd gestionStockAlpes
```
### Create a .env file :page_facing_up:
```bash
cp .env.exemple .env
```
### Build images 🐳
```bash
docker compose up or docker-compose up
```

🚨  **The next cmd needs to be in the sail container** 🚨

### Install dependencies 🐡
```bash
composer install
npm install
```
### Run the livewire server :octopus:
```bash
npm run dev
```
### Generate the project key to access your localhost 🔐
```bash
php artisan key:generate
```

### Access the project on your localhost

🚨 **If database related cmd don't run change the DB_HOST line in your .env to "mysql"** 🚨
