# Laravel Inertia TodoApp

A **Laravel Inertia TodoApp** that provides users with a simple and intuitive interface for managing their tasks. This application leverages the power of Laravel for backend processing, Inertia.js for seamless frontend-backend communication, and Vue.js for dynamic and reactive user experiences.

---

## Features

-   **Task Management**: Add, update, mark as completed, or delete tasks.
-   **User Authentication**: Secure user login and registration using Laravel Breeze.
-   **Dynamic UI**: Reactivity provided by Vue.js with Inertia.js for smooth page transitions.
-   **Persistent Storage**: Tasks are saved in a database and persist across sessions.
-   **Responsive Design**: Mobile-first design ensuring usability on all devices.

---

## Prerequisites

Before you begin, ensure you have the following installed on your system:

-   **PHP** (>= 8.0)
-   **Composer** (latest version)
-   **Node.js** (>= 16.x) & npm (or yarn)
-   **Laravel Installer** (optional)
-   **Database** (e.g., MySQL, SQLite)

---

## Getting Started

### Migrate the Database

Run the database migrations to create required tables:

```bash
php artisan migrate
```

### Build Assets

Compile frontend assets:

```bash
npm run dev
# or for production
npm run build
```

### Start the Application

Start the local development server:

```bash
php artisan serve
```

Visit [http://localhost:8000](http://localhost:8000) in your browser.

---

## Folder Structure

-   **`app/Models`**: Contains Eloquent models (e.g., `Task`).
-   **`resources/js/Pages`**: Vue components for Inertia pages.
-   **`routes/web.php`**: Application routes.
-   **`database/migrations`**: Database migration files.

---

## Usage

1. **User Authentication**: Register or log in to manage your tasks.
2. **Add Task**: Use the input box to create a new task.
3. **Edit Task**: Click on a task to edit it.
4. **Mark Complete**: Mark tasks as complete or incomplete.
5. **Delete Task**: Remove tasks from the list.

---

## Scripts

-   `npm run dev`: Compile and hot-reload for development.
-   `npm run build`: Compile and minify for production.
-   `php artisan migrate`: Run database migrations.
-   `php artisan serve`: Start the development server.
