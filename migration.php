<?php


/** @var PDO $pdo */
require_once './pdo_ini.php';

$sql = <<<'SQL'
create database todo;

SQL;
$pdo->exec($sql);

$sql = <<<'SQL'
CREATE TABLE `todo`.`users` (  `id` int(5) NOT NULL,  `name` varchar(25) NOT NULL,  `email` varchar(25) NOT NULL,  `pass` varchar(25) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SQL;
$pdo->exec($sql);

$sql = <<<'SQL'

CREATE TABLE `todo`.`task` (  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
   `name` varchar(200) NOT NULL, 
    `date` date NOT NULL DEFAULT current_timestamp(), 
     `time` time NOT NULL DEFAULT current_timestamp(), 
      `status` tinyint(2) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `task` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;


SQL;
$pdo->exec($sql);

