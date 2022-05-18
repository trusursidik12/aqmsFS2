from __future__ import print_function
import sys
import serial
import subprocess
import time
import db_connect

is_SENSOR_connect = False
WS = ";0;0;0;0;0;0;0;0;0;0;0;0;0.0;0;0;0;0"

try:
    mydb = db_connect.connecting()
    mycursor = mydb.cursor()
    
    mycursor.execute("SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
    sensor_reader = mycursor.fetchone()
except Exception as e: 
    print("[X]  SENSOR Module ID: " + str(sys.argv[1]) + " " + e)
    
def read_ws():
    global is_SENSOR_connect
    is_SENSOR_connect = True
    try:
        f = open("~/rtl_433_output.txt", "r")
        content = str(f.read()).split("Fineoffset-WHx080")
        content = content[len(content)-1]
        return content
    except Exception as e:
        is_SENSOR_connect = False
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
    global is_SENSOR_connect
    try:
        mycursor.execute("SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
        sensor_reader = mycursor.fetchone()
        
        if(sensor_reader[0] != ""):
            subprocess.Popen("rtl_433 > ~/rtl_433_output.txt &", shell=False)
            is_SENSOR_connect = True
            
    except Exception as e: 
        return None
    
connect_sensor()

try:
    while True :
        try:
            if(not is_SENSOR_connect):
                connect_sensor()
                
            ws_content = read_ws()    
            if(ws_content != ""):
                outdoor_temperature = float(ws_content.split("Temperature: ")[1].split(" C")[0])
                wind_speed = float(ws_content.split("Wind avg speed: ")[1].split(" ")[0])
                wind_dirs = ws_content.split("Wind Direction: ")[1].split(" ")[0]
                outdoor_humidity = ws_content.split("Humidity  : ")[1].split(" %")[0]
                rain = float(ws_content.split("Total rainfall: ")[1].split(" ")[0])
                
                WS = str(datetime.datetime.now()) + ";0;0;0;0;" + str((outdoor_temperature*9/5)+32) + ";" + str(round(wind_speed,2)) + ";" + str(round(wind_speed,2)) + ";" + wind_dirs + ";" + outdoor_humidity + ";" + str(round(rain,2)) + ";0;0;0.0;0;" + str(round(rain,2)) + ";0;0"
                
                update_sensor_value(str(sys.argv[1]),SENSOR.replace("'","''"))
                
                f = open("~/rtl_433_output.txt", "w")
                f.write("")
                f.close()
                
            print(WS)
            
        except Exception as e2:
            print(e2)
            is_SENSOR_connect = False
            print("Reconnect SENSOR Module ID: " + str(sys.argv[1]));
            update_sensor_value(str(sys.argv[1]),";0;0;0;0;0;0;0;0;0;0;0;0;0.0;0;0;0;0")
        
        time.sleep(10)
        
except Exception as e: 
    print(e)









        
def read_ws():
    global is_WS_connect
    is_WS_connect = True
    try:
        f = open("/home/admin/misol_sdr.txt", "r")
        content = str(f.read()).split("Fineoffset-WHx080")
        content = content[len(content)-1]
        return content
    except Exception as e:
        is_WS_connect = False
        return ""
        
try:
    while True:
        try:
            ws_content = read_ws()
            if(ws_content != ""):
                outdoor_temperature = float(ws_content.split("Temperature: ")[1].split(" C")[0])
                wind_speed = float(ws_content.split("Wind avg speed: ")[1].split(" ")[0])
                wind_dirs = ws_content.split("Wind Direction: ")[1].split(" ")[0]
                outdoor_humidity = ws_content.split("Humidity  : ")[1].split(" %")[0]
                rain = float(ws_content.split("Total rainfall: ")[1].split(" ")[0])
                
                WS = str(datetime.datetime.now()) + ";0;0;0;0;" + str((outdoor_temperature*9/5)+32) + ";" + str(round(wind_speed,2)) + ";" + str(round(wind_speed,2)) + ";" + wind_dirs + ";" + outdoor_humidity + ";" + str(round(rain,2)) + ";0;0;0.0;0;" + str(round(rain,2)) + ";0;0"
                sql = "UPDATE aqm_sensor_values SET WS = '" + WS + "' WHERE id = 1"
                mycursor.execute(sql)
                mydb.commit()
                f = open("/home/admin/misol_sdr.txt", "w")
                f.write("")
                f.close()
                
            # print(WS)
                
        except Exception as e2:
            is_WS_connect = False
            print("Reconnect WS MISOL SDR : " + str(e2));
            sql = "UPDATE aqm_sensor_values SET WS = ';0;0;0;0;0;0;0;0;0;0;0;0;0.0;0;0;0;0' WHERE id = 1"
            mycursor.execute(sql)
            mydb.commit()

        time.sleep(10)
	

except Exception as e:
    print(e)