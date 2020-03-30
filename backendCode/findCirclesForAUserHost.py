#!/usr/bin/python3
#
# Corona Circles, codevscovid19 hackathon Zurich
# by Christopher Rehm 29-30 mar 2020, christopherrehm@web.de

import sys
import MySQLdb


def findCirclesForAUserHost(userEmail):
    conn = MySQLdb.connect(host="rdbms.strato.de",
                           user="U4098787",
                           passwd="1light1light!!", db="DB4098787")
    cursor = conn.cursor()
    sql = """SELECT c.ID, c.NAME, c.DESCRIPTION, c.URL, 'Host' ISHOST
    FROM USER u, (SELECT ID FROM USER WHERE EMAILADDRESS='%s')
    curr, CIRCLEUSER cu, CIRCLE c
    WHERE u.ID = curr.ID
    AND cu.CU2USER = u.ID
    AND cu.CU2CIRCLE = c.ID
    AND cu.ISHOST = 1""" % (userEmail)
    print(sql)
    cursor.execute(sql)
    circleID = cursor.fetchall()
    print(circleID)
    conn.commit()
    conn.close()
    return circleID


if __name__ == "__main__":
    if len(sys.argv)-1 == 1:
        findCirclesForAUserHost(sys.argv[1])
    else:
        print("wrong number of arguments")
