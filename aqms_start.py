from __future__ import print_function
import sys
import serial
import time
import subprocess
import db_connect

mydb = db_connect.connecting()
mycursor = mydb.cursor()

mycursor.execute("SELECT id,driver FROM sensor_readers WHERE sensor_code <> ''")
sensor_readers = mycursor.fetchall()
for sensor_reader in sensor_readers:
    time.sleep(1)
    command = "cd drivers && python " + sensor_reader[1] + " " + str(sensor_reader[0])
    if sys.platform.startswith('win') == False:
        command = "echo admin | sudo -S " + command.replace("python","python3")
    subprocess.Popen(command, shell=True)
    print(command)