drop table photo;
create table photo(
   num int NOT NULL AUTO_INCREMENT primary key,
   cate varchar(20),
   fname varchar(80),
   email varchar(30),
   pname varchar(30),
   psize int,
   ptime varchar(20),   
   FOREIGN KEY(email) REFERENCES member (email) ON UPDATE CASCADE ON DELETE CASCADE,
   FOREIGN KEY(cate) REFERENCES category (cate) ON UPDATE CASCADE ON DELETE CASCADE
);

