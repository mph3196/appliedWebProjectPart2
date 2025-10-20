-- JOBS TABLE 
DROP TABLE IF EXISTS JobPreferable;
DROP TABLE IF EXISTS JobEssential;
DROP TABLE IF EXISTS JobResponsibility;
DROP TABLE IF EXISTS Jobs;

CREATE TABLE Jobs(
    id INT PRIMARY KEY AUTO_INCREMENT,
    RefNo VARCHAR(5) UNIQUE NOT NULL,
    Title VARCHAR(100) NOT NULL,
    Salary VARCHAR(50) NOT NULL,
    ReportsTo VARCHAR(100) NOT NULL,
    ShortDescription TEXT NOT NULL
);

-- Insert main data into the Jobs table
INSERT INTO Jobs(RefNo, Title, Salary, ReportsTo, ShortDescription) VALUES 
('G03A1', 'IT Support Officer', '$78,000 – $85,000 per annum', 'Manager, Digital Learning & Research Support', 'Join our IT department to provide frontline support for digital learning platforms and research technologies that enhance teaching, learning, and innovation.'),
('G03C3', 'Research Data Analyst', '$88,000 – $95,000 per annum', 'Senior Research IT Coordinator', 'Provide data management, analytics, and visualization support for academic research projects.'),
('G03B2', 'Learning Technology Specialist', '$82,000 – $90,000 per annum', 'Manager, Digital Learning & Research Support', 'Support academics in designing and delivering online and blended learning experiences using the university digital platforms.'),
('G03D4', 'Systems Administrator', '$92,000 – $105,000 per annum', 'Head of IT Infrastructure', 'Maintain and secure the IT infrastructure supporting digital learning and research systems.');

-- Table for Key Responsibilities 
CREATE TABLE JobResponsibility (
    RespID INT PRIMARY KEY AUTO_INCREMENT,
    RefNo VARCHAR(5) NOT NULL,
    Description VARCHAR(1024) NOT NULL,
    FOREIGN KEY (RefNo) REFERENCES Jobs(RefNo) ON DELETE CASCADE
);

-- G03A1: Key Responsibilities
INSERT INTO JobResponsibility (RefNo, Description) VALUES
('G03A1', 'Provide technical support for digital learning platforms (LMS, collaboration tools).'),
('G03A1', 'Assist researchers with software, data storage, and secure computing resources.'),
('G03A1', 'Maintain system documentation and user guides.'),
('G03A1', 'Ensure accessibility and compliance with IT security policies.');

-- G03C3: Key Responsibilities
INSERT INTO JobResponsibility (RefNo, Description) VALUES
('G03C3', 'Support researchers with secure data storage solutions.'),
('G03C3', 'Assist in statistical analysis and visualization.'),
('G03C3', 'Ensure compliance with data security and ethics requirements.');

-- G03B2: Key Responsibilities
INSERT INTO JobResponsibility (RefNo, Description) VALUES
('G03B2', 'Train staff in effective use of the Learning Management System (LMS).'),
('G03B2', 'Collaborate on course design to ensure accessibility and engagement.'),
('G03B2', 'Evaluate and recommend new learning technologies.');

-- G03D4: Key Responsibilities
INSERT INTO JobResponsibility (RefNo, Description) VALUES
('G03D4', 'Manage servers, networks, and cloud environments.'),
('G03D4', 'Ensure uptime and security of digital platforms.'),
('G03D4', 'Implement system updates, patches, and backups.');

-- Table for Essential Requirements 
CREATE TABLE JobEssential (
    EssentialID INT PRIMARY KEY AUTO_INCREMENT,
    RefNo VARCHAR(5) NOT NULL,
    Description VARCHAR(1024) NOT NULL,
    FOREIGN KEY (RefNo) REFERENCES Jobs(RefNo) ON DELETE CASCADE
);

-- G03A1: Essential Requirements
INSERT INTO JobEssential (RefNo, Description) VALUES
('G03A1', 'Bachelor degree in Information Technology or related field.'),
('G03A1', 'Experience supporting digital learning or research systems.'),
('G03A1', 'Strong communication and problem-solving skills.');

-- G03C3: Essential Requirements
INSERT INTO JobEssential (RefNo, Description) VALUES
('G03C3', 'Bachelor Degree in Data Science, Statistics, or IT.'),
('G03C3', 'Experience with R, Python, or SPSS.');

-- G03B2: Essential Requirements
INSERT INTO JobEssential (RefNo, Description) VALUES
('G03B2', 'Bachelor in Education Technology, IT, or similar.'),
('G03B2', 'Experience with LMS platforms (e.g., Canvas, Blackboard).');

-- G03D4: Essential Requirements
INSERT INTO JobEssential (RefNo, Description) VALUES
('G03D4', 'Bachelor Degree in Information Systems or Computer Science.'),
('G03D4', 'Experience with Linux/Windows server administration.');

-- Table for Preferable Requirements 
CREATE TABLE JobPreferable (
    PreferableID INT PRIMARY KEY AUTO_INCREMENT,
    RefNo VARCHAR(5) NOT NULL,
    Description VARCHAR(1024) NOT NULL,
    FOREIGN KEY (RefNo) REFERENCES Jobs(RefNo) ON DELETE CASCADE
);

-- G03A1: Preferable Requirements
INSERT INTO JobPreferable (RefNo, Description) VALUES
('G03A1', 'Knowledge of accessibility standards in digital education.'),
('G03A1', 'Experience with cloud-based platforms (e.g., Microsoft Azure, AWS).'),
('G03A1', 'Familiarity with research data management practices.');

-- G03C3: Preferable Requirements
INSERT INTO JobPreferable (RefNo, Description) VALUES
('G03C3', 'Knowledge of big data tools (Hadoop, Spark).'),
('G03C3', 'Experience in higher education research projects.');

-- G03B2: Preferable Requirements
INSERT INTO JobPreferable (RefNo, Description) VALUES
('G03B2', 'Knowledge of instructional design frameworks.'),
('G03B2', 'Familiarity with accessibility standards (WCAG).');

-- G03D4: Preferable Requirements
INSERT INTO JobPreferable (RefNo, Description) VALUES
('G03D4', 'Knowledge of Cybersecurity frameworks.'),
('G03D4', 'Cloud certification (Azure, AWS, or GCP).');


-- USER TABLE

DROP TABLE IF EXISTS User;

CREATE TABLE User (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(128) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(128),
    member BOOLEAN,
);

INSERT INTO user(username, password_hash, name, member)
VALUES ('jtaylor', 'swinburne', 'Jonathon', TRUE);

INSERT INTO user(username, password_hash, name, member)
VALUES ('svambe', 'swinburne', 'Shaun', TRUE);

INSERT INTO user(username, password_hash, name, member)
VALUES ('mhopkins', 'swinburne', 'Morgan', TRUE);

INSERT INTO user(username, password_hash, name, member)
VALUES ('Admin', 'Admin', 'Administrator', FALSE);

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
    FOREIGN KEY (ID) REFERENCES Users1(ID) ON DELETE CASCADE,
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
