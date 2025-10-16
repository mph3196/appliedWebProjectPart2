-- Here is a collection of scripts to test the database after you've created it, still a work in progress ;)
-- Run these through phpMyAdmin
-- feel free to store your own test queries here <3 MH

-- Show all info about all members
SELECT * FROM Member;

-- Get the Dream Job of a member based on their Full Name
SELECT      FullName, DreamJob
FROM        Member
WHERE       FullName LIKE 'Morgan Hopkins';

-- Get the favourite language and quote for each Member
SELECT      FullName, FavLanguage, FavQuote
FROM        Member
ORDER BY    MemberID ASC;

-- Count how many people have each hobby
SELECT      Description, Count(*)
FROM        Hobby
GROUP BY	Description;

-- Select Member ID, Username, Full Name and Hobby Description from User, Member and Hobby tables. Order by User ID descending
SELECT      m.MemberID, u.Username, m.FullName, h.Description
FROM        Member m
JOIN        User u ON u.ID = m.UserID
JOIN        Hobby h on m.MemberId = h.MemberId
ORDER BY    u.ID DESC;