# Banking-System

## About the project
Banking-System is the online money transfer with all registed users. It will allow user to deposit and withdraw money. It uses Stripe Payment gateways in order to transfer in wallet also users can send funds to each other. 

### Features
This project is responsible for transfering fund between users and allow user to withdraw and deposits funds from wallet, It's provides social authentication system, Two factor authentications system, User verifications, exprot transaction statements via email, and role based permissions.

### Login with Social Accounts (FaceBook)...
<img src="https://i.imgur.com/SRA19gt.png" />

### User Dashboard 
<img src="https://i.imgur.com/ntL99LZ.png" />

### User Wallet, Deposits and Withdraw
<img src="https://i.imgur.com/OF5VwOp.png" />

### Add Fund to Wallets
<img src="https://i.imgur.com/vedhezc.png" />

### Add Fund to Wallets Success
<img src="https://i.imgur.com/UPN6To2.png" />

### Transfer Money to other user
<img src="https://i.imgur.com/KJ39xk3.png" />


### Support User Dashboard
<img src="https://i.imgur.com/YWuuk84.png" />

### User Transaction Statements.
<img src="https://i.imgur.com/hkHsFmh.png" />

---
## Installation Process
--- 

### Clone this repo via below command,

```
git clone https://github.com/vikas-ukani/Banking-System.git
```


### Copy .env file from .env.example 
```
cp .env.example .env
```


### Edit .env  and Set Database Configurations.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=packt-database
DB_USERNAME=root
DB_PASSWORD=
```


### Install Packages
```
composer install 
```

### Generate app key
```
php artisan key:generate
```

### Run the migrations with Seeder datas
```
php artisan migrate:fresh --seed
```

- Configure Credentials in order to setup in local system

### Install Packages
```
npm install 
```
### Run the node Packages
```
npm run dev 
```

- It will create categories and random books factory data to testing more.

### Run the Project
```
php artisan serve
```
