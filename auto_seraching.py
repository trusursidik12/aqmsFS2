from __future__ import print_function
from pymodbus.client.sync import ModbusSerialClient
from pyvantagepro import VantagePro2
import sys
import minimalmodbus
import serial
import time
import subprocess
import glob
import db_connect

mydb = db_connect.connecting()
mycursor = mydb.cursor()

mycursor.execute("UPDATE sensor_readers SET sensor_code=''")
mydb.commit()

def serial_ports():
    if sys.platform.startswith('win'):
        ports = ['COM%s' % (i + 1) for i in range(256)]
    elif sys.platform.startswith('linux') or sys.platform.startswith('cygwin'):
        ports = glob.glob('/dev/tty[A-Za-z]*')
    elif sys.platform.startswith('darwin'):
        ports = glob.glob('/dev/tty.*')
    else:
        raise EnvironmentError('Unsupported platform')

    result = []
    for port in ports:
        try:
            s = serial.Serial(port)
            s.close()
            result.append(port)
        except (OSError, serial.SerialException):
            pass
    return result
    
def check_as_arduino(port):
    COM = serial.Serial()
    COM.port = port
    COM.baudrate = 9600
    COM.timeout = 3
    COM.open()
    retval = str(COM.readline())
    if(retval.count("FS2_ANALYZER") > 0):
        mycursor.execute("UPDATE sensor_readers SET sensor_code='" + port + "' WHERE driver LIKE 'fs2_analyzer_module.py' AND sensor_code='' LIMIT 1")
        mydb.commit()
    if(retval.count("FS2_PUMP") > 0):
        mycursor.execute("UPDATE sensor_readers SET sensor_code='" + port + "' WHERE driver LIKE 'fs2_pump_module.py' AND sensor_code='' LIMIT 1")
        mydb.commit()
    if(retval.count("FS2_PSU") > 0):
        mycursor.execute("UPDATE sensor_readers SET sensor_code='" + port + "' WHERE driver LIKE 'fs2_psu_module.py' AND sensor_code='' LIMIT 1")
        mydb.commit()
    if(retval.count("FS2_AUTO_ZERO_VALVE") > 0):
        mycursor.execute("UPDATE sensor_readers SET sensor_code='" + port + "' WHERE driver LIKE 'fs2_autozerovalve.py' AND sensor_code='' LIMIT 1")
        mydb.commit()
        
def check_as_membrasens(port):
    try:
        rs485=minimalmodbus.Instrument(port,1)
        rs485.serial.baudrate=19200
        rs485.serial.parity=serial.PARITY_EVEN
        rs485.serial.bytesize=8
        rs485.serial.stopbits=1
        rs485.mode=minimalmodbus.MODE_RTU
        rs485.serial.timeout=0.2
        
        regConcentration = rs485.read_registers(1000,8,3)
        mycursor.execute("UPDATE sensor_readers SET sensor_code='" + port + "' WHERE driver LIKE 'fs2_membrasens_v4.py' AND sensor_code='' LIMIT 1")
        mydb.commit()
    except Exception as e: 
        None
        
def check_as_ventagepro2(port):
    try:
        COM_WS = VantagePro2.from_url("serial:%s:%s:8N1" % (port, 19200))
        ws_data = COM_WS.get_current_data()
        WS = ws_data.to_csv(';',False)
        print(WS)
        mycursor.execute("UPDATE sensor_readers SET sensor_code='" + port + "' WHERE driver LIKE 'vantagepro2.py' AND sensor_code='' LIMIT 1")
        mydb.commit() 
    except Exception as e: 
        print(e)
        
mycursor.execute("TRUNCATE TABLE serial_ports")
mydb.commit()
for port in serial_ports():
    print("Adding port " + port)
    port_desc = ""

    if sys.platform.startswith('linux') or sys.platform.startswith('cygwin'):
        p = subprocess.Popen('dmesg | grep ' + str(port).replace('/dev/','') + ' | tail -1', stdout=subprocess.PIPE, shell=True)
        (output, err) = p.communicate()
        p_status = p.wait()
        port_desc = output.decode("utf-8")
        if "now attached" in port_desc:
            try:
                port_desc = port_desc.split(":")[1].split(" now attached")[0]
            except:
                port_desc = port_desc

    print(port_desc)
    mycursor.execute("INSERT INTO serial_ports (port,description) VALUES ('" + port +"','" + port_desc +"')")
    mydb.commit()
    
    check_as_arduino(port)
    check_as_membrasens(port)
    check_as_ventagepro2(port)
    
    

    
    
