#!/usr/bin/python3
# insert new user into db
# Corona Circles, codevscovid19 hackathon Zurich
# by Christopher Rehm 29-30 mar 2020, christopherrehm@web.de

import sys
import MySQLdb


def findCirclesOnADATE(givenDate):
    conn = MySQLdb.connect(host="rdbms.strato.de",
                           user="U4098787",
                           passwd="1light1light!!", db="DB4098787")
    cursor = conn.cursor()
    sql = """SELECT c.NAME AS CircleName, c.DESCRIPTION AS CircleDescription,
    u.DISPLAYNAME AS Host,
    CONCAT(e.DATE,' ',e.time,e.TIMEZONE) AS Schedule
    FROM USER u, CIRCLEUSER cu, CIRCLE c, EVENT e
    WHERE cu.CU2USER = u.ID
    AND cu.CU2CIRCLE = c.ID
    AND cu.ISHOST = 1
    AND e.EVENT2CIRCLE = c.ID
    AND e.DATE = '%s'
    ORDER BY 4 ASC""" % (givenDate)
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
        findCirclesOnADATE(sys.argv[1])
    else:
        print("wrong number of arguments")
