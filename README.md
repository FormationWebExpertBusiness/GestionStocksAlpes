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

## Documentation 📚
<a href="https://laravel.com/docs/9.x">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
</a>
<br />
<a href="https://laravel-livewire.com/docs/2.x/quickstart">
  <img src="https://img.shields.io/badge/livewire-4e56a6?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire">
</a>
<br />
<a href="https://tailwindui.com/documentation">
  <img src="https://img.shields.io/badge/Tailwind_UI-0EA5E9?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwindui">
</a>
<br />
<a href="https://tailwindcss.com/docs/utility-first">
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwindcss">
</a>
<br />
<a href="https://flowbite.com/docs/getting-started/introduction">
  <img src="https://img.shields.io/badge/Flowbite-252e42?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Flowbite">
</a>
<br />
<a href="https://phpinsights.com/get-started.html#within-laravel">
  <img src="https://img.shields.io/badge/PhpInsights-4abf8a?style=for-the-badge&logo=php&logoColor=white" alt="PhpInsights">
</a>
<br />
<a href="https://pestphp.com/docs/installation">
  <img src="https://img.shields.io/badge/PhpPest-f472b6?style=for-the-badge&logo=php&logoColor=white" alt="Pest">
</a>
  
  
## Cmds to launch the project 🚀

### Clone the project 📋
In ssh
```bash
git clone git@github.com:FormationWebExpertBusiness/GestionStocksAlpes.git
```
In https
```bash
git clone https://github.com/FormationWebExpertBusiness/GestionStocksAlpes.git
```

### Go the project folder 📂
```bash
cd gestionStockAlpes
```
### Create a .env file :page_facing_up:
```sh
cp .env.example .env
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


