eZ Human CAPTCHA extension for eZ Publish 4.0
version 1.8 stable

Written by Piotrek Karas, Copyright (C) SELF s.c. & mediaSELF.pl
http://www.mediaself.pl, http://ryba.eu



What is eZ Human CAPTCHA?
--------------------------

eZ Human CAPTCHA is a simple eZ Publish extension which provides a collection
of tools that make it easier to use session-based CAPTCHA techniques for 
preventing bots from submitting any unwanted data to your website.

The default way to use it is to add Human CAPTCHA-datatype-based attribute 
to your content class. From that moment on any edit action taken on objects
representing that class will require CAPTCHA code to be provided. This will 
secure both editing as well as collecing info. This method is completely 
automatic and does not require any development whatsoever. 

The other method is meant for developers, who want their own modules and/or
templates secured. There are two template operators responsible for 
initiating/displaying a token and validating the code respectively. Optionally,
it is possible to directly call a method responsible for token validation in
PHP.

Since the quality of the CAPTCHA token image is of critical importance, 
this extension can be further extended by applying custom image filters. An
image filter is simply a set of PHP instructions to generate a token image.

Search the Web if you need further information on CATPCHA itself.



License
-------

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; version 2 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.



eZ Human CAPTCHA features
--------------------------
- Human CAPTCHA datatype for use in any content class
- Advanced configuration
- Extensible architecture for changing/improving CAPTCHA image generation
- Additional methods and template operators for using outside class attribute
  in own modules, tools, templates etc.
- more... (under construction) ;)



Template operators
------------------

ezhumancaptcha_image()
Initiates a CAPTCHA token session and returns path to the token image.

ezhumancaptcha_validate()
Validates POST variable eZHumanCAPTCHACode. Returns an array of error messages
on failure or an empty erray on success.

Note: ezhumancaptcha_validate() template operator is synonymous with
eZHumanCAPTCHATools::validateHTTPInput() method.

Note: From version 0.4 on there's a module/view for testing purposes,
simply run index.php/siteaccess/ezhumancaptcha/test



Requirements
------------
- eZ Publish 4.0.0+
- eZ Publish Components: Base, File, ImageConversion, Authentication
- ImageMagick/GD library, depending on token image filters used



Tested with
-----------
4.0.0



Installation
------------

1. Copy the extension to the /extension folder, so that 
you have /extension/ezhumancaptcha/* structure.

2. Enable the extension (either via administration panel or directly with 
settings files):
[ExtensionSettings]
ActiveExtensions[]=ezhumancaptcha

3. Configure ezhumancaptcha.ini file according to your preferences.

4. Configure cronjobs according to your needs, in most cases infrequent
group will do just fine.

5. Clear cache.



Creating new image token filters
--------------------------------

Image token filter files are placed in /ezhumancaptcha/classes/imagefilters
directory. The name of the file will become the name of the filter, for example
default.php is a file for 'default' filter. The filter file must contain
a class eZHumanCAPTCHAImageFilter with at least one static method named
generateImage, as shown on the example below:

File: /ezhumancaptcha/classes/imagefilters/myown.php
class eZHumanCAPTCHAImageFilter
{
	public static function generateImage( $token, $encryptedToken )
	{
		$ini = eZINI::instance('ezhumancaptcha.ini');
		$commonSettings = $ini->group( 'CommonCAPTCHASettings' );
		$path = eZHumanCAPTCHATools::generateImagePath( $encryptedToken, 
			$commonSettings['TokenFormat'] );

		// Here you should provide a settings block name of your filter 
		$filterSettings = $ini->group( 'MyOwnFilterSettings' );
		
		// Here you generate the token image, based on $token variable value
		
		return $path;
	}
}

Then, in the ezhumancaptcha.ini settings file you declare your new filter:  
TokenImageFilter=myown

You may also define all the variables that you require:
[MyOwnFilterSettings]
...



Module example
--------------

// Use this code when validating you custom-made form

// START
// Include toolset and call validation method
include_once( 'extension/ezhumancaptcha/classes/ezhumancaptchatools.php' );
$eZHumanCAPTCHAValidation = eZHumanCAPTCHATools::validateHTTPInput();
if ( count( $eZHumanCAPTCHAValidation ) )
{
	// CAPTCHA DID NOT VALIDATE - decisions here...
	$errorMessagesArray = $eZHumanCAPTCHAValidation;
}
else
{
	// CAPTCHA DID VALIDATE - decisions here...
}
// END

Note: eZHumanCAPTCHATools::validateHTTPInput() method is synonymous with 
ezhumancaptcha_validate() template operator.

Note: From version 0.4 on there's a module/view for testing purposes,
simply run index.php/siteaccess/ezhumancaptcha/test



Template example
----------------

SEND:
<form action={"/itest/target/"|ezurl} method="post">
<img src={ezhumancaptcha_image()|ezroot()} alt="eZHumanCAPTCHA" />
<input class="box" type="text" size="4" name="eZHumanCAPTCHACode" value="" />
<input class="button" type="submit" name="SendButton" value="Send" />
</form>

RECEIVE:
{def $errorArray = ezhumancaptcha_validate()}
{if count($errorArray)}
	CAPTCHA validation failed:
	<ul>
	{foreach $errorArray as $errorMsg}
		<li>{$errorMsg}</li>
	{/foreach}
	</ul>
{else}
	CAPTCHA validation successful!
{/if}
{undef $errorArray}



Questions and answers
---------------------

1. Where does this weird name come from?
Human - to stress that it is to favor humans ;)
Also, I wanted a good, common, recognizable prefix for extensions based on this
one. For example, eZ Human Tip A friend is on its way ;)



Changelog
---------

# vX, public, unreleased
- Additional token image filters (use eZ Components).

# v1.8 stable, public, 2008.05.26
+ Additional dictionary mode, next to random generation of tokens.

# v1.7 stable, public, 2008.02.11
+ Strict 'require attribute' option to make it impossible to omit attribute
  in the edit mode.

# v1.6 stable, public, 2008.02.09
+ Bypass for logged in users on specific class attributes (datatype mode).
+ Additional template operator for bypass hashing (secure bypass).

# v1.5 stable, public, 2008.01.01
+ Bug fix/enhancement: proper token invalidation to prevent re-submitting.

# v1.4 stable, public, 2007.12.31
+ Bug fix: validation problems in template/module mode when using siteaccess
  or user bypasses.

# v1.3 stable, public, 2007.12.14
+ Readme cleanup.

# v1.2 stable, public, 2007.12.13
+ Possible to bypass token validation for given siteaccess and/or userID

# v1.1 stable, public, 2007.12.12
+ Bug/compatibility fix: call_user_func syntax not compatible with PHP 5.2.2
  and earlier - a version sensitive patch applied.

# v1.0 stable, public, 2007.12.11
+ Salt string for token encryption

# v0.4 beta, public, 2007.12.09
+ Test/sample module and view: ezhumancaptcha/test

# v0.3 beta, public, 2007.12.08
+ Add logging/debugging for critical areas.
+ Use eZ Publish methods instead of native PHP functions where possible.
+ Default token image filter needs general improvements and corrections ;)

# v0.2 beta, public, 2007.12.08
+ Add instructions on how to add custom filters.
+ Fix: token image cleanup function missing.
+ Cronjob for token image cleanup function.
+ Minor readme improvements and corrections.

# v0.1 alpha, public, 2007.12.08
+ First almost fully working version, still for testing purposes only, does not
  provide mechanism for cleaning up uncaught token image garbage. 

# v0.0 alpha, local, 2007.12.06
+ Start.


/+/ complete
/-/ plan or in progress
