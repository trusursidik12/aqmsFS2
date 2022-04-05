#!/bin/bash
echo "Reading devices... Please wait!!"
sleep 1s
ls /dev/ttyUSB*
ls /dev/ttyM*
sleep 1s
echo admin | sudo -S chmod 666 /dev/tty*
sleep 1s
cd ~/aqmsFS2/ && python3 aqms_start.py
$SHELL