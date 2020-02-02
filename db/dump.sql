use book_manager;

create table author
(
    id      int auto_increment
        primary key,
    name    varchar(255) not null,
    surname varchar(255) not null,
    email   varchar(255) not null,
    constraint author_email_uindex
        unique (email)
);

INSERT INTO book_manager.author (id, name, surname, email) VALUES (1, 'Stephen', 'King', 'king@mail.com');
INSERT INTO book_manager.author (id, name, surname, email) VALUES (2, 'Ray', 'Bradbury', 'bradbury@mail.com');
INSERT INTO book_manager.author (id, name, surname, email) VALUES (3, 'Charles', 'Bukowski', 'bukowski@mail.com');



create table book
(
    id           int auto_increment
        primary key,
    title        varchar(255) not null,
    description  longtext     null,
    release_date datetime     null
);

create index book_release_date_index
    on book (release_date);

INSERT INTO book_manager.book (id, title, description, release_date) VALUES (1, 'It', 'Description - It', null);
INSERT INTO book_manager.book (id, title, description, release_date) VALUES (2, 'Dandelion Wine', 'Description - Dandelion Wine', '1976-02-02 12:51:09');
INSERT INTO book_manager.book (id, title, description, release_date) VALUES (3, 'Book with three authors', 'Description - Book with three authors', '1980-03-02 12:52:29');



create table book_author
(
    author_id int not null,
    book_id   int not null,
    primary key (author_id, book_id),
    constraint book_author_author_id_fk
        foreign key (author_id) references author (id)
            on update cascade on delete cascade,
    constraint book_author_book_id_fk
        foreign key (book_id) references book (id)
            on update cascade on delete cascade
);

INSERT INTO book_manager.book_author (author_id, book_id) VALUES (1, 1);
INSERT INTO book_manager.book_author (author_id, book_id) VALUES (2, 2);
INSERT INTO book_manager.book_author (author_id, book_id) VALUES (1, 3);
INSERT INTO book_manager.book_author (author_id, book_id) VALUES (2, 3);
INSERT INTO book_manager.book_author (author_id, book_id) VALUES (3, 3);