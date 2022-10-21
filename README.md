# GestionStocksAlpes 📦
        
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
