<p align="center">
  <a href="" rel="noopener">
    <img width=200px height=200px src="https://thernthy.site/web_profile.jpg" alt="Thy Profile">
  </a>
</p>

<h3 align="center">Thy</h3>

<div align="center">

[![Status](https://img.shields.io/badge/status-active-success.svg)]()
[![GitHub Issues](https://img.shields.io/github/issues/IsaacTalb/isaac.duckcloud.info.svg)](https://github.com/IsaacTalb/isaac.duckcloud.info/issues)
[![GitHub Pull Requests](https://img.shields.io/github/issues-pr/IsaacTalb/isaac.duckcloud.info.svg)](https://github.com/IsaacTalb/isaac.duckcloud.info/pulls)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](/LICENSE)

</div>

---

<p align="center">
  A Laravel-based portfolio project leveraging Jetstream, Livewire, and Tailwind CSS to deliver a modern and responsive user experience.
  <br>
</p>

## 📝 Table of Contents

- [About](#about)
- [Getting Started](#getting_started)
- [Installation](#installation)
- [Usage](#usage)
- [Built Using](#built_using)
- [Authors](#authors)
- [Acknowledgments](#acknowledgement)

## 🧐 About <a name = "about"></a>

The **Isaac Portfolio** is a modern, customizable portfolio system built with Laravel. It includes authentication, admin UI, and rich frontend features such as TinyMCE for text editing and Swiper for enhanced visuals. This project demonstrates a robust framework for portfolio management.

---

## 🏁 Getting Started <a name = "getting_started"></a>

Follow these instructions to set up the project locally for development or testing. For deployment on a live system, refer to [Deployment](#deployment).

### Prerequisites

- PHP 8.3 or later
- Composer
- Node.js & npm
- A database (MySQL recommended)

### Installation <a name = "installation"></a>

#### Step 1: Clone the Repository
```bash
git clone https://github.com/IsaacTalb/Client-1-Portfolio.git
cd Client-1-Portfolio

```

#### Step 2: Install Laravel Dependencies
```bash
composer install

```

```bash
composer require irazasyed/telegram-bot-sdk
```
```bash
php artisan install:broadcasting
```

```bash
composer require laravel/reverb
```
```bash
php artisan reverb:install
```
```bash
composer require pusher/pusher-php-server
```

#### Step 3: Install Node.js Dependencies
```bash
npm install && npm run dev

```

#### Step 4: Configure the Environment
```bash
cp .env.example .env
php artisan key:generate
```
Update .env with your database credentials.

---

#### Step 5: Run Migrations
```bash
php artisan migrate

```

#### Step 6: Seed the Database
```bash
php artisan db:seed

```

#### Step 7: Start the Development Server
```bash
php artisan serve

```

---

## 🎈 Usage <a name="usage"></a>

### Features
<ol>
    <li>User Authentication: Register and log in users securely.</li>
    <li>Admin Dashboard: Manage posts, pages, and feedback.</li>
    <li>Rich Text Editing: Create and edit content with TinyMCE.</li>
    <li>Enhanced Visuals: Use Swiper for interactive UI components.</li>
</ol>

---

## 🚀 Deployment <a name="deployment"></a>
<ol>
    <li>Configure your production server (Apache/Nginx).</li>
    <li>Set environment variables in `.env`.</li>
    <li>Run migrations and seed data.</li>
    <li>Use `npm run build` to optimize assets for production.</li>
</ol>

---

## ⛏️ Built Using <a name="built_using"></a>
<ul>
    <li>Laravel - Framework</li>
    <li>Jetstream - Admin UI</li>
    <li>Livewire - Reactive Components</li>
    <li>Tailwind CSS - CSS Framework</li>
    <li>TinyMCE - Rich Text Editor</li>
    <li>Swiper - Interactive UI Components</li>
</ul>

---

## ✍️ Authors <a name="authors"></a>
<ul>
    <li><a href="https://github.com/IsaacTalb">@IsaacTalb</a> - Development & Management</li>
</ul>

---

### 🎉 Acknowledgements <a name="acknowledgement"></a>
<ul>
    <li>Laravel Community</li>
    <li>Jetstream & Livewire Contributors</li>
    <li>TinyMCE for simplifying text editing</li>
    <li>Swiper for making UI animations effortless</li>
    <li>Inspiration from modern portfolio designs</li>
</ul>

---
