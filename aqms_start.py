from __future__ import print_function
import sys
import serial
import time
import subprocess
import sqlite3
conn = sqlite3.connect('gui/app/Database/database.s3db')

sensor_reader = ["","",""]

conn.execute("DELETE FROM sensor_values");
conn.commit()
conn.execute("UPDATE SQLITE_SEQUENCE SET seq = 0 WHERE name = 'sensor_values'");
conn.commit()

cursor = conn.execute("SELECT id,driver FROM sensor_readers WHERE sensor_code <> ''")
for row in cursor:
    sensor_reader[0] = row[0]
    sensor_reader[1] = row[1]
    time.sleep(1)
    command = "cd drivers && python " + sensor_reader[1] + " " + str(sensor_reader[0])
    if sys.platform.startswith('win') == False:
        command = command.replace("python","python3")
    subprocess.Popen(command, shell=True)
    
time.sleep(2)
subprocess.Popen("cd gui && php spark serve", shell=True)

time.sleep(5)

command = "python background_process.py"
if sys.platform.startswith('win') == False:
    command = command.replace("python","python3")
subprocess.Popen(command, shell=True)

time.sleep(2)

command = "python gui_start.py"
if sys.platform.startswith('win') == False:
    command = command.replace("python","python3")
subprocess.Popen(command, shell=True)