DROP TABLE EOI;

CREATE TABLE EOI(
	EOIno 		INT PRIMARY KEY AUTO_INCREMENT,
	RefNo 		Varchar(5) NOT NULL,
	UserID 		INT NOT NULL,
	ApplyDate 	DATE NOT NULL DEFAULT CURRENT_DATE,
	FirstName	Varchar(20) NOT NULL,
	LastName	Varchar(20) NOT NULL,
	DOB			DATE NOT NULL,
	Gender		Varchar(2) NOT NULL,
	Address		Varchar(40) NOT NULL,
	Suburb		Varchar(40) NOT NULL,
	Postcode	INT CHECK (Postcode BETWEEN 0 AND 9999) NOT NULL,
	State		Varchar(3) NOT NULL,
	Email		Varchar(40) NOT NULL,
	PhoneNo		Varchar(12) NOT NULL,
	Skills		Varchar(128),
	OtherSkills	Varchar(1024),
	Status		ENUM('New', 'Current', 'Final') DEFAULT 'New',
	FOREIGN KEY	(RefNo) REFERENCES Job(RefNo) ON DELETE CASCADE,
	FOREIGN KEY (UserID) REFERENCES User(UserID) ON DELETE CASCADE,
	UNIQUE(UserID, RefNo)
	);
	
INSERT INTO 	EOI(RefNo, UserID, FirstName, LastName, DOB, Gender, Address,
				Suburb, Postcode, State, Email, Phoneno, Skills, OtherSkills)
VALUES			('ab123', 1, 'Slim', 'Shady', CURRENT_DATE, 'M', '8 Mile', 'Compton', 3196, 'VIC',
				'slim@shady.com', '0418696969', 'Listening', 'Rapping about yo mama');