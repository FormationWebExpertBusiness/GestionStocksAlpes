# GestionStocksAlpes 📦

<a href="https://gitmoji.dev">
  <img src="https://img.shields.io/badge/gitmoji-%20😜%20😍-FFDD67.svg?style=flat-square" alt="Gitmoji">
</a>

## Configuration ⚙️

```
 MYSQL       8.0.30
 PHP         8.0.2 
 LARAVEL     9.36.2
 LIVEWIRE    2.10 
 TAILWIND    3.1.8
 PHPINSIGHTS 2.6.0
 PEST        1.22.1
 PHPUNIT     9.5.25
 ```
 <br />
        
## Cmds to launch the project 🚀

### Go the project folder 📂
```bash
cd gestionStockAlpes
```
### Create a .env file :page_facing_up:
```script
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
 
 ## Code Sniffer 👃
 
 ## To run PhpInsights
  ```bash
 php artisan insights
 ```
 
 ## To continuously update PhpInsights 🔁 (*only in linux*)
  ```bash
watch -cbn 0.5 php artisan insights --summary
 ```
 <br>
 
 ## Tests ⚗️
 
 ### To run tests :test_tube:
 ```bash
 php artisan test
 ```
 <br>
 
## Errors :rage:

> If database related cmd don't run 
```
Change the DB_HOST line in your .env to "mysql"
```
<br />

## Documentation 📚
* [Laravel](https://laravel.com/docs/9.x)
* [Livewire](https://laravel-livewire.com/docs/2.x/quickstart)
* [Tailwindui](https://tailwindui.com/documentation)
* [Tailwindcss](https://tailwindcss.com/docs/utility-first)
* [Flowbite](https://flowbite.com/docs/getting-started/introduction)
* [PhpInsights](https://phpinsights.com/get-started.html#within-laravel)
* [Pest](https://pestphp.com/docs/installation)
