/**
SEED RANDOM TEST USERS
FOR THE DATABASE TABLES
*/

<?php
// Replace these variables with your database credentials
$dbName = "db__real__estate";
$dbUser = "root";
$dbPassword = "";

// Create a connection to the database
$connection = new PDO("mysql:host=localhost;dbname=$dbName", $dbUser, $dbPassword);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create the "users" table
$createUsersTableQuery = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL
)";
$connection->exec($createUsersTableQuery);

// Create the "usersonplot" table
$createUsersonplotTableQuery = "
CREATE TABLE IF NOT EXISTS usersonplot (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    plot_name VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";
$connection->exec($createUsersonplotTableQuery);

// Create the "plots" table
$createPlotsTableQuery = "
CREATE TABLE IF NOT EXISTS plots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plot_name VARCHAR(255) NOT NULL
)";
$connection->exec($createPlotsTableQuery);

// Insert sample data into the "users" table
$insertUsersDataQuery = "
INSERT INTO users (username, email, password, role) VALUES
('user1', 'user1@example.com', 'password1', 'user'),
('user2', 'user2@example.com', 'password2', 'user'),
('admin', 'admin@example.com', 'adminpassword', 'admin')
";
$connection->exec($insertUsersDataQuery);

// Insert sample data into the "usersonplot" table
$insertUsersonplotDataQuery = "
INSERT INTO usersonplot (user_id, plot_name) VALUES
(1, 'Plot A'),
(2, 'Plot B'),
(3, 'Plot C')
";
$connection->exec($insertUsersonplotDataQuery);

// Insert sample data into the "plots" table
$insertPlotsDataQuery = "
INSERT INTO plots (plot_name) VALUES
('Plot A'),
('Plot B'),
('Plot C')
";
$connection->exec($insertPlotsDataQuery);

echo "Database and tables created, and sample data inserted.";
?>