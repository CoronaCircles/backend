#!/usr/bin/python3
# insert new user into db
# Corona Circles, codevscovid19 hackathon Zurich
# by Christopher Rehm 29-30 mar 2020, christopherrehm@web.de

import sys
import MySQLdb


def functionhere():
    conn = MySQLdb.connect(host="rdbms.strato.de",
                           user="U4098787",
                           passwd="1light1light!!", db="DB4098787")
    cursor = conn.cursor()
    cursor.execute('INSERT INTO `USER` (`FIRSTNAME`, `LASTNAME`,`DISPLAYNAME`, `EMAILADDRESS`) VALUES
    (sys.argv[1], sys.argv[2], sys.argv[3], sys.argv[4])')
    conn.commit()
    conn.close()
    # row = cursor.fetchone()
    # rows = cursor.fetchall()
    # do something with the data in row or rows


if len(sys.argv)-1 == 4:
    functionhere()
else:
    print("wrong number of arguments")
