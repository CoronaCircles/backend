#!/usr/bin/python3
# insert new usercircle into db
# Corona Circles, codevscovid19 hackathon Zurich
# by Christopher Rehm 29-30 mar 2020, christopherrehm@web.de

import sys
import MySQLdb


def insertCircle(circleName, description, frequency, url):
    if len(sys.argv)-1 == 4:
        conn = MySQLdb.connect(host="rdbms.strato.de",
                               user="U4098787",
                               passwd="1light1light!!", db="DB4098787")
        cursor = conn.cursor()
        SQL = """INSERT INTO `CIRCLE` (`NAME`, `DESCRIPTION`, `FREQUENCY`, `URL`)
        VALUES (%s, %s, %s, %s)"""
        cursor.execute(SQL, (circleName, description, frequency, url))
        conn.commit()
        conn.close()
    else:
        print("wrong number of arguments")


if __name__ == "__main__":
    insertCircle(sys.argv[1], sys.argv[2], sys.argv[3], sys.argv[4])
