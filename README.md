CleanTrack: A Technology-Driven Waste Collection Support System
This project is a web-based application built with PHP (CodeIgniter) to support and digitize municipal waste management, based on a case study of the "Ghanta Gadi Initiative".

CleanTrack helps municipalities streamline HR and logistics by tracking vehicle routes, managing drivers, and monitoring household collection status in real-time.


Features

Dashboard: At-a-glance view of "Total Houses," "Scanned Today," and "Remaining Today".


Driver Management: Register new drivers and view a searchable list of all active drivers with their details (phone, license, vehicle).





Household Management: Register new households with address, area, and contact info.



Collection Tracking: View a list of "Scanned Households" to monitor real-time collection status.


Data Management: Centralized system for managing all drivers, households, and collection data.

Tech Stack

Backend: PHP (CodeIgniter framework) 


Database: MySQL 


Frontend: HTML5, CSS3, JavaScript 

Server: XAMPP (Apache + MySQL) recommended for local development.

🔒 Security Best Practice
This repository follows security best practices:

The main database configuration file (e.g., application/config/database.php) is not uploaded to GitHub.

A template file named database.php.example is provided. You must copy and rename this file to database.php and add your local database credentials.

Installation & Setup
Clone Repository:

Bash

git clone https://github.com/SanikaTribhuvan/CleanTrack.git
cd CleanTrack
Database Setup:

Start XAMPP and ensure Apache and MySQL are running.

Open phpMyAdmin (e.g., http://localhost/phpmyadmin).

Create a new database (e.g., cleantrack_db).

Import the provided .sql file (e.g., cleantrack.sql) into your new database.

Configure Database:

Find the database.php.example file (likely in application/config/).

Make a copy of this file and rename the copy to database.php.

Open the new database.php and fill in your local database details:

PHP

'hostname' => 'localhost',
'username' => 'root',       // Your MySQL username
'password' => '',          // Your MySQL password
'database' => 'cleantrack_db', // The database name you created
Run Application:

Ensure the project folder (CleanTrack) is in your C:\xampp\htdocs\ directory.

Open the application in your browser: http://localhost/CleanTrack/

Default Login Credentials
(Please add your system's default admin login credentials here)

Username: admin

Password: admin123
