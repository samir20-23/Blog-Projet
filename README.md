 
<div>
<div id="badges" align="center">

[![Typing SVG](https://readme-typing-svg.herokuapp.com/?color=63CF15&lines=Here+Hawe+To+start+App)](https://git.io/typing-svg)

</div>

## Laravel Project Setup with AdminLTE and Laravel UI

### Step 1: Clone or Create Project
- **Clone the existing project:**
  ```bash
  git clone https://github.com/samir20-23/Blog-Projet.git
  cd Blog-Projet/live-coding
  ```
- **OR Create a new Laravel project:**
  ```bash
  composer create-project laravel/laravel project_name
  cd project_name
  ```

---

### Step 2: Install Dependencies
- Install Laravel UI:
  ```bash
  composer require laravel/ui
  ```
- Generate authentication scaffolding:
  ```bash
  php artisan ui bootstrap --auth
  ```
- Install AdminLTE:
  ```bash
  composer require adminlte
  ```
- Install NPM dependencies:
  ```bash
  npm install
  ```
- Publish AdminLTE assets (if needed):
  ```bash
  npm run dev
  ```
- Include AdminLTE in `resources/js/app.js`:
  ```javascript
  import 'admin-lte';
  ```
- Import AdminLTE styles in `resources/sass/app.scss`:
  ```scss
  @import "~admin-lte/dist/css/adminlte.min.css";
  ```

---

### Step 3: Migrations and Database Setup
- Run migrations to create necessary tables:
  ```bash
  php artisan migrate
  ```
- Open Laravel Tinker for database operations:
  ```bash
  php artisan tinker
  ```

---

### Step 4: Database Seeding Examples
#### Create a User:
```php
App\Models\User::create([
    'name' => 'samir',
    'email' => 'samir@...',
    'password' => bcrypt('samir')
]);
```

#### Create Categories:
```php
App\Models\Category::create([
    'name' => 'Category 1'
]);
```

#### Create Comments:
```php
App\Models\Comment::create([
    'content' => 'This is a comment',
    'user_id' => 1,
    'article_id' => 1
]);
```

#### Create Tags:
```php
App\Models\Tag::create([
    'name' => 'Tag 1'
]);
```

#### Create an Article:
```php
App\Models\Article::create([
    'title' => 'article1',
    'content' => 'content article1',
    'user_id' => 1,
    'category_id' => 1,
    'comment_id' => 1,
    'tag_id' => 1
]);
```

---

### Step 5: Development Server
- Run the Laravel server:
  ```bash
  php artisan serve
  ```
- Compile assets:
  ```bash
  npm run dev
  ```
 
</div>
