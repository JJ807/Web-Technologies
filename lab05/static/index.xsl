<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" >
<xsl:output method="html" version="1.0"
     indent="yes" doctype-system="about:legacy-compact" />
	 <xsl:param name="sortby"/>
	<xsl:template match="/">
        <html>
            <head>
					<link rel = "stylesheet" type="text/css" href="../static/index.css" />
                <title>
                    Zadanie 5 - Lab 05
                </title>
            </head>
            <body>
				<xsl:apply-templates select="cialo/naglowek" />
				<table border="1" cellpadding="5">
					<tr>
						<th>Lp.</th>
						<th>Nazwa produktu</th>
						<th>Liczba sztuk</th>
						<th>Cena jednostkowa</th>
					</tr>
				
				<xsl:apply-templates select="cialo/grupa[nazwa='RTV/AGD']" />
				<xsl:apply-templates select="cialo/grupa[nazwa='Materiały budowlane']" />
				<xsl:apply-templates select="cialo/grupa[nazwa='Przybory szkolne']" />
				<xsl:apply-templates select="cialo/grupa[nazwa='Chemia']" />
				<xsl:apply-templates select="cialo/grupa[nazwa='Muzyka']" />
				</table>
            </body>
        </html>
	</xsl:template>
	
<xsl:template match="naglowek">	
	<naglowek>
		   <naglowek_i>
				<xsl:value-of select="./naglowek_i" />
		   </naglowek_i>
	</naglowek>
</xsl:template>


<xsl:template match="grupa">	

		<tr>
			<td colspan="4" style="background-color:#EFC050">
				<xsl:value-of select="./nazwa"/>
			</td>
		</tr>
		
			<xsl:choose>
			
				<xsl:when test="$sortby = 'produkt'">
					<xsl:for-each select="wiersz">
						<xsl:sort select="produkt/text()" data-type="text"/>
						<xsl:call-template name="wiersz"/>
					</xsl:for-each> 
				</xsl:when>
				
				<xsl:when test="$sortby = 'cena'">
					<xsl:for-each select="wiersz">
						<xsl:sort select="cena/text()" data-type="number"/>
						<xsl:call-template name="wiersz"/>
					</xsl:for-each> 
				</xsl:when>
				
				<xsl:when test="$sortby = 'liczba'">
					<xsl:for-each select="wiersz">
						<xsl:sort select="ilosc/text()" data-type="number"/>
						<xsl:call-template name="wiersz"/>
					</xsl:for-each> 
				</xsl:when>
				
				<xsl:otherwise>
					<xsl:for-each select="wiersz">
						<xsl:call-template name="wiersz"/>
					</xsl:for-each> 
				</xsl:otherwise>
		
		     </xsl:choose>
</xsl:template>

<xsl:template name="wiersz">
	<tr>
		<td><xsl:value-of select="lp" /></td>
		<td><xsl:value-of select="produkt" /></td>
		<td><xsl:value-of select="ilosc" /></td>
		<td><xsl:value-of select="cena" /></td>
	</tr>
</xsl:template>

</xsl:stylesheet>