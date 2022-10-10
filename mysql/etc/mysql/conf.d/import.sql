CREATE TABLE 'big_questions'
(
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `photo` Blob  NOT NULL,
  `choice` array NOT NULL,
  PRIMARY KEY (`id`)
) 

INSERT INTO `big_questions` VALUES
 (1,'photo1','array1'),
 (2,'photo2','array2');

 CREATE TABLE 'choice'
(
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `correct` int(3)  NOT NULL,
  `wrong1` int(3) NOT NULL,
  'wrong2' int(3) NOT NULL
  PRIMARY KEY (`id`)
) 

INSERT INTO `big_questions` VALUES
 (1,'たかなわ','たかわ','こうわ'),
 (2,'かめいど','かめど','かめと'),
 (3, 'ひろしま','ひろひろ','しましま');