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
        plot_id INT NOT NULL,
        amount DECIMAL(10, 2) NOT NULL,
        payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (plot_id) REFERENCES plots(id)
    )";
    $connection->exec($createPaymentsTableQuery);

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
        plot_id INT,
        status VARCHAR(50) NOT NULL,
        occupation VARCHAR(255) NOT NULL,
        payment_plan VARCHAR(50) NOT NULL,
        user_budget DECIMAL(10, 2) NOT NULL,
        desired_locations TEXT NOT NULL,
        extra_description TEXT,
        FOREIGN KEY (user_id) REFERENCES users(id)
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


    // Insert sample data into the "users" table
    $insertUsersDataQuery = "
    INSERT INTO users (username, email, password, role) VALUES
    ('user1', 'user1@example.com', 'password1', 'user'),
    ('user2', 'user2@example.com', 'password2', 'user'),
    ('admin', 'admin@example.com', 'adminpassword', 'admin')
    ";
    $connection->exec($insertUsersDataQuery);

    // Insert sample data into the "plots" table
    $insertPlotsDataQuery = "
    INSERT INTO plots (plot_name, location, size, price, image_path) VALUES
    ('Plot A', 'Location A', 500, 100000, 'uploads/plot_a_image.jpg'),
    ('Plot B', 'Location B', 600, 120000, 'uploads/plot_b_image.jpg'),
    ('Plot C', 'Location C', 700, 150000, 'uploads/plot_c_image.jpg')
    ";
    $connection->exec($insertPlotsDataQuery);

    // Insert sample data into the "usersonplot" table
    $insertUsersonplotDataQuery = "
    INSERT INTO usersonplot (user_id, plot_id, status, occupation, payment_plan, user_budget, desired_locations, extra_description) VALUES
    (1, 1, 'paid', 'Engineer', 'monthly', 120000, 'Location A, Location B', 'Looking for a plot for residential purpose'),
    (2, 2, 'paid', 'Architect', 'quarterly', 150000, 'Location C', 'Interested in a plot with a good view'),
    (3, 3, 'scheduled', 'Admin Professional', 'annual', 200000, 'Location D', 'Admin application for testing')
    ";
    $connection->exec($insertUsersonplotDataQuery);

    // Insert sample data into the "notifications" table
    $insertNotificationsDataQuery = "
    INSERT INTO notifications (user_id, message) VALUES
    (1, 'Notification 1 for User 1'),
    (2, 'Notification 1 for User 2'),
    (3, 'Notification 1 for Admin'),
    (1, 'Notification 2 for User 1')
    ";
    $connection->exec($insertNotificationsDataQuery);

    // Insert sample data into the "payments" table
    $insertPaymentsDataQuery = "
    INSERT INTO payments (user_id, plot_id, amount, payment_date) VALUES
    (1, 1, 50000, '2023-01-15'),
    (2, 2, 75000, '2023-02-20'),
    (1, 3, 60000, '2023-03-25'),
    (3, 1, 80000, '2023-04-10')
    ";
    $connection->exec($insertPaymentsDataQuery);

    // Insert sample data into the "property_tours" table
    $insertPropertyToursDataQuery = "
    INSERT INTO property_tours (plot_id, tour_date, additional_notes) VALUES
    (1, '2024-01-15 10:00:00', 'First tour of the property.'),
    (2, '2024-02-20 14:00:00', 'VIP tour for potential investor.'),
    (3, '2024-03-25 09:00:00', 'Tour cancelled due to scheduling conflict.')
    ";
    $connection->exec($insertPropertyToursDataQuery);

    // Insert sample media into the "plot_media" table with descriptions
    $insertPlotMediaDataQuery = "
    INSERT INTO plot_media (plot_id, media_type, media_path, description) VALUES
    (1, 'image', 'uploads/plot1_img1.jpg', 'Front view of Plot A'),
    (1, 'image', 'uploads/plot1_img2.jpg', 'Rear garden of Plot A'),
    (2, 'video', 'uploads/plot2_video.mp4', 'Virtual tour of Plot B'),
    (3, 'image', 'uploads/plot3_img1.jpg', 'Scenic surroundings of Plot C')
    ";
    $connection->exec($insertPlotMediaDataQuery);



    echo "Database and tables created, and sample data inserted.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
