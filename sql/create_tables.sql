-- JOBS TABLE

DROP TABLE Jobs;

CREATE TABLE Jobs(
		RefNo		VarChar(5) PRIMARY KEY NOT NULL;
	);

INSERT INTO		Jobs(RefNo)
VALUES			('ab123');

-- USER TABLE

DROP TABLE User;

CREATE TABLE	User (
	ID 		        INT PRIMARY KEY AUTO_INCREMENT,
    Username        VARCHAR(128) NOT NULL UNIQUE,
    Password        Varchar(255) NOT NULL,
    Name            Varchar(128),
    Member          Boolean,
    login_attempts  INT,
    lockout_time    DATETIME
);

INSERT INTO		User(Username, Password, Name, Member)
VALUES 			('jtaylor', 'swinburne', 'Jonathon', True);

INSERT INTO		User(Username, Password, Name, Member)
VALUES 			('mhopkins', 'swinburne', 'Morgan', True);

INSERT INTO		User(Username, Password, Name, Member)
VALUES 			('svambe', 'swinburne', 'Shaun', True);

INSERT INTO		User(Username, Password, Name, Member)
VALUES 			('admin', 'admin', 'Administrator', False);

-- ABOUT TABLE

DROP TABLE About;

CREATE TABLE	ABOUT(
	AID			INT PRIMARY KEY AUTO_INCREMENT,
	Task		VARCHAR(128) NOT NULL,
	Description	Varchar(256) NOT NULL
)

-- EOI TABLE

DROP TABLE EOI;

CREATE TABLE EOI(
	EOIno 		INT PRIMARY KEY AUTO_INCREMENT,
	RefNo 		Varchar(5) NOT NULL,
	ID 	INT NOT NULL,
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
	FOREIGN KEY	(RefNo) REFERENCES Jobs(RefNo) ON DELETE CASCADE,
	FOREIGN KEY (ID) REFERENCES User(ID) ON DELETE CASCADE,
	UNIQUE(UserID, RefNo)
	);
	
INSERT INTO 	EOI(RefNo, Username, FirstName, LastName, DOB, Gender, Address,
				Suburb, Postcode, State, Email, Phoneno, Skills, OtherSkills)
VALUES			('ab123', 'realslimshady', 'Slim', 'Shady', CURRENT_DATE, 'M', '8 Mile', 'Compton', 3196, 'VIC',
				'slim@shady.com', '0418696969', 'Listening', 'Rapping about yo mama');

-- CONTRIBUTION TABLE

DROP TABLE Contribution;

CREATE TABLE	Contribution(
	CID		INT PRIMARY KEY AUTO_INCREMENT,
	ID		INT NOT NULL,
	AID		INT NOT NULL,
	FOREIGN KEY (ID) REFERENCES User(ID) ON DELETE CASCADE;
	FOREIGN KEY (AID) REFERENCES About(AID) ON DELETE CASCADE;
)
