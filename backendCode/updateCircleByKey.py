#!/usr/bin/python3
#
# Corona Circles, codevscovid19 hackathon Zurich
# by Christopher Rehm 29-30 mar 2020, christopherrehm@web.de

import sys
import MySQLdb


def updateCircleByKey(url, idNumber):
    conn = MySQLdb.connect(host="rdbms.strato.de",
                           user="U4098787",
                           passwd="1light1light!!", db="DB4098787")
    cursor = conn.cursor()
    sql = """UPDATE `CIRCLE` SET `URL` = '%s'
    WHERE `ID` = %s""" % (url, idNumber)
    print(sql)
    cursor.execute(sql)
    conn.commit()
    conn.close()


if __name__ == "__main__":
    if len(sys.argv)-1 == 2:
        updateCircleByKey(sys.argv[1], sys.argv[2])
    else:
        print("wrong number of arguments")
