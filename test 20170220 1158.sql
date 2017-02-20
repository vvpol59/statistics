--
-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 7.2.53.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 20.02.2017 11:58:13
-- Версия сервера: 5.5.5-10.1.14-MariaDB
-- Версия клиента: 4.1
--


-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установить режим SQL (SQL mode)
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

-- 
-- Установка базы данных по умолчанию
--
USE test;

--
-- Описание для таблицы st_test
--
DROP TABLE IF EXISTS st_test;
CREATE TABLE st_test (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  surname VARCHAR(50) NOT NULL,
  added_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status ENUM('new','registered','refused','unavailable') DEFAULT 'new',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 21
AVG_ROW_LENGTH = 819
CHARACTER SET utf8
COLLATE utf8_general_ci;

-- 
-- Вывод данных для таблицы st_test
--
INSERT INTO st_test VALUES
(1, 'Миклухо', 'Маклай', '2017-02-20 05:26:10', 'registered'),
(2, 'Крокодил', 'Гена', '2017-02-21 05:26:30', 'registered'),
(3, 'Старуха', 'Шапокляк', '2017-02-22 05:27:05', 'registered'),
(4, 'Доктор', 'Ватсон', '2017-02-23 05:27:22', 'new'),
(5, 'Змей', 'Горыныч', '2017-02-23 05:28:11', 'registered'),
(6, 'Чак', 'Норис', '2017-02-24 05:28:45', 'registered'),
(7, 'Машина', 'Времени', '2017-02-24 05:29:18', 'registered'),
(8, 'Иван', 'Дурак', '2017-02-25 05:29:41', 'registered'),
(9, 'Московский', 'Спартак', '2017-02-25 05:29:56', 'new'),
(10, 'Старуха', 'Изергиль', '2017-02-25 05:30:44', 'new'),
(11, 'Отец', 'Крёстный', '2017-02-25 05:30:59', 'new'),
(12, 'Бубель', 'Гум', '2017-02-26 05:31:21', 'new'),
(13, 'Сектор', 'Газа', '2017-02-26 05:31:44', 'registered'),
(14, 'Педаль', 'Тормоза', '2017-02-27 05:31:57', 'new'),
(15, 'Тестовое', 'Задание', '2017-02-27 05:33:58', 'new'),
(16, 'Кот', 'Васька', '2017-02-27 05:34:13', 'registered'),
(17, 'Баба', 'Яга', '2017-02-27 05:34:22', 'new'),
(18, 'Кощей', 'Бессмертный', '2017-02-28 05:34:38', 'new'),
(19, 'Лиса', 'Алиса', '2017-02-28 05:34:58', 'registered'),
(20, 'Время', 'Московское', '2017-02-28 06:40:29', 'new');

-- 
-- Восстановить предыдущий режим SQL (SQL mode)
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;