drop table folder;
create table folder(
   cate varchar(20) ,
   fname varchar(80),
   email varchar(30),
   fsize int,
   ftime varchar(20),
	FOREIGN KEY(email) REFERENCES member (email) ON UPDATE CASCADE ON DELETE CASCADE,
   FOREIGN KEY(cate) REFERENCES category (cate) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY(fname, email,cate)

);
insert into folder values ("human","selfie","jeongjimin96@gmail.com",0,18);
insert into folder values ("human","selfie","jeongjimin97@nate.com",0,19);