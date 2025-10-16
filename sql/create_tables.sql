-- JOBS TABLE

DROP TABLE IF EXISTS Jobs;

CREATE TABLE Jobs(
    RefNo VARCHAR(5) PRIMARY KEY NOT NULL
);

INSERT INTO Jobs(RefNo)
VALUES ('ab123');

-- USER TABLE

DROP TABLE IF EXISTS User;

CREATE TABLE User (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(128) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    Name VARCHAR(128),
    Member BOOLEAN,
    login_attempts INT,
    lockout_time DATETIME
);

INSERT INTO User(Username, Password, Name, Member)
VALUES ('jtaylor', 'swinburne', 'Jonathon', TRUE);

INSERT INTO User(Username, Password, Name, Member)
VALUES ('mhopkins', 'swinburne', 'Morgan', TRUE);

INSERT INTO User(Username, Password, Name, Member)
VALUES ('svambe', 'swinburne', 'Shaun', TRUE);

INSERT INTO User(Username, Password, Name, Member)
VALUES ('admin', 'admin', 'Administrator', FALSE);

-- ABOUT TABLE

DROP TABLE IF EXISTS ABOUT; 

CREATE TABLE ABOUT(
    AID INT PRIMARY KEY AUTO_INCREMENT,
    Task VARCHAR(128) NOT NULL,
    Description VARCHAR(256) NOT NULL
);

-- EOI TABLE
DROP TABLE IF EXISTS EOI;

CREATE TABLE EOI(
    EOIno INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    RefNo VARCHAR(5) NOT NULL,
    ID INT NOT NULL,
    ApplyDate DATE NOT NULL DEFAULT CURRENT_DATE,
    FirstName VARCHAR(20) NOT NULL,
    LastName VARCHAR(20) NOT NULL,
    DOB DATE NOT NULL,
    Gender VARCHAR(2) NOT NULL,
    Address VARCHAR(40) NOT NULL,
    Suburb VARCHAR(40) NOT NULL,
    Postcode INT NOT NULL,
    State VARCHAR(3) NOT NULL,
    Email VARCHAR(40) NOT NULL,
    PhoneNo VARCHAR(12) NOT NULL,
    Skills VARCHAR(128),
    OtherSkills VARCHAR(1024),
    Status ENUM('New', 'Current', 'Final') DEFAULT 'New',
    FOREIGN KEY (RefNo) REFERENCES Jobs(RefNo) ON DELETE CASCADE,
    FOREIGN KEY (ID) REFERENCES User(ID) ON DELETE CASCADE,
    UNIQUE(ID, RefNo),
    CONSTRAINT chk_postcode CHECK (Postcode BETWEEN 0 AND 9999)
);

INSERT INTO EOI(RefNo, ID, FirstName, LastName, DOB, Gender, Address,
    Suburb, Postcode, State, Email, PhoneNo, Skills, OtherSkills)
VALUES ('ab123', 1, 'Slim', 'Shady', CURDATE(), 'M', '8 Mile', 
    'Compton', 3196, 'VIC', 'slim@shady.com', '0418696969', 'Listening', 'Rapping about yo mama');

-- CONTRIBUTION TABLE

DROP TABLE IF EXISTS Contribution;

CREATE TABLE Contribution(
    CID INT PRIMARY KEY AUTO_INCREMENT,
    ID INT NOT NULL,
    AID INT NOT NULL,
    FOREIGN KEY (ID) REFERENCES User(ID) ON DELETE CASCADE,
    FOREIGN KEY (AID) REFERENCES About(AID) ON DELETE CASCADE
);