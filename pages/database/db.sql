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


insert into admin(a_name,a_address,a_email,a_password,a_contact) values('admin','patan','test@gmail.com','$2y$10$p3R68mll5yVga4HjdJGXuO/4kyVHCut8eu4klw8MxmJda0JC1ipLa','9851121052');
-- password: noorullah