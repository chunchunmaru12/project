use OBRS;

CREATE TABLE customer(
    c_id int primary key auto_increment,
    c_contact bigint unique not null ,
    c_name varchar(255) not null,
    c_address varchar(255) not null,
    c_email varchar(255) unique not null ,
    c_password varchar(255) not null,
    license_picture varchar(255) not null,
    is_rented TINYINT not null default 0
);

CREATE TABLE admin(
    a_id int primary key auto_increment,
    a_name varchar(255) not null,
    a_address varchar(255) not null,
    a_email varchar(255) not null,
    a_password varchar(255) not null,
    a_contact bigint not null
);

CREATE TABLE bike(
    b_id int primary key auto_increment,
    b_name varchar(255) not null,
    b_brand varchar(255) not null,
    b_image varchar(255) not null,
    b_number_plate varchar(255) not null,
    b_color varchar(255) not null,
    b_rate int not null,
    b_status VARCHAR(50) NOT NULL DEFAULT 'available'
);
CREATE TABLE rent (
    r_id int PRIMARY KEY AUTO_INCREMENT,
    r_pickup_point varchar(255) NOT NULL,
    r_start_date date NOT NULL,
    r_end_date date NOT NULL,
    r_pickup_time TIME NOT NULL,
    r_drop_off_point varchar(255) NOT NULL,
    r_drop_off_time TIME NOT NULL,    
    r_status varchar(255) DEFAULT 'pending' NOT NULL,
    c_license_photo varchar(255) NOT NULL,
    customer_id int,
    bike_id int,
    FOREIGN KEY (customer_id) REFERENCES customer(c_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (bike_id) REFERENCES bike(b_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE payment (
    p_id int PRIMARY KEY AUTO_INCREMENT,
    p_amount int NOT NULL,
    c_id int,
    FOREIGN KEY (c_id) REFERENCES rent(customer_id) ON DELETE CASCADE ON UPDATE CASCADE
);


--     SELECT 
--     rent.r_id,
--     rent.r_pickup_point,
--     rent.r_start_date,
--     rent.r_end_date,
--     rent.r_pickup_time,
--     rent.r_drop_off_point,
--     rent.r_drop_off_time,
--     rent.r_status,
--     rent.is_returned,
--     customer.c_name,
--     customer.c_contact,
--     customer.c_address,
--     customer.c_email,
--     bike.b_name,
--     bike.b_brand,
--     bike.b_color,
--     bike.b_rate
-- FROM 
--     rent
-- JOIN 
--     customer ON rent.customer_id = customer.c_id
-- JOIN 
--     bike ON rent.bike_id = bike.b_id;
