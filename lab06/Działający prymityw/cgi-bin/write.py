#!/usr/bin/env python3
import cgi
import csv
form = cgi.FieldStorage()
 
text1 = form.getvalue("pole1")
text2 = form.getvalue("pole2")
text3 = form.getvalue("pole3")
text4 = form.getvalue("lista")


with open('data.csv', 'a', newline='') as file:
    writer = csv.writer(file)
    writer.writerow([text1, text2, text3, text4])
    
print ("Content-type: text/html")
print()

print("""
<a href="../static/lab6.html">Formularz</a><br/>
<a href="read.py">Lista danych</a>""")
 