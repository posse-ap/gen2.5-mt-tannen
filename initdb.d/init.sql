USE posse;

DROP TABLE IF EXISTS records;

CREATE TABLE records (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  date DATE NOT NULL,
  hour INT NOT NULL,
  language_id INT NOT NULL,
  content_id INT NOT NULL
);

INSERT INTO
  records (date, hour, language_id, content_id)
VALUES
  ("2022-11-03", 7, 3, 2),
  ("2022-11-05", 2, 3, 3),
  ("2022-11-18", 3, 5, 1),
  ("2022-11-22", 12, 1, 3),
  ("2022-11-13", 5, 2, 2);

DROP TABLE IF EXISTS languages;
CREATE TABLE languages (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  language VARCHAR(255) NOT NULL
);

INSERT INTO languages
(language)
VALUES
  ("JavaScript"),
  ("css"),
  ("PHP"),
  ("html"),
  ("Laravel"),
  ("SQL"),
  ("SHELL"),
  ("その他");

DROP TABLE IF EXISTS contents;

CREATE TABLE contents(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  content VARCHAR(255) NOT NULL
);

INSERT INTO contents
(content)
VALUES
  ("N予備校"),
  ("POSSE課題"),
  ("ドットインストール");
