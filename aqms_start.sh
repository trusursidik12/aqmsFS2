#!/bin/bash
echo "Reading devices... Please wait!!"
sleep 5s
ls /dev/ttyUSB*
sleep 5s
cd ~/aqmsFS2/ && python3 aqms_start.py &