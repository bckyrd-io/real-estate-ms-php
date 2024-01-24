<?php
/*
=======================================================================
===                                                                 ===
===              REAL ESTATE APPLICATION DATABASE SETUP             ===
===                                                                 ===
=======================================================================

This PHP script sets up the database for the Real Estate application.

1. It defines the database name, username, and password.
2. Establishes a connection to the MySQL server.
3. Creates the database if it doesn't exist.
4. Switches to the real estate database.
5. Creates tables for users, plots, payments, notifications, and user-plot associations if they don't exist.
6. Inserts sample data into the users, plots, and user-plot association tables.
7. Inserts sample notification data for testing.

=======================================================================
*/

// Replace these variables with your database credentials
$dbName = "real__estate";
$dbUser = "root";
$dbPassword = "";

try {
    // Create a connection to the MySQL server
    $mysqlConnection = new PDO("mysql:host=localhost", $dbUser, $dbPassword);
    $mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the database if it doesn't exist
    $createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $dbName";
    $mysqlConnection->exec($createDatabaseQuery);

    // Switch to the real estate database
    $connection = new PDO("mysql:host=localhost;dbname=$dbName", $dbUser, $dbPassword);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the "users" table
    $createUsersTableQuery = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('user', 'admin') NOT NULL,
        UNIQUE KEY (id)
    )";
    $connection->exec($createUsersTableQuery);

    // Create the "plots" table
    $createPlotsTableQuery = "
    CREATE TABLE IF NOT EXISTS plots (
        id INT AUTO_INCREMENT PRIMARY KEY,
        plot_name VARCHAR(255) NOT NULL,
        location VARCHAR(255) NOT NULL,
        size INT NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        image_path VARCHAR(255) NOT NULL,
        UNIQUE KEY (id)
    )";
    $connection->exec($createPlotsTableQuery);

    // Create the "payments" table
    $createPaymentsTableQuery = "
    CREATE TABLE IF NOT EXISTS payments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";
    $connection->exec($createPaymentsTableQuery);

    // Create the "staff" table
    $createStaffTableQuery = "
    CREATE TABLE IF NOT EXISTS staff (
        id INT AUTO_INCREMENT PRIMARY KEY,
        staff_name VARCHAR(255) NOT NULL,
        address VARCHAR(255) NOT NULL,
        plot_id INT NULL
    )";
    $connection->exec($createStaffTableQuery);

    // Create the "notifications" table
    $createNotificationsTableQuery = "
    CREATE TABLE IF NOT EXISTS notifications (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        message TEXT NOT NULL,
        notification_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";
    $connection->exec($createNotificationsTableQuery);

    // Create the "usersonplot" table
    $createUsersonplotTableQuery = "
    CREATE TABLE IF NOT EXISTS usersonplot (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        plot_id INT NOT NULL,
        status VARCHAR(50),
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (plot_id) REFERENCES plots(id)
    )";
    $connection->exec($createUsersonplotTableQuery);

    // Create the "property_tours" table
    $createPropertyToursTableQuery = "
     CREATE TABLE IF NOT EXISTS property_tours (
         id INT AUTO_INCREMENT PRIMARY KEY,
         plot_id INT NOT NULL,
         tour_date DATETIME NOT NULL,
         additional_notes TEXT,
         FOREIGN KEY (plot_id) REFERENCES plots(id)
     )";
    $connection->exec($createPropertyToursTableQuery);

    // Modify the table creation query for plot_media to include a description column
    $createPlotMediaTableQuery = "
    CREATE TABLE IF NOT EXISTS plot_media (
        id INT AUTO_INCREMENT PRIMARY KEY,
        plot_id INT NOT NULL,
        media_type ENUM('image', 'video') NOT NULL,
        media_path VARCHAR(255) NOT NULL,
        description TEXT,
        FOREIGN KEY (plot_id) REFERENCES plots(id)
    )";
    $connection->exec($createPlotMediaTableQuery);


    echo "Database and tables created, and sample data inserted.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
