#!/usr/bin/python3
#
# Corona Circles, codevscovid19 hackathon Zurich
# by Christopher Rehm 29-30 mar 2020, christopherrehm@web.de

import sys
import MySQLdb


def updateCircleByName(circleName, url):
    conn = MySQLdb.connect(host="rdbms.strato.de",
                           user="U4098787",
                           passwd="1light1light!!", db="DB4098787")
    cursor = conn.cursor()
    sql = """UPDATE `CIRCLE` c, (SELECT `ID` FROM `CIRCLE` WHERE `NAME` = '%s') curr
            SET `URL` = '%s'
            WHERE c.`ID` = curr.`ID`""" % (circleName, url)
    print(sql)
    cursor.execute(sql)
    conn.commit()
    conn.close()


if __name__ == "__main__":
    if len(sys.argv)-1 == 2:
        updateCircleByName(sys.argv[1], sys.argv[2])
    else:
        print("wrong number of arguments")
