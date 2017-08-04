#!/bin/bash
df -h | awk '$NF=="/"{printf "Disk Usage: %d/%dGB (%s)\n", $3,$2,$5}'

# apart opgeslagen, indien alle commando's in 1 script zitten kan geen lijnen tussenlaten (geen printf "\n")