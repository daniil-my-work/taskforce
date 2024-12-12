CREATE DATABASE php_2_project;

USE php_2_project;

CREATE TABLE
    `categories` (
        `id` int AUTO_INCREMENT PRIMARY KEY,
        `character_code` varchar(255),
        `name_category` varchar(255)
    );

CREATE TABLE
    `users` (
        `id` int AUTO_INCREMENT PRIMARY KEY,
        `date_registration` datetime,
        `user_name` varchar(255),
        `email` varchar(255),
        `user_password` char,
        `city` varchar(255),
        `user_role` varchar(255),
        `is_available` boolean
    );

CREATE TABLE
    `tasks` (
        `id` int AUTO_INCREMENT PRIMARY KEY,
        `date_public` datetime,
        `task_status_code` varchar(255),
        `task_status` varchar(255),
        `title` varchar(255),
        `task_description` text,
        `task_file` text,
        `budget` int,
        `date_finish` date,
        `city_id` int,
        `category_id` int,
        `client_id` int,
        `performer_id` int
    );

CREATE TABLE
    `cities` (
        `id` int AUTO_INCREMENT PRIMARY KEY,
        `city` int,
        `city_name` varchar(255),
        `city_lon` varchar(255),
        `city_lat` varchar(255)
    );

CREATE TABLE
    `reviews` (
        `id` int AUTO_INCREMENT PRIMARY KEY,
        `date_comment` datetime,
        `review_description` text,
        `review_mark` int,
        `reviewer` int
    );

CREATE TABLE
    `profile` (
        `id` int AUTO_INCREMENT PRIMARY KEY,
        `img` varchar(255),
        `birth_date` date,
        `user_description` varchar(255),
        `telephone` varchar(255),
        `telegram` varchar(255),
        `mark_id` int,
        `user_id` int,
        `review_id` int
    );

CREATE TABLE
    `response` (
        `id` int AUTO_INCREMENT PRIMARY KEY,
        `date_response` datetime,
        `response_description` text,
        `price` int,
        `performer` int,
        `response_mark` int
    );

ALTER TABLE `tasks` ADD FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

ALTER TABLE `tasks` ADD FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

ALTER TABLE `tasks` ADD FOREIGN KEY (`performer_id`) REFERENCES `users` (`id`);

ALTER TABLE `tasks` ADD FOREIGN KEY (`client_id`) REFERENCES `users` (`id`);

ALTER TABLE `reviews` ADD FOREIGN KEY (`reviewer`) REFERENCES `users` (`id`);

ALTER TABLE `profile` ADD FOREIGN KEY (`mark_id`) REFERENCES `reviews` (`id`);

ALTER TABLE `profile` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `response` ADD FOREIGN KEY (`performer`) REFERENCES `users` (`id`);