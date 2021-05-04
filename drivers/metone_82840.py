from __future__ import print_function
import sys
import serial
import time
import sqlite3
conn = sqlite3.connect('../gui/app/Database/database.s3db')

is_PM_connect = False
sensor_reader = ["","",""]

try:
    cursor = conn.execute("SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
    for row in cursor:
        sensor_reader[0] = row[0]
        sensor_reader[1] = row[1]
except Exception as e: 
    print("[X]  [V] PM  Sensor ID: " + str(sys.argv[1]) + " " + e)
    
def update_sensor_value(sensor_reader_id,value):
    try:
        try:
            cursor = conn.execute("SELECT id FROM sensor_values WHERE sensor_reader_id = '"+ sensor_reader_id +"' AND pin = '0'")        
            for row in cursor:
                sensor_value_id = row[0]
                
            conn.execute("UPDATE sensor_values SET value = '" + value + "', xtimestamp = datetime('now') WHERE id = '" + str(sensor_value_id) + "'")
            conn.commit()
        except Exception as e:
            conn.execute("INSERT INTO sensor_values (sensor_reader_id,pin,value) VALUES ('" + sensor_reader_id + "','0','" + value + "')")
            conn.commit()
    except Exception as e2:
        return None
    
def connect_pm():
    global is_PM_connect
    try:
        cursor = conn.execute("SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
        for row in cursor:
            sensor_reader[0] = row[0]
            sensor_reader[1] = row[1]
        
        COM_PM = serial.Serial(sensor_reader[0], sensor_reader[1])
        PM = str(COM_PM.readline())
        if(PM.count(",") == 6):
            is_PM_connect = True
            print("[V] PM " + sensor_reader[0] + " CONNECTED")
            return COM_PM 
        else:
            is_PM_connect = False
            return None
            
    except Exception as e: 
        return None
    
try:
    while True :
        try:
            if(not is_PM_connect):
                COM_PM = connect_pm()
        
            PM = str(COM_PM.readline())
            if(PM.count(",") != 6):
                PM = "b'000.000,0.0,+0.0,0,0,00,*0\\r\\n'"
                
            if((float(PM[2:9]) * 1000) > 700):
                PM = "b'000.700," + PM[10:len(PM)]
                
            update_sensor_value(str(sys.argv[1]),PM.replace("'","''"))
            
            #print(PM)
        except Exception as e2:
            print(e2)
            is_PM_connect = False
            print("Reconnect PM Sensor ID: " + str(sys.argv[1]));
            update_sensor_value(str(sys.argv[1]),0)
        
        time.sleep(1)
        
except Exception as e: 
    print(e)