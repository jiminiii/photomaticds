drop table resultface;
create table resultface(
   num int NOT NULL AUTO_INCREMENT primary key,
   faceID varchar(50),
   fname varchar(80),
   email varchar(30),
   pname varchar(30),
   psize int,
   ptime varchar(20),   
   FOREIGN KEY(email) REFERENCES member (email) ON UPDATE CASCADE ON DELETE CASCADE
);