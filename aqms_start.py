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
    command = "python drivers/" + sensor_reader[1] + " " + str(sensor_reader[0])
    if sys.platform.startswith('win') == False:
        command = command.replace("python","python3")
    subprocess.Popen(command, shell=True)
    
time.sleep(2)
subprocess.Popen("php gui/spark serve", shell=True)

time.sleep(5)

#command = "python background_process.py"
#if sys.platform.startswith('win') == False:
#    command = command.replace("python","python3")
#subprocess.Popen(command, shell=True)
#
#time.sleep(2)

subprocess.Popen("chromium-browser --start-fullscreen --start-maximized --kiosk http://localhost:8080", shell=True)

time.sleep(2)

counter = 0
while True:
    counter = counter + 1
    subprocess.Popen("php gui/spark command:formula_measurement_logs", shell=True)
    if(counter >= 60):
        #subprocess.Popen("php gui/spark command:sentdata", shell=True)
        subprocess.Popen("php gui/spark command:measurement_averaging", shell=True)
        counter = 0
    time.sleep(1)
