# Mobius Backend

Backend service for the Mobius Smart Waste Bin ecosystem.  
Built with Laravel.

## Requirements
- PHP 8.2+
- Composer
- MySQL 8
- Node.js 18+ & npm

## Setup
```bash
git clone https://github.com/Dnl-Semicolon/mobius-backend.git
cd htdocs/mobius-backend
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
npm install && npm run dev
php artisan serve
