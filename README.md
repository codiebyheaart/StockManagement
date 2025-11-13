PHP Stock Management System

This is a simple PHP-based Stock Management System with a hand-made UI design. It helps manage products, inventory, and stock levels easily using a clean and lightweight PHP + MySQL setup.

Features

Add, Edit, Delete Products

Manage Stock In / Out

Search and Filter Products

Dashboard with Stock Summary

Data stored in MySQL Database

Simple PHP logic — easy to modify

Hand-coded UI with HTML, CSS, JavaScript

Basic admin login system (optional)

Folder Structure

php-stock-management/
│
├── index.php - Dashboard or Login Page
├── products.php - Product List
├── add_product.php - Add New Product
├── edit_product.php - Edit Product
├── delete_product.php - Delete Product
├── stock_in.php - Add Stock
├── stock_out.php - Remove Stock
│
├── includes/
│ ├── config.php - Database Connection
│ ├── header.php - Header Layout
│ ├── footer.php - Footer Layout
│ └── functions.php - Reusable PHP Functions
│
├── assets/
│ ├── css/ - CSS Files
│ ├── js/ - JavaScript Files
│ └── images/ - Icons & Images
│
└── database/
└── stock_db.sql - MySQL Database Export File

Requirements

PHP 7.4 or higher

MySQL Database

Local Server (XAMPP / WAMP / Laragon) or Cloud Hosting

Browser (Chrome, Edge, Firefox)

Installation

Download or clone this repository.

Copy the folder to your local server directory (htdocs for XAMPP).

Import the database file “database/stock_db.sql” into phpMyAdmin.

Open “includes/config.php” and update your MySQL credentials:
$conn = mysqli_connect("localhost", "root", "", "stock_db");

Start Apache and MySQL in XAMPP.

Open in your browser: http://localhost/php-stock-management

How to Use

Go to Products Page to add, edit, or delete items.

Use Stock In or Stock Out pages to update quantities.

Dashboard auto-updates with the latest stock details.

Data is stored dynamically in MySQL.

Deployment

You can upload this to any PHP hosting:

cPanel Hosting

InfinityFree / 000WebHost

AWS / Google Cloud / DigitalOcean

Make sure to:

Upload all project files

Create MySQL database

Import “stock_db.sql”

Update credentials in “config.php”

Tips

Backup your database regularly.

Secure admin credentials.

Optimize queries for large inventories.

You can extend with invoice or user role modules.

License

Free to use for learning and personal projects. Credits appreciated if you share publicly.

Author

Developed with ❤️ codiebyheaart
