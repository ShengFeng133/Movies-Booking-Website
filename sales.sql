CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seat_id VARCHAR(255) NOT NULL,
    ticket_num INT NOT NULL,
    ticket_price DECIMAL(10, 2) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    PhoneNumber VARCHAR(20) NOT NULL,
    showtimeString TEXT,
    moviename TEXT,
    Place TEXT,
    Username TEXT
    );
