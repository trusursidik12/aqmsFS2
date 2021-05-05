#!/bin/bash
echo "Reading devices... Please wait!!"
sleep 5s
ls /dev/ttyUSB*
sleep 5s
python3 ~/aqmsFS2/aqms_start.py &