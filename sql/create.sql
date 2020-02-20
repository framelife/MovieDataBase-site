DROP TABLE IF EXISTS MovieGenre;
DROP TABLE IF EXISTS MovieDirector;
DROP TABLE IF EXISTS MovieActor;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS MaxPersonID;
DROP TABLE IF EXISTS MaxMovieID;
DROP TABLE IF EXISTS MovieRating;
DROP TABLE IF EXISTS Actor;
DROP TABLE IF EXISTS Director;
DROP TABLE IF EXISTS Sales;
DROP TABLE IF EXISTS Movie;


-- THE ID of the Movie as the primary constraint which has to be unique 
-- THE ID of the Movie has the contstraint which need to be greater than 0 
-- THE year of the Movie has to be older than the nowdays date
CREATE TABLE Movie(
	id INT NOT NULL,
	title VARCHAR(100) NOT NULL,
	year INT NOT NULL,
	rating VARCHAR(10),
	company VARCHAR(50),
	PRIMARY KEY(id), 
	CHECK (year <= YEAR(curdate())),
	CHECK (id>=0) 
) ENGINE = INNODB;

-- The ID OF THE Actor as the primary constraint which has to be unique
-- The ID of the Actor has the constraint which need to be greater then 0
-- The DOD of the Actor has the constraint which need to less or euqal than current date
CREATE TABLE Actor(
	id INT NOT NULL,
	last VARCHAR(20) NOT NULL,
	first VARCHAR(20) NOT NULL,
	sex VARCHAR(6) NOT NULL,
	dob DATE NOT NULL,
	dod DATE,
	PRIMARY KEY (id), 
	CHECK (id>=0),
	CHECK (dob<= date_format(curdate(),'%Y%m%d'))
) ENGINE = INNODB;


-- The mid of the Sales has the primary constraint which has to be unique
-- The mid of the Sales has the referential integrity Constraint which need to be in the Movie(id)
CREATE TABLE Sales (
	mid INT NOT NULL,
	ticketsSold INT NOT NULL,
	totalIncome INT,
	PRIMARY KEY (mid),
	FOREIGN KEY (mid) REFERENCES Movie(id)
)	ENGINE = InnoDB;

-- The ID OF THE Director as the primary constraint which has to be unique
-- The ID of the Director has the constraint which need to be greater then 0
-- The DOD of the Director has the constraint which need to less or euqal than current date
CREATE TABLE Director(
	id INT NOT NULL,
	last VARCHAR(20) NOT NULL,
	first VARCHAR(20) NOT NULL,
	dob DATE NOT NULL,
	dod DATE,
	PRIMARY KEY (id),
	CHECK (id>=0),
	CHECK (dob<= date_format(curdate(),'%Y%m%d'))
) ENGINE = INNODB;

-- THE mid of the MovieGenre has referential integrity Constraint which need to be in the Movie(id)
CREATE TABLE MovieGenre(
	mid INT NOT NULL,
	genre VARCHAR(20) NOT NULL,
	FOREIGN KEY(mid) REFERENCES Movie(id) 
) ENGINE = INNODB;

-- THE mid of the MovieGenre has referential integrity Constraint which need to be in the Movie(id)
-- THE did of the MovieGenre has referential integrity Constraint which need to be in the Director(id)

CREATE TABLE MovieDirector(
	mid INT NOT NULL,
	did INT NOT NULL,
	FOREIGN KEY(mid) REFERENCES Movie(id), 
	FOREIGN KEY(did) REFERENCES Director(id)
	
) ENGINE = INNODB;

-- THE mid of the MovieActor has referential integrity Constraint which need to be in the Movie(id)
-- THE aid of the MovieActor has referential integrity Constraint which need to be in the Actor(id)
CREATE TABLE MovieActor(
	mid INT NOT NULL,
	aid INT NOT NULL,
	role VARCHAR(50),
	FOREIGN KEY(mid) REFERENCES Movie(id), 
	FOREIGN KEY(aid) REFERENCES Actor(id) 
) ENGINE = INNODB;

-- The mid of the MovieRating has the primary constraint which has to be unique 
-- THE mid of the MovieRating  has referential integrity constraint which need to be in the Movie(id)
CREATE TABLE MovieRating (
	mid INT NOT NULL,
	imdb INT,
	rot INT,
	PRIMARY KEY (mid),
	FOREIGN KEY (mid) REFERENCES Movie(id),
	CHECK(imdb >= 0 AND imdb <= 100),
	CHECK(rot >= 0 AND rot <= 100)
)ENGINE = INNODB;

-- THE mid of the Review has referential integrity constraint which need to be in the Movie(id)
-- The rating of the Review has the constraint which has to be in 0 to 5
-- The time of the Review has to be newer or equal than current time 
CREATE TABLE Review(
	name VARCHAR(20),
	time TIMESTAMP NOT NULL,
	mid INT NOT NULL,
	rating INT NOT NULL,
	comment VARCHAR(500),
	FOREIGN KEY(mid) REFERENCES Movie(id),
	CHECK (rating >= 0 AND rating <=5),
	CHECK (time <= CURRENT_TIMESTAMP)
) ENGINE = INNODB;

CREATE TABLE MaxPersonID(
	id INT NOT NULL
) ENGINE = INNODB;

create table MaxMovieID(
	id int NOT NULL
)ENGINE=INNODB;




