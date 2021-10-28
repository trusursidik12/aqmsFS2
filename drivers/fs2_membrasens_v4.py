from __future__ import print_function
from pymodbus.client.sync import ModbusSerialClient
import sys
import minimalmodbus
import serial
import time
import struct
import db_connect

is_MEMBRAPOR_connect = False

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
        
        #concentration
        ##add0=rs485.read_register(1000,0,3,False)
        ##add1=rs485.read_register(1001,0,3,False)
        ##add2=rs485.read_register(1002,0,3,False)
        ##add3=rs485.read_register(1003,0,3,False)
        ##add4=rs485.read_register(1004,0,3,False)
        ##add5=rs485.read_register(1005,0,3,False)
        ##add6=rs485.read_register(1006,0,3,False)
        ##add7=rs485.read_register(1007,0,3,False)
        
        #voltage
        ##add00=rs485.read_register(1010,0,3,False)
        ##add01=rs485.read_register(1011,0,3,False)
        ##add02=rs485.read_register(1012,0,3,False)
        ##add03=rs485.read_register(1013,0,3,False)
        ##add04=rs485.read_register(1014,0,3,False)
        ##add05=rs485.read_register(1015,0,3,False)
        ##add06=rs485.read_register(1016,0,3,False)
        ##add07=rs485.read_register(1017,0,3,False)
        
        #temp
        ##add000=rs485.read_register(1070,0,3,False)
        ##add001=rs485.read_register(1071,0,3,False)
        ##add002=rs485.read_register(1072,0,3,False)
        ##add003=rs485.read_register(1073,0,3,False)
        ##add004=rs485.read_register(1074,0,3,False)
        ##add005=rs485.read_register(1075,0,3,False)
        ##add006=rs485.read_register(1076,0,3,False)
        ##add007=rs485.read_register(1077,0,3,False)
        
        regConcentration = rs485.read_registers(1000,8,3)
        regVoltage = rs485.read_registers(1010,8,3)
        regTemp = rs485.read_registers(1070,8,3)
        
        return regConcentration + regVoltage
        
    except Exception as e:
        print(e)
        return None


try:
    while True:
        try:
            val = connect_membrapor(int(sys.argv[1]))
            print(val)
        except Exception as e2:
            print(e2)
            
        time.sleep(2)
            
    while False:
        try:
            val = connect_membrapor(int(sys.argv[1])).split(";")
            # print(val)
            MEMBRAPOR = "FS2_MEMBRASENS;" + dectofloat(val[1],val[0]) + ";" + dectofloat(val[3],val[2]) + ";" + dectofloat(val[5],val[4]) + ";" + dectofloat(val[7],val[6]) + ";" + dectofloat(val[9],val[8]) + ";" + dectofloat(val[11],val[10]) + ";" + dectofloat(val[13],val[12]) + ";" + dectofloat(val[15],val[14]) + ";" + dectofloat(val[17],val[16]) + ";" + dectofloat(val[19],val[18]) + ";" + dectofloat(val[21],val[20]) + ";" + dectofloat(val[23],val[22]) + ";END;"            
            update_sensor_value(str(sys.argv[1]),str(MEMBRAPOR))
            # print(MEMBRAPOR)
        except Exception as e2:
            print(e2)
            print("Reconnect MEMBRAPOR");
            update_sensor_value(str(sys.argv[1]),0)

        time.sleep(1)

except Exception as e:
    print(e)