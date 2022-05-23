#!/bin/bash
echo "Killing all"
sleep 1s
echo admin | sudo kill -S $(ps aux | grep '[p]hp' | awk '{print $2}')
sleep 1s
echo admin | sudo kill -S $(ps aux | grep 'terminal' | awk '{print $2}')
sleep 1s
echo admin | sudo kill -S $(ps aux | grep 'firefox' | awk '{print $2}')