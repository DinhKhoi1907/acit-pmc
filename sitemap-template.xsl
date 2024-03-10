<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
        version="2.0"
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
        xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
        
    <xsl:output method="html" indent="yes" encoding="UTF-8"/>

    <xsl:template match="/">
        <html>
            <head>
                <title>
                    Sitemap
                    <xsl:if test="sitemap:sitemapindex">Index</xsl:if>
                </title>
                <style type="text/css">
                    body {
                        font-family:Tahoma;
                        font-size:13px;
                        margin: 0 auto;
                    }

                    table{width:100%;border-collapse: collapse;color: #666;}

                    tbody tr:nth-child(even) {
                        background-color: #f7f7f7;
                    }
                    
                    .layout-content{max-width: 75%; margin: 0 auto;}
                    .count-items{margin-top: 2rem; margin-bottom: 1rem;font-size: 14px; color: #666; font-weight: 100;}

                    #intro {
                        background-color:#26b99a;                       
                        padding:5px 13px 5px 13px;
                        padding: 2rem;
                        color:#fff;
                    }
                    #intro a{color:#fff;}
                    
                    #intro h1{margin:0;margin-bottom: 2rem;}

                    #intro p {
                        line-height:16.8667px;
                        font-size: 14px;margin-top:0;
                    }

                    #content{padding: 20px 30px; background: #fff; max-width: 75%; margin: 0 auto;margin-top:2rem}
                    
                    td {
                        font-size:13px;
                        padding: 15px 12px; border-bottom: 1px solid #ddd;
                    }

                    td a{color: #05809e; text-decoration: none;display: block;}
                    
                    th {
                        text-align:left;
                        padding: 15px 12px;
                        font-size:14px;
                    }
                    
                    tr.high {
                        background-color:whitesmoke;
                    }
                    
                    #footer {
                        padding:2px;
                        margin:10px;
                        font-size:8pt;
                        color:gray;
                    }
                    
                    #footer a {
                        color:gray;
                    }
                    
                    a {
                        color:black;
                    }
                    .url-back a{color: #05809e; text-decoration: none;font-size: 13px;}
                </style>
                
            </head>
            <body class="">
                <header class="mw8 pv4 center">
                    <div id="intro">
                        <h1>XML Sitemap</h1>
                        <p>This XML Sitemap is generated by <a href="https://s.rankmath.com/home" target="_blank">Rank Math WordPress SEO Plugin</a>. Learn more about <a href="http://sitemaps.org" target="_blank">XML Sitemaps</a>.</p>
                        

                    </div>
                </header>

                <h2 class="layout-content count-items">
                    <xsl:choose>
                        <xsl:when test="sitemap:sitemapindex">
                            This XML Sitemap Index contains
                            <strong class="blue"><xsl:value-of select="count(sitemap:sitemapindex/sitemap:sitemap)"/></strong>
                            sitemaps.
                        </xsl:when>
                        <xsl:otherwise>
                            This XML Sitemap contains
                            <strong class="blue"><xsl:value-of select="count(sitemap:urlset/sitemap:url)"/></strong>
                            URLs.
                            <p class="url-back"><a href="./">← Sitemap Index </a></p>
                        </xsl:otherwise>
                    </xsl:choose>
                </h2>
                <xsl:apply-templates/>

            </body>
        </html>
    </xsl:template>


    <xsl:template match="sitemap:sitemapindex">
        <div class="layout-content">
            <div class="">
                <table class="" cellspacing="0">
                    <thead>
                        <tr style='background-color: #26b99a; color: #fff;'>                            
                            <th class="">Sitemap</th>
                            <th class="" style="width:150px">Last Modified</th>
                        </tr>
                    </thead>
                    <tbody class="">
                    <xsl:for-each select="sitemap:sitemap">
                        <tr class="">
                            <xsl:variable name="loc">
                                <xsl:value-of select="sitemap:loc"/>
                            </xsl:variable>
                            <xsl:variable name="pno">
                                <xsl:value-of select="position()"/>
                            </xsl:variable>                            
                            <td class="">
                                <a href="{$loc}" class="link blue">
                                    <xsl:value-of select="sitemap:loc"/>
                                </a>
                            </td>
                            <xsl:if test="sitemap:lastmod">
                            <td class="">
                                <xsl:value-of select="concat(substring(sitemap:lastmod, 0, 11), concat(' ', substring(sitemap:lastmod, 12, 5)), concat(' ', substring(sitemap:lastmod, 20, 6)))"/>
                            </td>
                            </xsl:if>
                            <xsl:apply-templates/>
                        </tr>
                    </xsl:for-each>
                    </tbody>
                </table>
            </div>
        </div>
    </xsl:template>

    <xsl:template match="sitemap:urlset">
        <div class="layout-content">
            <div class="">
                <table class="" cellspacing="0">
                    <thead class="bg-silver">
                        <tr style='background-color: #26b99a; color: #fff;'>
                            <th class="">URL</th>
                            <xsl:if test="sitemap:url/sitemap:changefreq">
                            <th class="" style="width:150px">Last Modified</th>
                            </xsl:if>                            
                        </tr>
                    </thead>
                    <tbody class="">
                    <xsl:for-each select="sitemap:url">
                        <tr class="">
                            <xsl:variable name="loc">
                                <xsl:value-of select="sitemap:loc"/>
                            </xsl:variable>
                            <xsl:variable name="pno">
                                <xsl:value-of select="position()"/>
                            </xsl:variable>
                            <td class="">
                                <p>
                                    <a href="{$loc}" class="link blue" target="_blank">
                                        <xsl:value-of select="sitemap:loc"/>
                                    </a>
                                </p>
                                <xsl:apply-templates select="xhtml:*"/>
                                <xsl:apply-templates select="image:*"/>
                                <xsl:apply-templates select="video:*"/>
                            </td>                            
                            <xsl:if test="sitemap:lastmod">
                            <td class="">
                                <xsl:value-of select="concat(substring(sitemap:lastmod, 0, 11), concat(' ', substring(sitemap:lastmod, 12, 5)), concat(' ', substring(sitemap:lastmod, 20, 6)))"/>
                            </td>
                            </xsl:if>
                        </tr>
                    </xsl:for-each>
                    </tbody>
                </table>
            </div>
        </div>
    </xsl:template>

    <xsl:template match="sitemap:loc|sitemap:lastmod|image:loc|image:caption|video:*">
    </xsl:template>

    <xsl:template match="sitemap:changefreq|sitemap:priority">
        <td class="pa3 tr bb b--silver">
            <xsl:apply-templates/>
        </td>
    </xsl:template>

    <xsl:template match="xhtml:link">
        <xsl:variable name="altloc">
            <xsl:value-of select="@href"/>
        </xsl:variable>
        <p>
            <strong>Xhtml: </strong>
            <a href="{$altloc}" class="mr2 link blue">
                <xsl:value-of select="@href"/>
            </a>

            <xsl:if test="@hreflang">
                <small class="dib mr2 ph1 pv1 tracked lh-solid white bg-silver br-pill">
                    <xsl:value-of select="@hreflang"/>
                </small>
            </xsl:if>

            <xsl:if test="@rel">
                <small class="dib mr2 ph2 pv1 tracked lh-solid white bg-silver br-pill">
                    <xsl:value-of select="@rel"/>
                </small>
            </xsl:if>

            <xsl:if test="@media">
                <small class="dib mr2 ph2 pv1 tracked lh-solid white bg-silver br-pill">
                    <xsl:value-of select="@media"/>
                </small>
            </xsl:if>
        </p>
        <xsl:apply-templates/>
    </xsl:template>

    <xsl:template match="image:image">
        <xsl:variable name="loc">
            <xsl:value-of select="image:loc"/>
        </xsl:variable>
        <p>
            <strong>Image: </strong>
            <a href="{$loc}" class="mr2 link blue">
                <xsl:value-of select="image:loc"/>
            </a>
            <xsl:if test="image:caption">
                <span class="i gray">
                    <xsl:value-of select="image:caption"/>
                </span>
            </xsl:if>
            <xsl:apply-templates/>
        </p>
    </xsl:template>

    <xsl:template match="video:video">
        <xsl:variable name="loc">
            <xsl:choose>
                <xsl:when test="video:player_loc != ''">
                    <xsl:value-of select="video:player_loc"/>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="video:content_loc"/>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        <xsl:variable name="thumb_loc">
            <xsl:value-of select="video:thumbnail_loc"/>
        </xsl:variable>
        <p>
            <strong>Video: </strong>
            <a href="{$loc}" class="mr2 link blue">
                <xsl:choose>
                    <xsl:when test="video:player_loc != ''">
                        <xsl:value-of select="video:player_loc"/>
                    </xsl:when>
                    <xsl:otherwise>
                        <xsl:value-of select="video:content_loc"/>
                    </xsl:otherwise>
                </xsl:choose>
            </a>
            <a href="{$thumb_loc}" class="dib mr2 ph2 pv1 tracked lh-solid link white bg-silver hover-bg-blue br-pill">
                thumb
            </a>
            <xsl:if test="video:title">
                <span class="i gray">
                    <xsl:value-of select="video:title"/>
                </span>
            </xsl:if>
            <xsl:apply-templates/>
        </p>
    </xsl:template>

</xsl:stylesheet>