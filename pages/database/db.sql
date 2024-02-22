use OBRS;

CREATE TABLE customer(
    c_id int primary key auto_increment,
    c_contact bigint not null,
    c_name varchar(255) not null,
    c_address varchar(255) not null,
    c_email varchar(255) unique not null ,
    c_password varchar(255) not null,
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
    b_color varchar(255) not null,
    b_rate int not null,
    b_status TINYINT DEFAULT 1 NOT NULL
);

CREATE TABLE rent(
    r_id int primary key auto_increment,
    r_pickup_time TIME not null,
    r_start_date date NOT NULL,
    r_end_date date NOT NULL,
    r_drop_off_time TIME NOT NULL,    
    r_status TINYINT DEFAULT 0 not null,
    c_license_photo varchar(255) not null,
    customer_id int,
    bike_id int,
    foreign key(customer_id) references customer(c_id),
    foreign key(bike_id) references bike(b_id)
);
CREATE TABLE payment(
    p_id int primary key auto_increment,
    p_status TINYINT DEFAULT 0,
    p_amount int not null,
    p_type varchar(255) not null
);