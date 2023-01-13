#!/bin/bash
echo "Reading devices... Please wait!!"
sleep 1s
ls /dev/ttyUSB*
ls /dev/ttyD*
cd ~/aqmsFS2/ && python3 aqms_start.py
$SHELL