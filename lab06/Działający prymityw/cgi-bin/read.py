#!/usr/bin/env python3
import csv

datafile = open('data.csv', 'r')
myreader = csv.reader(datafile)

def print_rows(row0, row1, row2, row3):
    print ("<p>" + row0 + "</p>")
    print ("<p>" + row1 + "</p>")
    print ("<p>" + row2 + "</p>")
    print ("<p>" + row3 + "</p>")

# print HTTP/HTML headers
print ("Content-type: text/html")
print ()

print("""<!doctype html>
<html>
<head>
<title>Lista danych</title>
<meta charset="UTF-8" />
<link rel = "stylesheet" type="text/css" href="../static/lab6.css" />
<script src="../static/functions.js" ></script>
</head>
<body>

    <div id="link">
        <a href="../static/lab6.html">Formularz</a><br/>     
    </div>
    """)

print("""<div>""")

for row in myreader:
    print_rows(row[0], row[1], row[2], row[3])

print("""</div>""")
print("""</body></html>""")
