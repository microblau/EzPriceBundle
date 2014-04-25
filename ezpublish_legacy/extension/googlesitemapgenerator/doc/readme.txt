GoogleSitemapGenerator Extension
README

Name   : GoogleSitemapGenerator Extension
Version: 3.0.0
Author : MEDIATA Communications GmbH
Date   : 2009-02-13


1. Description

	The GoogleSitemapGenerator extension generates a xml-sitemap conform to the Google-sitemap-protocol.
	(https://www.google.com/webmasters/tools/docs/en/protocol.html)

	GoogleSitemapGenerator develops the idea of the GoogleSiteMaps Extension 0.1 by Sergey A. Shishkin

	GoogleSitemapGenerator is tested with eZ Publish 4.0.0


2. Installation + configuration

	Please read install.txt for installation and configuration instructions.


3. Using GoogleSitemapGenerator

	3.1 Browse URL http://<eZ Publish path>/<siteaccess>/layout/set/google/googlesitemap/generate/<NodeID>

	Depending on your configuration <siteaccess> is optional!

	    Examples:
	    	1. http://www.example.com/cms/index.php/<siteaccess>/layout/set/google/googlesitemap/generate/123
	    	   The sitemap of the <siteaccess> siteaccess will be displayed, beginning with node 123.
	    	   URLs inside the sitemap look like: http://www.example.com/<path_to_ez_publish_root>/index.php/<siteaccess>/<url_alias_of_node>

	3.2 Register account and login into Google Sitemaps
        https://www.google.com/webmasters/sitemaps/

    3.3 Add your site to Google Sitemaps

    3.4 Append sitemap of your site