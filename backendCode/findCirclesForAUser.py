#!/usr/bin/python3
#
# Corona Circles, codevscovid19 hackathon Zurich
# by Christopher Rehm 29-30 mar 2020, christopherrehm@web.de

import sys
import MySQLdb


def findCirclesForAUser(userEmail):
    conn = MySQLdb.connect(host="rdbms.strato.de",
                           user="U4098787",
                           passwd="1light1light!!", db="DB4098787")
    cursor = conn.cursor()
    sql = """SELECT c.ID, c.NAME, c.DESCRIPTION, c.URL, 'Host' ISHOST
    FROM USER u, (SELECT ID FROM USER WHERE
    EMAILADDRESS='%s') curr, CIRCLEUSER cu, CIRCLE c
    WHERE u.ID = curr.ID
    AND cu.CU2USER = u.ID
    AND cu.CU2CIRCLE = c.ID
    AND cu.ISHOST = 1
    UNION
    SELECT c.ID, c.NAME, c.DESCRIPTION, c.URL, 'Guest'
    FROM USER u, (SELECT ID FROM USER WHERE
    EMAILADDRESS='%s') curr, CIRCLEUSER cu, CIRCLE c
    WHERE u.ID = curr.ID
    AND cu.CU2USER = u.ID
    AND cu.CU2CIRCLE = c.ID
    AND cu.ISHOST = 0""" % (userEmail, userEmail)
    # givenDate must be in format 2020-03-25
    print(sql)
    cursor.execute(sql)
    circleID = cursor.fetchall()
    print(circleID)
    conn.commit()
    conn.close()
    return circleID


if __name__ == "__main__":
    if len(sys.argv)-1 == 1:
        findCirclesForAUser(sys.argv[1])
    else:
        print("wrong number of arguments")
