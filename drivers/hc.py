from __future__ import print_function
import sys
import serial
import time
import sqlite3
conn = sqlite3.connect('../gui/app/Database/database.s3db')

is_HC_connect = False
sensor_reader = ["","",""]

try:
    cursor = conn.execute("SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
    for row in cursor:
        sensor_reader[0] = row[0]
        sensor_reader[1] = row[1]
except Exception as e: 
    print("[X]  [V] HC  Sensor ID: " + str(sys.argv[1]) + " " + e)
    
def update_sensor_value(sensor_reader_id,value):
    try:
        try:
            cursor = conn.execute("SELECT id FROM sensor_values WHERE sensor_reader_id = '"+ sensor_reader_id +"' AND pin = '0'")        
            for row in cursor:
                sensor_value_id = row[0]
                
            conn.execute("UPDATE sensor_values SET value = '" + value + "', xtimestamp = datetime('now', 'localtime') WHERE id = '" + str(sensor_value_id) + "'")
            conn.commit()
        except Exception as e:
            conn.execute("INSERT INTO sensor_values (sensor_reader_id,pin,value) VALUES ('" + sensor_reader_id + "','0','" + value + "')")
            conn.commit()
    except Exception as e2:
        return None
    
def connect_hc():
    global is_HC_connect
    try:
        cursor = conn.execute("SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
        for row in cursor:
            sensor_reader[0] = row[0]
            sensor_reader[1] = row[1]
        
        COM_HC = serial.Serial(sensor_reader[0], sensor_reader[1])
        HC = str(COM_HC.readline())
        if(HC.count(",") == 0 and HC.count("\\r\\n") == 1 and HC.count("b'") == 1):
            is_HC_connect = True
            print("[V] HC " + sensor_reader[0] + " CONNECTED")
            return COM_HC 
        else:
            is_HC_connect = False
            return None
    except Exception as e: 
        return None
    
try:
    while True :
        try:
            if(not is_HC_connect):
                COM_HC = connect_hc()
        
            HC = str(COM_HC.readline())
            if(HC.count(",") == 0 and HC.count("\\r\\n") == 1 and HC.count("b'") == 1):
                HC = HC.split("\\r\\n")[0];
                HC = HC.split("b'")[1];
            else:
                HC = "0"
            
            update_sensor_value(str(sys.argv[1]),HC)
            
            #print(HC)
        except Exception as e2:
            print(e2)
            is_HC_connect = False
            print("Reconnect HC Sensor ID: " + str(sys.argv[1]));
            update_sensor_value(str(sys.argv[1]),-1)
        
        time.sleep(1)
        
except Exception as e: 
    print(e)