# 🚀 Modular CMS Starter Kit (Laravel + Tailwind)

A highly scalable, professional-grade CMS foundation built with **Laravel 11** and **Tailwind CSS**. Designed for visionaries who want a ready-to-use project that can be rebranded in seconds.

---

## ✨ Features at a Glance

- **📂 Service Layer Architecture**: Decoupled business logic for maximum maintainability.
- **🛡 Robust RBAC**: Advanced Role-Based Access Control using Laravel Policies and a custom permission system.
- **🏷 Terminology Engine**: Update `config/terminology.json` to globally rename entities (e.g., "Article" ➔ "Product").
- **💎 Premium Dashboard**: Custom-built, high-performance Admin UI (Replacing AdminLTE with pure Tailwind).
- **🛒 Store-like Frontend**: A sleek, modern visitor interface with a focus on visual excellence.
- **📈 Built-in SEO**: Meta-tags, slugs, and schema ready for every piece of content.
- **🖼 Polymorphic Media**: Centralized media management for all models.

---

## 🛠 Tech Stack

- **Backend**: Laravel 11.x (PHP 8.2+)
- **Frontend**: Tailwind CSS 3.4+, Alpine.js, Blade
- **Database**: MySQL / PostgreSQL / SQLite
- **Auth**: Laravel UI (Customized with deep logic)

---

## 🚀 Quick Start

### 1. Installation
```bash
git clone https://github.com/samir20-23/Blog-Projet.git
cd Blog-Projet/main_blog
composer install
npm install && npm run build
```

### 2. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database & Seeding
```bash
php artisan migrate:fresh --seed
```

### 4. Run the App
```bash
php artisan serve
```

---

## 🏗 Architecture Overview

The project follows the **SOLID** principles with a focus on thin controllers and a strong service layer.

### Directory Structure
- `App/Services`: Contains all domain logic.
- `App/Http/Requests`: Standardized validation for every module.
- `App/Policies`: Authorization logic for every model.
- `Analyse/`: Requirement analysis and Use Case diagrams.
- `Conception/`: Class diagrams and Database schemas.

---

## 🎨 Global Rebranding

To change the core terminology of the app (e.g., from a Blog to an e-Commerce), edit the following file:

**`config/terminology.json`**
```json
{
  "article": "Product",
  "category": "Collection",
  "tags": "Labels",
  "dashboard": "Manager"
}
```

---

## 📄 Documentation

Detailed design diagrams are available in the repository:
- [Use Case Diagram](Analyse/use_case.puml)
- [Class Diagram](Conception/class_diagram.puml)
- [Database Schema](Conception/database_schema.puml)

---

## 👩‍💻 Contributors
Created with excellence by **Samir** and the **CMS Project Team**.

---

## ⚖️ License
The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
