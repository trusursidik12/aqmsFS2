from __future__ import print_function
import sys
import serial
import time
import db_connect

is_SENSOR_connect = False
is_connect = False
current_state = 0
current_speed = 0
sensor_mode = [""] * 10
end_string_sensor = [""] * 10

sensor_mode[0] = "data.membrasens.ppm"
sensor_mode[1] = "data.membrasens.temp"
sensor_mode[2] = "data.pm.1"
sensor_mode[3] = "data.pm.2"
sensor_mode[4] = "data.ina219"
sensor_mode[5] = "data.dht"
sensor_mode[6] = "data.bme"
sensor_mode[7] = "data.pressure"
sensor_mode[8] = "data.pump"
# sensor_mode[9] = "data.sentec"

end_string_sensor[0] = "END_MEMBRASENS_PPM"
end_string_sensor[1] = "END_MEMBRASENS_TEMP"
end_string_sensor[2] = "END_PM1"
end_string_sensor[3] = "END_PM2"
end_string_sensor[4] = "END_INA219"
end_string_sensor[5] = "END_DHT"
end_string_sensor[6] = "END_BME"
end_string_sensor[7] = "END_PRESSURE"
end_string_sensor[8] = "END_PUMP"
# end_string_sensor[9] = "END_SENTEC"

try:
    mydb = db_connect.connecting()
    mycursor = mydb.cursor()

    mycursor.execute(
        "SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '" + sys.argv[1] + "'")
    sensor_reader = mycursor.fetchone()
except Exception as e:
    print("[X]  SENSOR Module ID: " + str(sys.argv[1]) + " " + e)


def update_sensor_value(sensor_reader_id, pin, value):
    try:
        try:
            mycursor.execute("SELECT id FROM sensor_values WHERE sensor_reader_id = '" +
                             str(sensor_reader_id) + "' AND pin = '" +
                             str(pin) + "'")
            sensor_value_id = mycursor.fetchone()[0]
            mycursor.execute("UPDATE sensor_values SET value = '" +
                             str(value) + "' WHERE id = '" + str(sensor_value_id) + "'")
            mydb.commit()
        except Exception as e:
            mycursor.execute("INSERT INTO sensor_values (sensor_reader_id,pin,value) VALUES ('" +
                             str(sensor_reader_id) + "','" +
                             str(pin) + "','" + str(value) + "')")
            mydb.commit()
    except Exception as e2:
        print("Error update_sensor_value")
        print(e2)
        return None

try:
    mycursor.execute(
        "SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '" + sys.argv[1] + "'")
    sensor_reader = mycursor.fetchone()
    ser = serial.Serial(sensor_reader[0], sensor_reader[1], timeout=5)
    print("[V] MAINBOARD " + sensor_reader[0] + " CONNECTED")
except Exception as e:
    ser = None

def getSensorValue(mode):
    retval = ""
    try:
        while retval.find(end_string_sensor[mode]) == -1:
            ser.write(bytes(sensor_mode[mode] + "#",'utf-8'))
            time.sleep(0.1)
            # retval = ser.readline().decode('utf-8').strip('/r/n')
            retval = ser.readline().decode('utf-8')
    except Exception as e:
        None
        
    return retval
    
    
def update_all_sensor():
    for mode in range(9): #ubah ke 10 jika menggunakan SENTEC
        try:
            value = getSensorValue(mode)
            # print(value)
            update_sensor_value(str(sys.argv[1]), mode, value)
        except Exception as e:
            None
            
        time.sleep(0.1)
        
def pump_switch():
    global current_state
    try:
        try:
            mycursor.execute(
                "SELECT content FROM configurations WHERE name LIKE 'pump_state'")
            pump_state = mycursor.fetchone()[0]
            if pump_state != current_state:
                current_state = pump_state
                print("pump.state." + str(current_state) + "#")
                ser.write(bytes('pump.state.' + str(current_state) + "#",'utf-8'))
                data = ser.readline().decode('utf-8').strip('/r/n')
                
        except Exception as e2:
            print(e2)
    except Exception as e:
        print(e)


def pump_speed():
    global current_speed
    mycursor.execute(
        "SELECT content FROM configurations WHERE name LIKE 'pump_speed'")
    pump_speed = mycursor.fetchone()[0]
    if pump_speed != current_speed:
        current_speed = pump_speed
        time.sleep(1)
        print("pump.speed." + str(current_speed) + "#")
        ser.write(bytes('pump.speed.' + str(current_speed) + "#",'utf-8'))
    data = ser.readline().decode('utf-8').strip('/r/n')


try:
    while True:
        if ser is not None:            
            pump_switch()
            pump_speed()
            update_all_sensor()                
        else:
            try:
                mycursor.execute(
                    "SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '" + sys.argv[1] + "'")
                sensor_reader = mycursor.fetchone()
                ser = serial.Serial(sensor_reader[0], sensor_reader[1], timeout=5)
            except Exception as e:
                ser = None

except Exception as e:
    print(e)
