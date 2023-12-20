CREATE Table User (
    id INT PRIMARY KEY auto_increment,
    first_name varchar(255),
    last_name varchar(255),
    email varchar(255),
    password varchar(255),
    phone varchar(255)
    );

CREATE TABLE Book (
    id INT PRIMARY KEY auto_increment,
    cover VARCHAR(255),
    title varchar(255),
    author varchar(255),
    genre varchar(255),
    description TEXT,
    publication_year DATE,
    total_copies INT,
    available_copies INT
);    

CREATE Table Role (
    id INT PRIMARY KEY auto_increment,
    name VARCHAR(255)
);

 CREATE Table Reservation(
    id INT PRIMARY KEY auto_increment,
    description TEXT,
    reservation_date DATE,
    return_date DATE,
    is_returned INT,
    id_user INT,
    id_book INT
    Foreign Key (id_user) REFERENCES User(id) on delete CASCADE,
    Foreign Key (id_book) REFERENCES Book(id) on delete CASCADE
 );

 CREATE Table User_Role(
    id_user INT,
    id_role INT,
    Foreign Key (id_user) REFERENCES Role(id) on delete CASCADE,
    Foreign Key (id_role) REFERENCES User(id) on delete CASCADE
 );



