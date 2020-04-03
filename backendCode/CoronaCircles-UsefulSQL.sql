--New user (host or guest)
INSERT INTO `USER` (`FIRSTNAME`, `LASTNAME`, `DISPLAYNAME`, `EMAILADDRESS`) VALUES
('Pedro', 'Pereira', 'Pedro', 'ppereira@unizh.ch');

--New circle, no URL
INSERT INTO `CIRCLE` (`NAME`, `DESCRIPTION`, `FREQUENCY`, `URL`) VALUES
('Griet\'s small circle', 'Deep listening with Griet', 'Single Event', NULL);

-------------------------------------------------------------------
--Modify circle, set Jitsi URL
-------------------------------------------------------------------
--By primary key
UPDATE `CIRCLE` SET `URL` = 'Jitsi meeting URL' WHERE `ID` = 1;

--By circle name
UPDATE `CIRCLE` c, (SELECT `ID` FROM `CIRCLE` WHERE `NAME` = 'Gail\'s circle') curr
SET `URL` = 'Jitsi meeting URL3'
WHERE c.`ID` = curr.`ID`;
-------------------------------------------------------------------

--Find user ID by email address (Note: email address is unique in the table USER, i.e. no 2 users may have same email address)
SELECT u.ID
FROM USER u, (SELECT ID FROM USER WHERE EMAILADDRESS='simona.bonardi@mydomain.net') curr
WHERE u.ID = curr.ID;

--Find circle ID by name (Note: name is unique in the table CIRCLE, i.e. no 2 circles may have the same name)
--Note: This is a strict assumption for the proof-of-concept and would be removed for the real project
SELECT c.ID
FROM CIRCLE c, (SELECT ID FROM CIRCLE WHERE NAME = 'Gail\'s circle') curr
WHERE c.ID = curr.ID;

--New association circle to host (after creating a new circle)
INSERT INTO CIRCLEUSER (CU2CIRCLE, CU2USER, ISHOST) VALUES
(x, y, 1);
--x is the circle ID
--y is the user ID

--New association circle to guest (join existing circle)
INSERT INTO CIRCLEUSER (CU2CIRCLE, CU2USER, ISHOST) VALUES
(x, y, 0);
--x is the circle ID
--y is the user ID

--Find all circles/events on a given date (order by time)
SELECT c.NAME AS CircleName, c.DESCRIPTION AS CircleDescription, u.DISPLAYNAME AS Host, CONCAT(e.DATE,' ',e.time,e.TIMEZONE) AS Schedule
FROM USER u, CIRCLEUSER cu, CIRCLE c, EVENT e
WHERE cu.CU2USER = u.ID
AND cu.CU2CIRCLE = c.ID
AND cu.ISHOST = 1
AND e.EVENT2CIRCLE = c.ID
AND e.DATE = '2020-04-01'
ORDER BY 4 ASC;

--Find all circles by user
SELECT c.ID, c.NAME, c.DESCRIPTION, c.URL, 'Host' ISHOST
FROM USER u, (SELECT ID FROM USER WHERE EMAILADDRESS='simona.bonardi@mydomain.net') curr, CIRCLEUSER cu, CIRCLE c
WHERE u.ID = curr.ID
AND cu.CU2USER = u.ID
AND cu.CU2CIRCLE = c.ID
AND cu.ISHOST = 1
UNION
SELECT c.ID, c.NAME, c.DESCRIPTION, c.URL, 'Guest'
FROM USER u, (SELECT ID FROM USER WHERE EMAILADDRESS='simona.bonardi@mydomain.net') curr, CIRCLEUSER cu, CIRCLE c
WHERE u.ID = curr.ID
AND cu.CU2USER = u.ID
AND cu.CU2CIRCLE = c.ID
AND cu.ISHOST = 0;

--Find all circles by user/host
SELECT c.ID, c.NAME, c.DESCRIPTION, c.URL, 'Host' ISHOST
FROM USER u, (SELECT ID FROM USER WHERE EMAILADDRESS='simona.bonardi@mydomain.net') curr, CIRCLEUSER cu, CIRCLE c
WHERE u.ID = curr.ID
AND cu.CU2USER = u.ID
AND cu.CU2CIRCLE = c.ID
AND cu.ISHOST = 1;

--Find all circles by user/guest
SELECT c.ID, c.NAME, c.DESCRIPTION, c.URL, 'Guest' ISHOST
FROM USER u, (SELECT ID FROM USER WHERE EMAILADDRESS='simona.bonardi@mydomain.net') curr, CIRCLEUSER cu, CIRCLE c
WHERE u.ID = curr.ID
AND cu.CU2USER = u.ID
AND cu.CU2CIRCLE = c.ID
AND cu.ISHOST = 0;
