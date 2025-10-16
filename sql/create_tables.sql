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
VALUES ('svambe', 'swinburne', 'Shaun', TRUE);

INSERT INTO User(Username, Password, Name, Member)
VALUES ('mhopkins', 'swinburne', 'Morgan', TRUE);

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

-- MEMBER TABLE

DROP TABLE IF EXISTS Member;

CREATE TABLE Member( 
    MemberID    INT PRIMARY KEY NOT NULL, 
    UserID      INT NOT NULL, 
    FullName    VARCHAR(20), 
    Bio         VARCHAR(2048), 
    FavLanguage VARCHAR(20), 
    FavQuote    VARCHAR(256), 
    DreamJob    VARCHAR(128), 
    CodingSnack VARCHAR(30), 
    HomeTown    VARCHAR(30), 
    ProgLang    VARCHAR(12), 
    FunFact     VARCHAR(256), 
    FOREIGN KEY (UserID) REFERENCES User(ID) ON DELETE CASCADE
);

INSERT INTO Member(MemberID, UserID, FullName, Bio, FavLanguage, FavQuote,
                DreamJob, CodingSnack, HomeTown, ProgLang, FunFact)
VALUES (
    105118283,
    1,
    'Jonathon Taylor',
    'Jonathon is a 21 year old male and second year student from Melbourne Australia, 
    he is currently pursuing a Bachelors Degree in Computer Science, majoring in Cyber Security',
    'Dutch',
    'Streef niet naar succes als dat is wat je wilt; 
    gewoon doen waar je van houdt en in gelooft en de rest komt vanzelf.',
    'Security Engineer',
    'Coffee',
    'Bairnsdale, Australia',
    'C#',
    'Train the combat sport of Muay Thai in Thailand'
);

INSERT INTO Member(MemberID, UserID, FullName, Bio, FavLanguage, FavQuote,
                DreamJob, CodingSnack, HomeTown, ProgLang, FunFact)
VALUES (
    105920789,
    2,
    'Shaun Vambe',
    'Shaun is a 19 year old male first year student from Melbourne Australia, 
    he is currently pursuing a Bachelors Degree in Data Science',
    'Portuguese',
    'A melhor vingança é ser diferente daquele que causou o dano.',
    'Data scientist at a leading finance firm',
    'Coffee',
    'Melbourne, Australia',
    'HTML',
    'His favourite Batman comic is Dark Victory.'
);

INSERT INTO Member(MemberID, UserID, FullName, Bio, FavLanguage, FavQuote,
                DreamJob, CodingSnack, HomeTown, ProgLang, FunFact)
VALUES (
    106188591,
    3,
    'Morgan Hopkins',
    'Morgan is a 36 year old male first year student from Melbourne, Australia. He is currently pursuing a Bachelors Degree in Data Science',
    'Mandarin',
    '天下萬物都處於徹底的混亂之中;情況非常好',
    'Cybernetic Systems Engineer',
    'Whisky',
    'Chelsea Heights',
    'Python',
    'Cycled solo across England, Wales and Ireland'
);

-- ROLE TABLE

DROP TABLE IF EXISTS Role;

CREATE TABLE Role(
    RoleID          INT PRIMARY KEY AUTO_INCREMENT,
    MemberID        INT NOT NULL,
    Description     VarChar(1024),
    FOREIGN KEY (MemberID) REFERENCES Member(MemberID)
);

INSERT INTO Role(MemberID, Description)
VALUES      (105118283, 'Team Leader – keeping team on track to meet all set targets and deadlines');

INSERT INTO Role(MemberID, Description)
VALUES      (105118283, 'Lead Designer – maintaining a consistent, uniform and professional style across all pages of the site');

INSERT INTO Role(MemberID, Description)
VALUES      (105920789, 'Communications Manager – organising communication between team members, setting times for meetings, convening with teacher (Atie)');

INSERT INTO Role(MemberID, Description)
VALUES      (106188591, 'Lead Developer – ensuring functional html, CSS etc., markup validity and proper documentation and commenting for all pages of the site');

-- HOBBY TABLE

CREATE TABLE Hobby(
    HobbyID         INT PRIMARY KEY AUTO_INCREMENT,
    MemberID        INT NOT NULL,
    Description     VarChar(128),
    FOREIGN KEY (MemberID) REFERENCES Member(MemberID)
);

INSERT INTO Hobby(MemberID, Description)
VALUES      (105118283, 'Muay Thai');

INSERT INTO Hobby(MemberID, Description)
VALUES      (105118283, 'Hiking');

INSERT INTO Hobby(MemberID, Description)
VALUES      (105118283, 'Gaming');

INSERT INTO Hobby(MemberID, Description)
VALUES      (105118283, 'Watching MMA');

INSERT INTO Hobby(MemberID, Description)
VALUES      (105920789, 'Gaming');

INSERT INTO Hobby(MemberID, Description)
VALUES      (105920789, 'Reading');

INSERT INTO Hobby(MemberID, Description)
VALUES      (105920789, 'Football/Soccer');

INSERT INTO Hobby(MemberID, Description)
VALUES      (105920789, 'Playing Sport');

INSERT INTO Hobby(MemberID, Description)
VALUES      (106188591, 'Gaming');

INSERT INTO Hobby(MemberID, Description)
VALUES      (106188591, 'Cycling');

INSERT INTO Hobby(MemberID, Description)
VALUES      (106188591, 'Drinking');

INSERT INTO Hobby(MemberID, Description)
VALUES      (106188591, 'Dancing to Techno');

-- CONTRIBUTION TABLE

DROP TABLE IF EXISTS Contribution;

CREATE TABLE Contribution(
    CID INT PRIMARY KEY AUTO_INCREMENT,
    SID INT NOT NULL,
    AID INT NOT NULL,
    FOREIGN KEY (SID) REFERENCES Member(MemberID) ON DELETE CASCADE,
    FOREIGN KEY (AID) REFERENCES About(AID) ON DELETE CASCADE
);