DROP TABLE IF EXISTS ezvattype;
CREATE TABLE ezvattype (
  id integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  name text(255) NOT NULL DEFAULT '',
  percentage float DEFAULT NULL
);
