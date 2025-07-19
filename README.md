# Laravel OTP Email Login System

This is a Laravel 10 project that allows users to log in using a **One-Time Password (OTP)** sent to their **email** instead of using a traditional password.

---
## 🔧 Tech Stack

- Laravel 10
- PHP 8.1+
- MySQL (for local development)
- Gmail SMTP (for sending OTP)
- Blade Templating Engine

---

## 📦 Installation & Setup

Follow these steps to run this project locally:

### 1. Clone the Repository

```bash
git clone https://github.com/Lamiya-kasim/regformtask.git
cd regformtask


2. Install Dependencies

composer install
3. Create the .env File


cp .env.example .env

Then update the .env file with your local configuration:
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:GENERATED_KEY
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=regform
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-gmail-app-password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="OTP Login System"
⚠️ Use a Gmail App Password instead of your actual Gmail password.


4. Generate the App Key

php artisan key:generate       and use this key in APP_KEY=base64:GENERATED_KEY

5. Run Database Migrations

Make sure your MySQL server is running and the database regform exists. 

php artisan migrate


6. Serve the Application

php artisan serve
http://localhost:8000/login-email
  or  in your browser.



🔐 How OTP Login Works:

*User enters their email on the login page.

*A random 6-digit OTP is generated.

*OTP is emailed to the user.

*User enters the OTP within 5 minutes.

*If OTP matches and is not expired, user is logged in and go to the dashboard

*A new user account is created automatically if it doesn't already exist.


🧪 Testing the Feature
Make sure your Gmail credentials are correct in .env.

Use the login form to enter your email.

Check your email inbox for the OTP.

Submit the OTP in the next screen to log in.


📌 Notes
OTP expires after 5 minutes.

OTP is valid for one-time use only.

No password is stored — login is entirely via OTP.


📁 Folder Structure
Controllers: app/Http/Controllers/Auth/LoginController.php

Views: resources/views/auth/login.blade.php, otp.blade.php

Routes: routes/web.php

Migrations: create_users_table, create_otps_table
