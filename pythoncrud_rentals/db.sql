create database Rental_Management_Database;
show databases;
use Rental_Management_Database;
create table Landlords (
    landlord_id int(4) Primary key,
    full_name varchar(50) not null,
    phone varchar(20) not null,
    email varchar(100),
    password varchar(255) not null,
    created_at datetime default current_timestamp 
);

CREATE TABLE Customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(50) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Properties (
    property_id INT AUTO_INCREMENT PRIMARY KEY,
    landlord_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    location VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    status ENUM('Available', 'Rented') DEFAULT 'Available',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_landlord
        FOREIGN KEY (landlord_id)
        REFERENCES Landlords(landlord_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);


CREATE TABLE Rentals (
    rental_id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT NOT NULL,
    customer_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    payment_status ENUM('Paid', 'Pending') DEFAULT 'Pending',

    CONSTRAINT fk_property
        FOREIGN KEY (property_id)
        REFERENCES Properties(property_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_customer
        FOREIGN KEY (customer_id)
        REFERENCES Customers(customer_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
show databases;
use rental_management_database;
show tables;
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (1, 'John Smith', '0781111111');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (2, 'Maria Lopez', '0781111112');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (3, 'David Brown', '0781111113');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (4, 'James Wilson', '0781111114');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (5, 'Linda Taylor', '0781111115');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (6, 'Michael Johnson', '0781111116');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (7, 'Sarah Davis', '0781111117');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (8, 'Robert Miller', '0781111118');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (9, 'Jennifer Garcia', '0781111119');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (10, 'William Martinez', '0781111120');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (11, 'Daniel Anderson', '0781111121');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (12, 'Jessica Thomas', '0781111122');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (13, 'Christopher Moore', '0781111123');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (14, 'Amanda Jackson', '0781111124');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (15, 'Matthew White', '0781111125');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (16, 'Olivia Harris', '0781111126');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (17, 'Andrew Martin', '0781111127');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (18, 'Sophia Thompson', '0781111128');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (19, 'Joseph Clark', '0781111129');
INSERT INTO Landlords (landlord_id, full_name, phone) VALUES (20, 'Emma Lewis', '0781111130');

SHOW COLUMNS FROM properties;
INSERT INTO properties (landlord_id, title, description, location, price, status)
VALUES
(1, 'Modern Apartment', '2 bedroom modern apartment with balcony', 'Kigali - Kacyiru', 450000.00, 'Available'),
(2, 'Family House', 'Spacious 3 bedroom house with garden', 'Kigali - Kimihurura', 800000.00, 'Rented'),
(3, 'Studio Apartment', 'Small studio perfect for students', 'Kigali - Remera', 250000.00, 'Available'),
(1, 'Luxury Villa', '5 bedroom villa with swimming pool', 'Kigali - Nyarutarama', 1500000.00, 'Available'),
(4, 'Single Room', 'Affordable single room', 'Kigali - Nyamirambo', 120000.00, 'Rented'),
(5, 'Duplex House', '4 bedroom duplex house', 'Kigali - Kicukiro', 900000.00, 'Available'),
(2, 'Office Space', 'Commercial office space for rent', 'Kigali - CBD', 700000.00, 'Available'),
(3, 'Student Hostel Room', 'Shared hostel room near university', 'Kigali - Huye Campus Area', 100000.00, 'Rented'),
(6, 'Townhouse', '3 bedroom townhouse with parking', 'Kigali - Gacuriro', 650000.00, 'Available'),
(7, 'Luxury Apartment', 'High-end apartment with city view', 'Kigali - Kiyovu', 1100000.00, 'Available'),
(4, 'Small Family House', '2 bedroom family house', 'Kigali - Kanombe', 400000.00, 'Rented'),
(8, 'Serviced Apartment', 'Fully furnished serviced apartment', 'Kigali - Nyarugenge', 950000.00, 'Available'),
(5, 'Bungalow', 'Comfortable bungalow with yard', 'Kigali - Gisozi', 500000.00, 'Available'),
(6, 'Commercial Shop', 'Retail shop space', 'Kigali - Nyabugogo', 300000.00, 'Rented'),
(9, 'Penthouse', 'Luxury penthouse apartment', 'Kigali - Nyarutarama', 2000000.00, 'Available'),
(10, 'Guest House', 'Guest house with multiple rooms', 'Kigali - Kimironko', 850000.00, 'Available'),
(7, 'Mini Apartment', 'Compact one bedroom apartment', 'Kigali - Remera', 350000.00, 'Rented'),
(8, 'Large Villa', 'Spacious villa suitable for large family', 'Kigali - Gacuriro', 1700000.00, 'Available'),
(9, 'Studio Loft', 'Loft-style studio apartment', 'Kigali - Kiyovu', 420000.00, 'Available'),
(10, 'Warehouse', 'Large warehouse for storage or business', 'Kigali - Special Economic Zone', 1200000.00, 'Rented');

INSERT INTO Customers (full_name, phone, email)
VALUES
('Alice Johnson', '0712000001', 'alice.johnson@email.com'),
('Brian Smith', '0712000002', 'brian.smith@email.com'),
('Catherine Brown', '0712000003', 'catherine.brown@email.com'),
('David Wilson', '0712000004', 'david.wilson@email.com'),
('Emma Taylor', '0712000005', 'emma.taylor@email.com'),
('Frank Anderson', '0712000006', 'frank.anderson@email.com'),
('Grace Thomas', '0712000007', 'grace.thomas@email.com'),
('Henry Jackson', '0712000008', 'henry.jackson@email.com'),
('Isabella White', '0712000009', 'isabella.white@email.com'),
('James Harris', '0712000010', 'james.harris@email.com'),
('Karen Martin', '0712000011', 'karen.martin@email.com'),
('Liam Thompson', '0712000012', 'liam.thompson@email.com'),
('Mia Garcia', '0712000013', 'mia.garcia@email.com'),
('Noah Martinez', '0712000014', 'noah.martinez@email.com'),
('Olivia Robinson', '0712000015', 'olivia.robinson@email.com'),
('Paul Clark', '0712000016', 'paul.clark@email.com'),
('Queen Adams', '0712000017', 'queen.adams@email.com'),
('Ryan Lewis', '0712000018', 'ryan.lewis@email.com'),
('Sophia Walker', '0712000019', 'sophia.walker@email.com'),
('Thomas Hall', '0712000020', 'thomas.hall@email.com');

INSERT INTO Rentals (property_id, customer_id, start_date, end_date, payment_status)
VALUES
(1, 1, '2024-01-01', '2024-12-31', 'Paid'),
(2, 2, '2024-02-01', '2024-11-30', 'Pending'),
(3, 3, '2024-03-01', '2024-09-30', 'Paid'),
(4, 4, '2024-01-15', '2024-12-15', 'Pending'),
(5, 5, '2024-04-01', '2024-10-01', 'Paid'),
(6, 6, '2024-02-10', '2024-08-10', 'Paid'),
(7, 7, '2024-05-01', '2024-12-01', 'Pending'),
(8, 8, '2024-03-15', '2024-09-15', 'Paid'),
(9, 9, '2024-06-01', '2024-12-31', 'Pending'),
(10, 10, '2024-01-05', '2024-07-05', 'Paid'),
(11, 11, '2024-02-20', '2024-08-20', 'Pending'),
(12, 12, '2024-04-10', '2024-10-10', 'Paid'),
(13, 13, '2024-05-15', '2024-11-15', 'Pending'),
(14, 14, '2024-03-01', '2024-09-01', 'Paid'),
(15, 15, '2024-06-10', '2024-12-10', 'Pending'),
(16, 16, '2024-01-25', '2024-07-25', 'Paid'),
(17, 17, '2024-02-14', '2024-08-14', 'Pending'),
(18, 18, '2024-03-30', '2024-09-30', 'Paid'),
(19, 19, '2024-05-05', '2024-11-05', 'Pending'),
(20, 20, '2024-06-20', '2024-12-20', 'Paid');

select * from Landlords;
