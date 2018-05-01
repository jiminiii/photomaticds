
create table photo_hash(
photo_index int,
hash_index int,
FOREIGN KEY(hash_index) REFERENCES hashtag (hash_index) ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY(photo_index) REFERENCES photo (num) ON UPDATE CASCADE ON DELETE CASCADE
);

