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