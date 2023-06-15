CREATE DATABASE qumbaz;

use qumbaz;


-- admin

create table aboutsus(
    id int not null AUTO_INCREMENT PRIMARY KEY , 
    title varchar(250) not null,  
    description text not null
);

create table abouts(
   	id int not null AUTO_INCREMENT PRIMARY KEY , 
    title varchar(250) not null,
    description text, 
    image text
);

create table admins(
    id int not null AUTO_INCREMENT PRIMARY KEY , 
    name varchar(250) not null, 
    is_active enum('0','1') not null DEFAULT '0' , 
    email varchar(250) unique not null,
    password varchar(250) not null, 
    image text, 
    role enum('admin','super_admin') not null DEFAULT 'admin'
);

create table categories(
    id int not null AUTO_INCREMENT PRIMARY KEY, 
    category varchar(250) not null, 
    image text not null
);

create table classifications(
    id int not null AUTO_INCREMENT PRIMARY KEY, 
    categories_id int,
    FOREIGN KEY (categories_id) REFERENCES categories(id), 
    category varchar(250),
    image text not null
);

create table centralProducts(
    id int not null AUTO_INCREMENT PRIMARY KEY , 
    title varchar(250) not null, 
    image text not null
);

create table questions(
    id int not null AUTO_INCREMENT PRIMARY KEY, 
    question varchar(250) not null, 
    answer text not null
);

create table sliders(
   	id int not null AUTO_INCREMENT PRIMARY KEY , 
    image text not null
);

create table contacts(
    id int not null AUTO_INCREMENT PRIMARY KEY , 
    name varchar(250) not null, 
    icon varchar(250) not null, 
    information text not null
);

create table logos(
    id int not null AUTO_INCREMENT PRIMARY KEY , 
    name varchar(250)not null, 
    image text not null
);

create table socials(
   	id int not null AUTO_INCREMENT PRIMARY KEY , 
    name varchar(250) not null, 
    icon varchar(250) not null,
    link varchar(550) not null
);



-- user

create table customers(
    id int not null AUTO_INCREMENT PRIMARY KEY ,
    name varchar(250) not null,
    email varchar(250) unique not null,
    password varchar(250) not null,
    bio varchar(250),
    image text,
    address varchar(250)not null
);
    
create table customer_details(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    phone varchar(100) not null,
    pay_account varchar(250) not null,
    pay_number varchar(250) not null,
    customer_id int,
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

create table producers(
    id int not null AUTO_INCREMENT PRIMARY KEY ,
    name varchar(250) not null,
    email varchar(250) unique not null,
    password varchar(250) not null,
    bio varchar(250),
    image text,
    address varchar(250)not null
);

create table producer_details(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    phone varchar(100) not null,
    pay_account varchar(250) not null,
    pay_number varchar(250) not null,
    producer_id int,
    FOREIGN KEY (producer_id) REFERENCES producers(id)
);

create table accounts(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    customer_id int,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    producer_id int,
    FOREIGN KEY (producer_id) REFERENCES producers(id)
);

create table products(
    id int not null AUTO_INCREMENT PRIMARY KEY ,
    name varchar(250) not null,
    image varchar(250) not null,
    price double not null,
    details text not null,
    quantity int not null,
    discount int,
    clasify_id int,
    FOREIGN KEY (clasify_id) REFERENCES classifications(id),
    producer_id int,
    FOREIGN KEY (producer_id) REFERENCES producers(id)
);

create table orders(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    quantity int not null,
    ordered_at datetime DEFAULT now(),
    total_price int,
    customer_id int,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    product_id int,
    FOREIGN KEY (product_id) REFERENCES products(id),
    producer_id int,
    FOREIGN KEY (producer_id) REFERENCES producers(id)
);

create table delivaries(
    id int not null AUTO_INCREMENT PRIMARY KEY ,
    company varchar(250) not null,
    email varchar(250) unique not null,
    response text
);

create table delivary_phones(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    delivary_id int,
    FOREIGN KEY (delivary_id) REFERENCES delivaries(id),
    phone varchar(100) not null
);



CREATE TABLE carts (
    id int not null AUTO_INCREMENT PRIMARY KEY, 
    customer_id int,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    product_id INT,
    FOREIGN KEY (product_id) REFERENCES products(id)
);
create table favourites(
    id int not null AUTO_INCREMENT PRIMARY KEY , 
    customer_id int,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    product_id INT,
    FOREIGN KEY (product_id) REFERENCES products(id)
);