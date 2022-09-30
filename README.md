# GestionStocksAlpes 📦

## Configuration ⚙️

 mysql 8.0.30 ![mysql](https://www.mysql.com/common/logos/logo-mysql-170x115.png)  
 
 php 8.0.2 ![php](http://url/to/img.png)
 laravel 9.19 ![laravel](http://url/to/img.png)
 livewire 2.10 ![livewire](http://url/to/img.png)
 tailwind 3.1.8 ![tailwind](http://url/to/img.png)
 
        
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
