from __future__ import print_function
import sys
from labjack import ljm
import time
import sqlite3
conn = sqlite3.connect('../gui/app/Database/database.s3db')

AIN = [0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0]
sensor_reader = ["","",""]

try:
    cursor = conn.execute("SELECT sensor_code,pins FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
    for row in cursor:
        sensor_reader[0] = row[0]
        sensor_reader[1] = row[1]
        
    labjack = ljm.openS("ANY", "ANY", sensor_reader[0])
    print("[V] Labjack " + sensor_reader[0] + " CONNECTED")
except Exception as e:
    print("[X]  Labjack " + e)
    
def update_sensor_value(sensor_reader_id,value,pin):
    try:
        cursor = conn.execute("SELECT id FROM sensor_values WHERE sensor_reader_id = '"+ sensor_reader_id +"' AND pin = '" + pin + "'")        
        for row in cursor:
            sensor_value_id = row[0]
            
        conn.execute("UPDATE sensor_values SET value = '" + value + "', xtimestamp = datetime('now') WHERE id = '" + str(sensor_value_id) + "'")
        conn.commit()
    except Exception as e:
        conn.execute("INSERT INTO sensor_values (sensor_reader_id,pin,value) VALUES ('" + sensor_reader_id + "','" + pin + "','0')")
        conn.commit()

while True:
    try:
        labjack = ljm.openS("ANY", "ANY", sensor_reader[0])
        for x in sensor_reader[1].split(','):
            AIN[int(x)] = ljm.eReadName(labjack, "AIN" + x)
        
    except Exception as e: 
        for x in sensor_reader[1].split(','):
            AIN[int(x)] = 0
    
    for x in sensor_reader[1].split(','):
        update_sensor_value(str(sys.argv[1]),str(AIN[int(x)]),x)
            
    time.sleep(1) 