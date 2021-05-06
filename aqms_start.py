from __future__ import print_function
import sys
import serial
import time
import subprocess
import db_connect

mydb = db_connect.connecting()
mycursor = mydb.cursor()

mycursor.execute("TRUNCATE sensor_values");
mycursor.execute("TRUNCATE measurement_logs");

mycursor.execute("SELECT id,driver FROM sensor_readers WHERE sensor_code <> ''")
sensor_readers = mycursor.fetchall()
for sensor_reader in sensor_readers:
    time.sleep(3)
    command = "python drivers/" + sensor_reader[1] + " " + str(sensor_reader[0])
    if sys.platform.startswith('win') == False:
        command = command.replace("python","python3")
    subprocess.Popen(command, shell=True)
    
time.sleep(2)

subprocess.Popen("php gui/spark serve", shell=True)

time.sleep(5)

subprocess.Popen("python3 gui_start.py", shell=True)

time.sleep(2)

counter_senddata = 0
#counter_senddata_klhk = 0
counter_averaging = 0
while True:
    counter_senddata = counter_senddata + 1
    #counter_senddata_klhk = counter_senddata_klhk + 1
    counter_averaging = counter_averaging + 1
    subprocess.Popen("php gui/spark command:formula_measurement_logs", shell=True)
    
    if(counter_senddata_klhk >= 60):
        print("Try Send Data to KLHK")
        subprocess.Popen("php gui/spark command:sentdata_klhk", shell=True)
        time.sleep(5)
        counter_senddata_klhk = 0
        
    if(counter_senddata >= 60):
        print("Try Send Data")
        subprocess.Popen("php gui/spark command:sentdata", shell=True)
        time.sleep(5)
        counter_senddata = 0
        
    if(counter_averaging >= 30):
        print("Try Averaging")
        subprocess.Popen("php gui/spark command:measurement_averaging", shell=True)
        time.sleep(30)
        counter_averaging = 0
        
    time.sleep(1)