# 🎓 Trakio (SPEWS) - Student Performance Early Warning System

A web-based multi-role academic management system built with Laravel, designed to track student attendance, marks, and performance, and automatically generate early warnings for students at risk.

## 🌐 Live Demo

You can check out the live working demo of this project here: 👉 [Trakio Live Demo](https://studentperformace.wuaze.com/)

## 🔑 User Roles

### 👨‍💼 Admin

* Add and manage students (manually or in bulk via CSV import)
* Add and manage teachers
* Create and manage batches
* Assign teachers to batches
* Manage subjects
* Configure and generate warnings for students
* Full control over the platform

### 👩‍🏫 Teacher

* Mark and manage student attendance
* Add and manage student marks
* View student performance reports
* View and manage assigned students
* Manage own profile

### 👤 Student

* View personal profile and dashboard
* Track attendance record
* View marks and academic results
* View performance charts and analytics
* View warnings issued (if any)

## ✨ Features

* 3-role authentication system (Admin, Teacher, Student)
* Session-based authentication with roll number as default password and forced password change on first login
* Bulk student onboarding via CSV import, or manual entry
* Batch management with teacher-to-batch assignment
* Attendance tracking module
* Marks management module
* Automatic, configurable early-warning generation based on attendance and marks thresholds
* Interactive performance dashboards using Chart.js
* Role-based access control and middleware-protected routes

## 🛠️ Tech Stack

* **Backend:** PHP, Laravel
* **Database:** MySQL
* **Frontend:** Blade Templates, HTML, CSS, JavaScript, Bootstrap
* **Charts:** Chart.js
* **ORM:** Eloquent
* **Server:** XAMPP (local) / infinityfree (deployment)

## ⚙️ Setup Instructions

1. **Clone the repository**

```
git clone https://github.com/kanikachoudhary28/trakio.git
```

2. **Install dependencies**

```
composer install
npm install
```

3. **Configure environment**
   * Copy `.env.example` → `.env`
   * Fill in your database credentials in `.env`
   * Generate app key:

```
php artisan key:generate
```

4. **Set up database**
   * Create a new database in MySQL/phpMyAdmin
   * Run migrations:

```
php artisan migrate
```

5. **Build frontend assets**

```
npm run dev
```

6. **Run the project**

```
php artisan serve
```

Open `http://localhost:8000` in your browser.

## 📂 Project Structure

```
trakio/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Batch, Subject, Teacher, Warning controllers
│   │   │   ├── Auth/           # ForgotPasswordController
│   │   │   ├── Student/        # StudentDashboardController
│   │   │   └── Teacher/        # Attendance, Marks, Performance, Profile controllers
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/                 # Student, Teacher, Batch, Subject, Attendance, Mark, Warning, etc.
├── database/
│   ├── migrations/             # Batches, students, subjects, attendance, marks, warnings, etc.
│   └── seeders/
├── resources/
│   └── views/
│       ├── admin/              # Batches, students, teachers, subjects, warnings, attendance
│       ├── teacher/            # Attendance, marks, performance, students
│       ├── student/            # Dashboard, attendance, results, warnings, profile
│       ├── auth/               # Login, forgot password
│       └── layouts/            # Role-based layouts
├── routes/
│   └── web.php
└── public/
```

## 👩‍💻 Developer

Kanika
