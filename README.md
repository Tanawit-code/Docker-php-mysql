# Docker php mysql
เป็นการ Docker compose up เป็นการใช้ไฟล์ yml ช่วยตั้งค่าในตัว containers 

วิธีใช้งาน

วิธีเข้าสู่ phpMyAdmin

- ใช้ชื่อผู้ใช้และรหัสผ่านนี้เพื่อล็อกอินในฐานะ root

ชื่อผู้ใช้:  root

รหัสผ่าน: MYSQL_ROOT_PASSWORD


 วิธีสร้างโฟลเดอร์ใหม่
- คุณสามารถสร้างโปรเจกต์ใหม่ภายในโฟลเดอร์ src ได้ที่

การเปลี่ยนรหัสผ่านของ MYSQL_ROOT_PASSWORD
หลังจากเปลี่ยนรหัสผ่านให้ใช้คำสั่ง
docker-compose down  # ปิดคอนเทนเนอร์ก่อน
docker-compose up -d # สร้างคอนเทนเนอร์ใหม่พร้อมค่ารหัสผ่านใหม่