# GestionStocksAlpes 📦

<a href="https://gitmoji.dev">
  <img src="https://img.shields.io/badge/gitmoji-%20😜%20😍-FFDD67.svg?style=flat-square" alt="Gitmoji">
</a>

## Configuration ⚙️

```
 MYSQL    8.0.30
 PHP      8.0.2 
 LARAVEL  9.36.2
 LIVEWIRE 2.10 
 TAILWIND 3.1.8
 ```
 <br />
        
## Cmds to launch the project 🚀

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
<br /> 
<br /> 

🚨  **The next commands needs to be in the sail container** 🚨

<br />  

### Install dependencies 🐡
```bash
composer install
npm install
```
### Generate the project key to access your localhost 🔑
```bash
php artisan key:generate
```

### Run the livewire server :octopus:
```bash
npm run dev
```
  
### Access the project on your localhost 🌐
 <br />
  
## Errors :rage:

> If database related cmd don't run 
```
Change the DB_HOST line in your .env to "mysql"
```
<br />

## Documentation 📚
* [Laravel](https://laravel.com/docs/9.x) ![alt text](https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/194_Laravel_logo_logos-64.png))
* [Livewire](https://laravel-livewire.com/docs/2.x/quickstart)
* [Tailwindui](https://tailwindui.com/documentation)
* [Tailwindcss](https://tailwindcss.com/docs/utility-first)
* [Flowbite](https://flowbite.com/docs/getting-started/introduction)
