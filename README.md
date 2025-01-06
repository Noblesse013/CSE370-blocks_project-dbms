

# Blocks Project

## 🚀 Overview

The **Blocks Project** is a CRUD (Create, Read, Update, Delete) database application developed using **PHP**, **HTML**, **CSS**, and **XAMPP**. It provides role-based access control for managing products and viewing order details. Key features include adding, updating, and deleting products, as well as displaying orders and their details, making it a comprehensive tool for inventory and order management.

---

## 🛠 Features

- **Role-Based Access Control**:  
  - Different access levels for admins and staff.  
  - Admins can access all functionalities, while staff roles have limited permissions.  

- **Product Management**:  
  - Add new products to the database.  
  - Update existing product details.  
  - Delete products from inventory.  

- **Order Management**:  
  - View all orders.  
  - Access detailed information for each order.  

---

## 💻 Technologies Used

- **Frontend**:  
  - HTML  
  - CSS  

- **Backend**:  
  - PHP  

- **Database**:  
  - MySQL (via XAMPP)  

---

## 📦 Installation

Follow these steps to set up the project locally:

1. **Clone the Repository**:  
   ```bash
   git clone https://github.com/Sadab14/blocks_project.git
   ```

2. **Set Up XAMPP**:  
   - Download and install XAMPP: [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html).  
   - Start the **Apache** and **MySQL** services from the XAMPP Control Panel.  

3. **Move Project Files**:  
   - Copy the `blocks_project` folder to the `htdocs` directory in your XAMPP installation (e.g., `C:\xampp\htdocs\blocks_project`).  

4. **Import Database**:  
   - Open [phpMyAdmin](http://localhost/phpmyadmin).  
   - Create a new database (e.g., `blocks_inventory`).  
   - Import the provided SQL file (`blocks_inventory.sql`) located in the project folder.  

5. **Configure Database Connection**:  
   - Open the `config.php` file in the project.  
   - Update the database credentials:  
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "blocks_inventory";
     ```

6. **Access the Project**:  
   - Open your browser and go to [http://localhost/blocks_project](http://localhost/blocks_project).  

---



## 👥 Contributors

We extend our gratitude to the contributors of this project:  

- [**Noblesse013**](https://github.com/Noblesse013)  
- [**Sadab14**](https://github.com/Sadab14)  
- [**AdibAzwad**](https://github.com/AdibAzwad)  

---

