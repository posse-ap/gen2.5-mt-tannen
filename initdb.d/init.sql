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
  ("2022-11-23", 5, 2, 2);

DROP TABLE IF EXISTS languages;
CREATE TABLE languages (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  language VARCHAR(255) NOT NULL,
  color VARCHAR(255) NOT NULL
);

INSERT INTO languages
(color, language)
VALUES
  ("#729321","JavaScript"),
  ("#629351","css"),
  ("#429311","PHP"),
  ("#529361","html"),
  ("#329381","Laravel"),
  ("#229319","SQL"),
  ("#129312","SHELL"),
  ("#829311","その他");

DROP TABLE IF EXISTS contents;

CREATE TABLE contents(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  content VARCHAR(255) NOT NULL,
  color VARCHAR(255) NOT NULL
);

INSERT INTO contents
(color, content)
VALUES
  ("#729321","N予備校"),
  ("#629321","POSSE課題"),
  ("#529321","ドットインストール");
