#!/usr/bin/python3
# insert new user into db
# Corona Circles, codevscovid19 hackathon Zurich
# by Christopher Rehm 29-30 mar 2020, christopherrehm@web.de

import sys
import MySQLdb


def findUserIDbyEmail(emailAdr):
    conn = MySQLdb.connect(host="rdbms.strato.de",
                           user="U4098787",
                           passwd="1light1light!!", db="DB4098787")
    cursor = conn.cursor()
    sql = """SELECT u.ID FROM USER u,
            (SELECT ID FROM USER WHERE EMAILADDRESS='%s') curr
            WHERE u.ID = curr.ID""" % (emailAdr)
    print(sql)
    cursor.execute(sql)
    userID = cursor.fetchone()
    print(userID[0])
    conn.commit()
    conn.close()
    return userID


if __name__ == "__main__":
    if len(sys.argv)-1 == 1:
        findUserIDbyEmail(sys.argv[1])
    else:
        print("wrong number of arguments")
