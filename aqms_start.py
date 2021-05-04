from __future__ import print_function
import sys
import serial
import time
import subprocess
import db_connect

mydb = db_connect.connecting()
mycursor = mydb.cursor()

mycursor.execute("TRUNCATE sensor_values");

mycursor.execute("SELECT id,driver FROM sensor_readers WHERE sensor_code <> ''")
sensor_readers = mycursor.fetchall()
for sensor_reader in sensor_readers:
    time.sleep(1)
    command = "python drivers/" + sensor_reader[1] + " " + str(sensor_reader[0])
    if sys.platform.startswith('win') == False:
        command = command.replace("python","python3")
    subprocess.Popen(command, shell=True)
    
time.sleep(2)

subprocess.Popen("php gui/spark serve", shell=True)

time.sleep(5)

subprocess.Popen("python3 gui_start.py", shell=True)

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