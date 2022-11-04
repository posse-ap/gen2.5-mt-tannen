DROP SCHEMA IF EXISTS quizy;

CREATE SCHEMA quizy;

USE quizy;

CREATE TABLE big_questions (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);

INSERT INTO
  big_questions (name)
VALUES
  ("東京の難読地名クイズ"),
  ("広島県の難読地名クイズ");

DROP TABLE IF EXISTS questions;
CREATE TABLE questions (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  big_question_id INT NOT NULL,
  image VARCHAR(255)
);

INSERT INTO questions
(big_question_id, image)
VALUES
  (1, "takanawa.jpg"),
  (1, "kameido.jpg"),
  (2, "mukainada.jpg");

DROP TABLE IF EXISTS choices;
CREATE TABLE choices (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  quistion_id INT NOT NULL,
  name VARCHAR(255) NOT NULL,
  valid BOOLEAN NOT NULL
);

INSERT INTO choices
(quistion_id, name, valid)
VALUES
  (1, "たかなわ", 1),
  (1, "たかわ", 0),
  (1, "こうわ", 0),
  (2, "かめと", 0),
  (2, "かめど", 0),
  (2, "かめいど", 1),
  (3, "むこうひら", 0),
  (3, "むかいこうじ", 0),
  (3, "むかいなだ", 1);

