<?php


/** @var PDO $pdo */
require_once './pdo_ini.php';

$sql = <<<'SQL'
create database list;

SQL;
$pdo->exec($sql);

$sql = <<<'SQL'
CREATE TABLE `users` (  `id` int NOT NULL AUTO_INCREMENT ,
  `name` varchar(25) NOT NULL, 
  `email` varchar(25) NOT NULL, 
  `pass` varchar(25) NOT NULL, 
  PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SQL;
$pdo->exec($sql);

$sql = <<<'SQL'

CREATE TABLE `task` (  `id` int NOT NULL AUTO_INCREMENT ,
  `user_id` int(100) NOT NULL,
   `name` varchar(200) NOT NULL, 
    `date` date NOT NULL DEFAULT current_timestamp(), 
     `time` time NOT NULL DEFAULT current_timestamp(), 
      `status` tinyint(2) NOT NULL,
    PRIMARY KEY (id))
    ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `task` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;


SQL;
$pdo->exec($sql);

