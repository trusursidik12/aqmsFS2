from __future__ import print_function
from pymodbus.client.sync import ModbusSerialClient
import sys
import minimalmodbus
import serial
import time
import datetime
import struct
import db_connect

is_MEMBRAPOR_connect = False
is_zero_calibrating = False
zerocal_finished_at = ""

try:
    mydb = db_connect.connecting()
    mycursor = mydb.cursor()
    
    mycursor.execute("SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
    sensor_reader = mycursor.fetchone()
        
except Exception as e: 
    print("[X]  MEMBRAPOR ID: " + str(sys.argv[1]) + " " + e)
    
def dectofloat(dec0,dec1):
    try:
        hexvalue = str(hex(int(dec0))).replace("0x","") + str(hex(int(dec1))).replace("0x","")
        return str(struct.unpack('!f', bytes.fromhex(hexvalue))[0])
    except Exception as e: 
        return "0"

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

def connect_membrapor(membrapormode):
    global is_MEMBRAPOR_connect
    try:
        mycursor.execute("SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
        sensor_reader = mycursor.fetchone()
    
        rs485=minimalmodbus.Instrument(sensor_reader[0],1)
        rs485.serial.baudrate=sensor_reader[1]
        rs485.serial.parity=serial.PARITY_EVEN
        rs485.serial.bytesize=8
        rs485.serial.stopbits=1
        rs485.mode=minimalmodbus.MODE_RTU
        rs485.serial.timeout=0.2
        
        regConcentration = rs485.read_registers(1000,8,3)
        regVoltage = rs485.read_registers(1010,8,3)
        regTemp = rs485.read_registers(1070,8,3)
        
        if(is_MEMBRAPOR_connect == False):
            is_MEMBRAPOR_connect = True
            print("[V] MEMBRAPOR " + sensor_reader[0] + " CONNECTED")
        
        return regConcentration + regVoltage + regTemp
        
    except Exception as e:
        print("[X]  MEMBRAPOR ID: " + str(sys.argv[1]) + " " + e)
        return None

def zeroing():
    global is_zero_calibrating
    try:
        mycursor.execute("SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
        sensor_reader = mycursor.fetchone()
    
        rs485=minimalmodbus.Instrument(sensor_reader[0],1)
        rs485.serial.baudrate=sensor_reader[1]
        rs485.serial.parity=serial.PARITY_EVEN
        rs485.serial.bytesize=8
        rs485.serial.stopbits=1
        rs485.mode=minimalmodbus.MODE_RTU
        rs485.serial.timeout=0.2
        
        print("Zeroing...")
        is_zero_calibrating = False
        rs485.write_registers(1200,[0,0,0,0])
        time.sleep(1)
        rs485.write_registers(1220,[0,0,0,0])
        time.sleep(3)
        rs485.write_registers(1210,[0,0,0,0])
        time.sleep(3)
        
        
        mycursor.execute("SELECT content FROM configurations WHERE name LIKE 'calibrator_name'")
        calibrator_name = mycursor.fetchone()[0]
        mycursor.execute("SELECT content FROM configurations WHERE name LIKE 'zerocal_started_at'")
        zerocal_started_at = mycursor.fetchone()[0]
        mycursor.execute("SELECT content FROM configurations WHERE name LIKE 'zerocal_finished_at'")
        zerocal_finished_at = mycursor.fetchone()[0]
        mycursor.execute("SELECT value FROM sensor_values WHERE sensor_reader_id = '" + sys.argv[1] + "' AND pin=0")
        value = mycursor.fetchone()[0]
        
        mycursor.execute("INSERT INTO calibrations (calibrator_name,started_at,finished_at,sensor_reader_id,value) VALUES ('" + calibrator_name + "','" + zerocal_started_at + "','" + zerocal_finished_at + "','" + sys.argv[1] + "','" + value + "')")
        mydb.commit()
        
        
        mycursor.execute("UPDATE configurations SET content = '0' WHERE name LIKE 'is_zerocal'")
        mydb.commit()
        mycursor.execute("UPDATE configurations SET content = '' WHERE name LIKE 'zerocal_started_at'")
        mydb.commit()
        mycursor.execute("UPDATE configurations SET content = '' WHERE name LIKE 'zerocal_finished_at'")
        mydb.commit()
        
        return True
        
    except Exception as e:
        print(e)
        return None


try:
    while True:
        try:
            mycursor.execute("SELECT content FROM configurations WHERE name LIKE 'is_zerocal'")
            is_zerocal = mycursor.fetchone()[0]
            mycursor.execute("SELECT content FROM configurations WHERE name LIKE 'zerocal_finished_at'")
            zerocal_finished_at = mycursor.fetchone()[0]
            # print(is_zerocal + " : " + zerocal_finished_at)
            
            if(int(is_zerocal) == 1 and zerocal_finished_at != ""):
                is_zero_calibrating = True
                
            if(is_zero_calibrating):
                try:
                    currenttime = datetime.datetime.now()
                    # print(zerocal_finished_at + " ||| " + str(currenttime)[0:19])
                    if(zerocal_finished_at <= str(currenttime)[0:19] or zerocal_finished_at == ""):
                        zeroing()
                        time.sleep(1)
                        
                except Exception as e3:
                    print(e3)
        
            val = connect_membrapor(int(sys.argv[1]))
            # print(val)
            MEMBRAPOR = "FS2_MEMBRASENS;" + dectofloat(val[1],val[0]) + ";" + dectofloat(val[3],val[2]) + ";" + dectofloat(val[5],val[4]) + ";" + dectofloat(val[7],val[6]) + ";" + dectofloat(val[9],val[8]) + ";" + dectofloat(val[11],val[10]) + ";" + dectofloat(val[13],val[12]) + ";" + dectofloat(val[15],val[14]) + ";" + dectofloat(val[17],val[16]) + ";" + dectofloat(val[19],val[18]) + ";" + dectofloat(val[21],val[20]) + ";" + dectofloat(val[23],val[22]) + ";END;"            
            update_sensor_value(str(sys.argv[1]),str(MEMBRAPOR))
            # print(MEMBRAPOR)
        except Exception as e2:
            print(e2)
            is_MEMBRAPOR_connect = False
            print("Reconnect MEMBRAPOR");
            update_sensor_value(str(sys.argv[1]),0)
            
        time.sleep(2)

except Exception as e:
    print(e)