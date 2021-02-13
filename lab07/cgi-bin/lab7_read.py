#!/usr/bin/env python3
import json


with open('data.json','r') as infile:
    dane = json.load(infile)

json_formatted_str = json.dumps(dane)

print ("Content-Type: application/json")
print ("")
print(json_formatted_str)

 