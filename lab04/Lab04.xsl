<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" >
<xsl:output method="html" version="1.0"
     indent="yes" doctype-system="about:legacy-compact" />
	<xsl:template match="/">
        <html>
            <head>
					<link rel = "stylesheet" type="text/css" href="Lab04.css" />
                <title>
                    Zadanie 4 - Lab04
                </title>
            </head>
            <body>
                <h1>
                    Laboratorium 4 - ćwiczenia
                </h1>
				
				<ul>
					<li>Ćwiczenie 1 - lista wszystkich studentów</li>
					<li>Ćwiczenie 2 - posortowana lista studentów</li>
					<li>Ćwiczenie 3 - posortowana lista studentów po roku studiów, nazwisku i imieniu</li>
					<li>Ćwiczenie 4 - lista studentów na poszczególnych kierunkach</li>
				</ul>	
		
                <xsl:apply-templates select="labs" />
            </body>
        </html>
	</xsl:template>

<xsl:template match="lab">	
<lab>
	   <tytul><xsl:value-of select="title" /></tytul>
	   <description><xsl:value-of select="description" /></description> 
	   <pre><code><xsl:value-of select="code"/></code></pre>
</lab>
</xsl:template>

</xsl:stylesheet>