#!/usr/bin/python3
# insert new user into db
# Corona Circles, codevscovid19 hackathon Zurich
# by Christopher Rehm 29-30 mar 2020, christopherrehm@web.de

import sys
import MySQLdb


def insertNewUser(firstName, lastName, displayName, emailAdr):
    if len(sys.argv)-1 == 4:
        SQL = """INSERT INTO `USER` (`FIRSTNAME`, `LASTNAME`, `DISPLAYNAME`,
        `EMAILADDRESS`) VALUES (%s, %s, %s, %s)"""
        # print(SQL)
        conn = MySQLdb.connect(host="rdbms.strato.de",
                               user="U4098787",
                               passwd="1light1light!!", db="DB4098787")
        cursor = conn.cursor()
        cursor.execute(SQL, (firstName, lastName,
                             displayName, emailAdr))
        conn.commit()
        conn.close()
    else:
        print("wrong number of arguments")


if __name__ == "__main__":
    insertNewUser(sys.argv[1], sys.argv[2], sys.argv[3], sys.argv[4])
