#!/usr/bin/env python3
import cgi
import os
from lxml import etree
print ("Content-type: text/html")
print ()
xmlfile = open('/home/vcap/app/static/index.xml')
xslfile = open('/home/vcap/app/static/index.xsl')
xmldom = etree.parse(xmlfile)
xsldom = etree.parse(xslfile)
transform = etree.XSLT(xsldom)
sort_name = os.getenv('QUERY_STRING')
q = etree.XSLT.strparam(sort_name)
result = transform(xmldom, sortby = q)
print (result)