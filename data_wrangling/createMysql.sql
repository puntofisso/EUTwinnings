CREATE TABLE nuts (

  code VARCHAR(10) PRIMARY KEY,
  level VARCHAR(1),
  name text,
  nuts0 VARCHAR(10),
  nuts1 VARCHAR(10),
  nuts2 VARCHAR(10),
  pop3 real,
  pop2 real,
  pop1 real,
  pop0 real,
  density real,
  fertility real,
  popchange real,
  womenratio real,
  gdppps real,
  gva real);

CREATE TABLE similarity (
  code1 VARCHAR(10),
  code2 VARCHAR(10),
  similarity real,
  PRIMARY KEY (code1, code2)
);

CREATE TABLE relations(code VARCHAR(10) PRIMARY KEY, name text,  level VARCHAR(1),  nuts0 VARCHAR(10), nuts1 VARCHAR(10), nuts2 VARCHAR(10), nuts3 VARCHAR(10));
