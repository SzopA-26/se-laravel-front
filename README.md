# Residential Service
> แอพพลิเคชั่นสำหรับการจัดการและบริการต่างๆภายในหอพัก

## วิธีการติดตั้ง 
รันคำสั่ง
```
git clone https://github.com/onemoretwo/ResidentialService.git
cd ResidentialService
composer install
cp .env.example .env
```
จากนั้นเปิดใช้งาน MySQL และสร้าง Database Schema และแก้ไขไฟล์ .env ให้เรียบร้อยจากนั้นรันคำสั่ง
```
php artisan key:generate
```
---
