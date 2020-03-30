#!/usr/bin/python3
#
# Corona Circles, codevscovid19 hackathon Zurich
# by Christopher Rehm 29-30 mar 2020, christopherrehm@web.de

import sys
import MySQLdb


def findCircleIDbyName(circleName):
    conn = MySQLdb.connect(host="rdbms.strato.de",
                           user="U4098787",
                           passwd="1light1light!!", db="DB4098787")
    cursor = conn.cursor()
    sql = """SELECT c.ID FROM CIRCLE c,
    (SELECT ID FROM CIRCLE WHERE NAME = '%s') curr
    WHERE c.ID = curr.ID""" % (circleName)
    print(sql)
    cursor.execute(sql)
    circleID = cursor.fetchone()
    print(circleID[0])
    conn.commit()
    conn.close()
    return circleID


if __name__ == "__main__":
    if len(sys.argv)-1 == 1:
        findCircleIDbyName(sys.argv[1])
    else:
        print("wrong number of arguments")
