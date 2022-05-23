from __future__ import print_function
import sys
import serial
import time
import db_connect

is_PSU_connect = False

try:
    mydb = db_connect.connecting()
    mycursor = mydb.cursor()
    
    mycursor.execute("SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
    sensor_reader = mycursor.fetchone()
except Exception as e: 
    print("[X]  PSU Module ID: " + str(sys.argv[1]) + " " + e)
    
def update_sensor_value(sensor_reader_id,value,pin = 0):
    try:
        try:
            mycursor.execute("SELECT id FROM sensor_values WHERE sensor_reader_id = '"+ sensor_reader_id +"' AND pin = '"+ str(pin) +"'")
            sensor_value_id = mycursor.fetchone()[0]
            mycursor.execute("UPDATE sensor_values SET value = '" + value + "' WHERE id = '" + str(sensor_value_id) + "'")
            mydb.commit()
        except Exception as e:
            mycursor.execute("INSERT INTO sensor_values (sensor_reader_id,pin,value) VALUES ('" + sensor_reader_id + "','"+ str(pin) +"','" + value + "')")
            mydb.commit()
    except Exception as e2:
        return None
        
def connect_psu():
    global is_PSU_connect
    try:
        mycursor.execute("SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
        sensor_reader = mycursor.fetchone()
        
        COM_PSU = serial.Serial(sensor_reader[0], sensor_reader[1],serial.EIGHTBITS,serial.PARITY_NONE,serial.STOPBITS_ONE,2)
        time.sleep(1)
        
        PSU = str(COM_PSU.read_until(str("#").encode()))
        PSU = PSU + str(COM_PSU.read_until(str("$MCU_PSU,READY#").encode()))
        if(PSU.count("$MCU_PSU") > 0):
            is_PSU_connect = True
            print("[V] PSU Module " + sensor_reader[0] + " CONNECTED")
            
            time.sleep(1)
            COM_PSU.write(str("$FAN,255#").encode())
            PSU = PSU + str(COM_PSU.read_until(str("$MCU_PSU,FAN").encode()))

            time.sleep(1)
            COM_PSU.write(str("$BMP280,BEGIN#").encode())
            PSU = PSU + str(COM_PSU.read_until(str("$MCU_PSU,$BMP280").encode()))
            time.sleep(1)
            COM_PSU.write(str("$BMP280,SET,AUTO#").encode())
            PSU = PSU + str(COM_PSU.read_until(str("$MCU_PSU,$BMP280").encode()))

            time.sleep(1)
            COM_PSU.write(str("$PRESSURE,SET,AUTO#").encode())
            PSU = PSU + str(COM_PSU.read_until(str("$MCU_PSU,PRESSURE").encode()))
            
            returnval = COM_PSU
        else:
            is_PSU_connect = False
            returnval = None
        
        mycursor.execute("SELECT content FROM configurations WHERE name = 'is_psu_restarting'")
        rec = mycursor.fetchone()
        is_psu_restarting = int(rec[0])
        
        time.sleep(2)
        if(is_psu_restarting == 1):
            mycursor.execute("UPDATE configurations SET value = '0' WHERE name = 'is_psu_restarting'")
            mydb.commit()
            COM_PSU.write(str("$RESTART,3000#").encode());
            time.sleep(2)
        return returnval
            
    except Exception as e: 
        return None

update_sensor_value(str(sys.argv[1]),"",0)
update_sensor_value(str(sys.argv[1]),"",1)    
COM_PUMP = connect_pump()

try:
    while True :
        try:
            if(is_PUMP_connect == False):
                COM_PUMP = connect_pump()
                        
            PUMP = str(COM_PUMP.read_until(str("#").encode()))
            if(PUMP.count("$MCU_PUMP") <= 0):
                PUMP = ""
            
            if(PUMP.count("$MCU_PUMP,BMP280,VAL") > 0):
                update_sensor_value(str(sys.argv[1]),PUMP.replace("b'","").replace("'","''"),0)
                # print(PUMP.replace("b'","").replace("'","''"))
                
            if(PUMP.count("$MCU_PUMP,PRESSURE,RAW") > 0):
                update_sensor_value(str(sys.argv[1]),PUMP.replace("b'","").replace("'","''"),1)
                # print(PUMP.replace("b'","").replace("'","''"))
            
            mydb.commit()
            mycursor.execute("SELECT content FROM configurations WHERE name = 'pump_state'")
            rec = mycursor.fetchone()
            pump_state = int(rec[0])
            time.sleep(2)
            
            if pump_state != cur_pump_state and is_PUMP_connect:
                mycursor.execute("SELECT content FROM configurations WHERE name = 'pump_speed'")
                rec = mycursor.fetchone()
                pump_speed = int(rec[0])
                speed = (pump_state * 100) + pump_speed;
                cur_pump_state = pump_state
                COM_PUMP.write(str("$PUMP," + str(pump_state+1) + ",SET," + str(pump_speed) + "#").encode());
                time.sleep(2)
                
        except Exception as e2:
            print(e2.args)
            is_PUMP_connect = False
            print("Reconnect PUMP Module ID: " + str(sys.argv[1]));
            update_sensor_value(str(sys.argv[1]),0)
                
except Exception as e: 
    print(e)
