<?php


/** @var PDO $pdo */
require_once './pdo_ini.php';

$sql = <<<'SQL'
create database todo;

SQL;
$pdo->exec($sql);

$sql = <<<'SQL'
CREATE TABLE `todo1`.`users`
( `id` INT NOT NULL ,
 `name` VARCHAR(150) NOT NULL , 
 `pass` VARCHAR(150) NOT NULL ,
  `email` INT(150) NOT NULL , 
  PRIMARY KEY (`id`)) ENGINE = InnoDB;

SQL;
$pdo->exec($sql);

$sql = <<<'SQL'

CREATE TABLE `todo1`.`task` 
( `id` INT NOT NULL ,
 `name` VARCHAR(500) NOT NULL , 
 `user_id` INT NOT NULL , 
 `date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , 
 `time` INT NOT NULL DEFAULT CURRENT_TIMESTAMP , 
 `status` TINYINT(2) NOT NULL , 
 PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `task` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

SQL;
$pdo->exec($sql);

