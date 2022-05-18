from __future__ import print_function
import sys
import serial
import subprocess
import time
import datetime
import db_connect

is_SENSOR_connect = False
WS = ";0;0;0;0;0;0;0;0;0;0;0;0;0.0;0;0;0;0"
filepath = "/home/admin"

try:
    mydb = db_connect.connecting()
    mycursor = mydb.cursor()
    
    mycursor.execute("SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
    sensor_reader = mycursor.fetchone()
except Exception as e: 
    print("[X]  SENSOR Module ID: " + str(sys.argv[1]) + " " + e)
    
def read_ws(path):
    global is_SENSOR_connect
    # is_SENSOR_connect = True
    try:
        f = open(path + "/rtl_433_output.txt", "r")
        contents = str(f.read()).split("Fineoffset-WHx080")
        print(contents)
        content = contents[len(contents)-1]
        return content
    except Exception as e:
        print(e)
        # is_SENSOR_connect = False
        return ""
    
def update_sensor_value(sensor_reader_id,value):
    try:
        try:
            mycursor.execute("SELECT id FROM sensor_values WHERE sensor_reader_id = '"+ sensor_reader_id +"' AND pin = '0'")
            sensor_value_id = mycursor.fetchone()[0]
            mycursor.execute("UPDATE sensor_values SET value = '" + value + "' WHERE id = '" + str(sensor_value_id) + "'")
            mydb.commit()
        except Exception as e:
            mycursor.execute("INSERT INTO sensor_values (sensor_reader_id,pin,value) VALUES ('" + sensor_reader_id + "','0','" + value + "')")
            mydb.commit()
    except Exception as e2:
        return None
        
def connect_sensor():
    global is_SENSOR_connect,filepath
    try:
        mycursor.execute("SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
        sensor_reader = mycursor.fetchone()
        
        filepath = sensor_reader[0]
        
        if(sensor_reader[0] != ""):
            subprocess.Popen("rtl_433 > ~/rtl_433_output.txt &", shell=True)
            is_SENSOR_connect = True
            
    except Exception as e: 
        return None
    
connect_sensor()

try:
    while True :
        try:
            if(not is_SENSOR_connect):
                connect_sensor()
                
            ws_content = read_ws(filepath)    
            # print(ws_content)
            if(ws_content != ""):
                outdoor_temperature = float(ws_content.split("Temperature: ")[1].split(" C")[0])
                print("outdoor_temperature" + str(outdoor_temperature))
                wind_speed = float(ws_content.split("Wind avg speed: ")[1].split("\n")[0])
                print("wind_speed" + wind_speed)
                wind_dirs = ws_content.split("Wind Direction: ")[1].split("\n")[0]
                print(wind_dirs)
                outdoor_humidity = ws_content.split("Humidity  : ")[1].split(" %")[0]
                print(outdoor_humidity)
                rain = float(ws_content.split("Total rainfall: ")[1].split("\n")[0])
                print(rain)
                
                WS = str(datetime.datetime.now()) + ";0;0;0;0;" + str((outdoor_temperature*9/5)+32) + ";" + str(round(wind_speed,2)) + ";" + str(round(wind_speed,2)) + ";" + wind_dirs + ";" + outdoor_humidity + ";" + str(round(rain,2)) + ";0;0;0.0;0;" + str(round(rain,2)) + ";0;0"
                print(WS)
                update_sensor_value(str(sys.argv[1]),WS.replace("'","''"))
                
                f = open(filepath + "/rtl_433_output.txt", "w")
                f.write("")
                f.close()
                
            # print(WS)
            
        except Exception as e2:
            print(e2)
            is_SENSOR_connect = False
            print("Reconnect SENSOR Module ID: " + str(sys.argv[1]));
            # update_sensor_value(str(sys.argv[1]),";0;0;0;0;0;0;0;0;0;0;0;0;0.0;0;0;0;0")
        
        time.sleep(10)
        
except Exception as e: 
    print(e)