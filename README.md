# Rano LGEA Education Management System

A comprehensive Laravel + Filament-based system for managing schools, inventory, indicators, and student results for Rano Local Government Education Authority.

---

## 🚀 Features

* School and staff management
* Student enrollment and result processing
* Inventory and facilities tracking
* Indicator computation (GER, NER, PTR, etc.)
* Census data import and approval workflow
* Dashboard analytics and charts
* Role-based access control (RBAC)
* Public result checker portal
* PDF reports and broadsheets

---

## 🧱 Tech Stack

* PHP 8.2+
* Laravel 11
* Filament Admin Panel (v5.5)
* MySQL / PostgreSQL
* TailwindCSS
* Spatie Roles & Permissions
* Laravel Queue सिस्टम
* DomPDF (PDF generation)

---

## ⚙️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/your-repo/rano-lgea-system.git
cd rano-lgea-system
```

---

### 2. Install dependencies

```bash
composer install
npm install
npm run build
```

---

### 3. Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env`:

```env
APP_NAME="Rano LGEA System"
APP_ENV=production
APP_DEBUG=false
APP_URL=http://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rano_lgea
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

---

### 4. Database setup

```bash
php artisan migrate
php artisan db:seed
```

---

### 5. Storage link

```bash
php artisan storage:link
```

---

### 6. Install Filament

```bash
php artisan filament:install --panels
```

---

### 7. Create admin user

```bash
php artisan make:filament-user
```

---

## 🔐 Roles & Permissions

Seed roles:

```bash
php artisan db:seed --class=RolePermissionSeeder
```

Assign role:

```bash
php artisan tinker
```

```php
$user = App\Models\User::where('email', 'admin@example.com')->first();
$user->assignRole('Super Admin');
```

---

## 🧵 Queue Setup (IMPORTANT)

Used for:

* Census imports
* Notifications

### Create queue table

```bash
php artisan queue:table
php artisan migrate
```

### Run queue worker

```bash
php artisan queue:work
```

For production (Supervisor recommended):

```bash
php artisan queue:work --daemon --tries=3
```

---

## 🌐 Public Result Checker

Accessible via:

```
/result-checker
```

Requires:

* Admission Number
* Academic Session
* Term
* Access Code (PIN)

---

## 📄 PDF Reports

Generated using:

* DomPDF
* Broadsheets
* Student report cards

Ensure fonts are installed for proper rendering.

---

## 📡 Web Server Configuration

### Apache

Ensure:

```apache
DocumentRoot /public
```

Enable mod_rewrite.

---

### Nginx

```nginx
server {
    listen 80;
    server_name your-domain.com;

    root /var/www/rano-lgea/public;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

---

## 🛠️ Optimization (Production)

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## 🔄 Deployment Checklist

* [ ] Environment variables configured
* [ ] Database migrated and seeded
* [ ] Storage linked
* [ ] Queue worker running
* [ ] Admin user created
* [ ] Roles assigned
* [ ] HTTPS configured
* [ ] APP_DEBUG=false

---

## 🧪 Troubleshooting

### Login not working

* Check `canAccessPanel()` in User model
* Ensure user has a role

### Blank page / 500 error

```bash
php artisan optimize:clear
```

### Queue not working

```bash
php artisan queue:work
```

---

## 🔐 Security Notes

* Never expose `.env`
* Always use HTTPS
* Restrict `/admin` access if needed
* Use strong passwords

---

## 📈 Future Improvements

* Mobile app integration (API)
* SMS gateway integration
* Advanced analytics dashboard
* Parent mobile portal

---

## 👨‍💻 Author

Developed for Rano LGEA Education Authority

---

## 📄 License

This project is proprietary software for government use.
