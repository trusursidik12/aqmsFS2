from __future__ import print_function
import sys
import time
import serial
import subprocess
import glob
import db_connect

mydb = db_connect.connecting()
mycursor = mydb.cursor()

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

for port in serial_ports():
    print("Adding port " + port)
    port_desc = ""

    if sys.platform.startswith('linux') or sys.platform.startswith('cygwin'):
        # p = subprocess.Popen('dmesg | grep ' + str(port).replace('/dev/','') + ' | tail -1', stdout=subprocess.PIPE, shell=True)
        p = subprocess.Popen("udevadm info -a -n /dev/ttyUSB0 | grep '{manufacturer}\|{product}\|{serial}\|{idVendor}\|{idProduct}' -m5", stdout=subprocess.PIPE, shell=True)
        (output, err) = p.communicate()
        p_status = p.wait()
        port_desc = output.decode("utf-8")
        if "now attached" in port_desc:
            try:
                port_desc = port_desc.split(":")[1].split(" now attached")[0]
            except:
                port_desc = port_desc

    print(port_desc)
    try:
        mycursor.execute("INSERT INTO serial_ports (port,description) VALUES ('" + port + "','" + port_desc + "')")
        mydb.commit()
    except Exception as e:
        None
