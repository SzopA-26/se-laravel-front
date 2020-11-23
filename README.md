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

## เตรียมการสำหรับทดสอบระบบ
คำสั่งสำหรับสร้างข้อมูลจำลองใน Database และเปิดใช้งาน Server
```
php artisan migrate:refresh --seed
php artisan serve
```
---

## Email และ Password สำหรับทดสอบระบบ

| Role | Email |  Password | คำอธิบาย
| :--------: | :-------- | :--------- | :---
|   Admin   |   admin@gmail.com   |    1234   | เจ้าของหอพัก
|   Staff   |   staff1@gmail.com   |    1234   | เจ้าหน้าที่ดูแลหอพัก
|   Staff   |   staff2@gmail.com   |    1234   | เจ้าหน้าที่ดูแลหอพัก
|   User   |   user1@gmail.com   |    1234   | ผู้เช่าห้อง
|   User   |   user2@gmail.com   |    1234   | ผู้เช่าห้อง
|   User   |   guest@gmail.com   |    1234   | ผู้ใช้งานทั่วไป
