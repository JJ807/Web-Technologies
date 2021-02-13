#!/usr/bin/env python3
import json
import cgi 
form = cgi.FieldStorage()

# pobranie zaznaczonej odpowiedzi
user_answer = form.getvalue("options")

# czytanie poprzednich wartosci
with open('data.json','r') as infile:
    dane = json.load(infile)

# inkrementacja 
for tablica in dane.get("seasons", 0):
    for i in tablica:
        if i == user_answer:
            tablica[user_answer] = tablica.get(user_answer) + 1

# zapisanie do pliku
with open('data.json', 'w') as outfile:
    json.dump(dane, outfile)


# redirect
redirectURL = "../../static/lab7/lab7.html"
print ("Content-type: text/html")
print ("Status: 303 See other")
print ("Location: %s" % redirectURL)
print ("")