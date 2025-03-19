create database `library`;

use `library`;

create table if not exists books
(
    id               int auto_increment primary key,
    title            varchar(255) not null,
    author           varchar(255) not null,
    publication_year smallint     not null,
    created_at timestamp default CURRENT_TIMESTAMP null
);

create table if not exists users
(
    id         int auto_increment primary key,
    full_name  varchar(50)                        null,
    created_at timestamp default CURRENT_TIMESTAMP null
);

create table if not exists orders
(
    id          int auto_increment primary key,
    user_id     int  null,
    book_id     int  null,
    issue_date  date null,
    return_date date null,
    created_at timestamp default CURRENT_TIMESTAMP null,

    constraint orders_users_fk
        foreign key (user_id) references users (id)
            on delete cascade,
    constraint orders_books_fk
        foreign key (book_id) references books (id)
            on delete cascade
);

create index book_id on orders (book_id);
create index user_id on orders (user_id);