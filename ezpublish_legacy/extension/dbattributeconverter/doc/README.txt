DB Attribute Converter README
-------------------
DB Team
ver 1.0


What is DB Attribute Converter ?
-------------------
DB Attribute Converter is an extension that can save life of some devolopers, 
that have to modify existing content class attributes replacing one attribute
datatype by another. Using this extension it's possible to keep content of 
converted attribute untouched or striped - depending on source and target 
datatypes.

Extension comes with GUI wizard, that helps to prepare conversion. During this 
process user can select source attribute and target new datatype. Wizard allows 
also to select additional options depending on source & target datatype.

Conversion between each datatypes is done by separate conver handlers. That are
special classes that extends common class and takes care of specific data 
transformation between datatypes for both class attribute and object 
atrributes.

Currently just few most typical convert handlers are available, like ezsting to
eztext or ezdate to ezdatetime. For more infos check converthandlers/ folder or
attributeconverter.ini.append.php file.



Generall usage instructions
-------------------
You can access wizard by new tab visible in admin interface after enabling this 
extension, or just by uri: attributeconverter/wizard
Remember! Always backup your database before launching this script!
Convesion process can be launched in three ways:

1. Directly in GUI, if only number of attributes is not to big. My tests says 
   that it's safe on even avarange speed server to convert a few thousands 
   attributes just in less than 10 seconds. Number of attributes is always 
   displayed before conversion. Just remember that all exising attributes will
   be converted, it means for all language version and of all archived 
   versions. To decrease this number be sure to remove unnecessary data before
   launching conversion.
   An antitimeout protection has been added (taken from ezscriptmonitor), that
   detects possible timeout, breaks scripts and force user to launch process
   in background (or automaticly schedule ezscriptmonitor if installed).
   
2. It's also possible to store wizard configuration and execute conversion from
   command line. To do this, wizard will return special 4 signs code, that must
   be passed to the command line. Here is example:
   php extension/bin/converter.php -s <site_access> --filename-part xxxx
   This way you can create more than one conversion with wizard, and launch
   them later from command line. Just be sure you don't convert the same
   attribute more than once!
   
3. Last method is the most comfortable, it use eZScriptMonitor that schedule 
   and launch process in background. It also provides simple view to monitor
   script status (not launched, running, dead or finished).

After conversion it can be needed to clear all cache and run content 
reindexation.



Adding new convert handlers
-------------------
It's easy for every eZ Publish developer to create new handlers, that will 
allow to convert other than typical datatypes or their own specific datatypes.
There is plan to create better documentation for developers, but for now please
just check a few of ready handlers and reference class located in
classes/converthandler.php. All you have to do is to create new folder
with and php file with class, that extends convertHandler class. Also to 
attributeconverter.ini.append.php ini file you must add variable with handler 
name to let extension know about it.
If you would like to ask about possiblity to add particlular convert handler,
just let us know about it! Visit http://db-team.eu




Requirements
-------------------
eZ Publish version 4+
For large database it's required to execute conversion from command line.
The best is to use dedicated extesnion that moves process automaticly to 
background. Check it now: http://projects.ez.no/ezscriptmonitor



Installation
-------------------
1. Unpack the extension and place it in your extension directory (as with all
   extensions).
   
2. Optionally download and unpack eZScriptMonitor extension like above. No need
   to implement provided patches!

3. Enable the extension in admin interface, make sure that autoloads arrays 
   for extensions has been regenerated.

 


TO DO
-------------------
- write a doc for developers how to create new handler
- debug warnings and notices
- add more convert handlers, like ezimage2ezobjectrelation and vice versa
- add new step after target attribute selection with sum up
- think how to handle datatypes with digit `2` in name, like ezmultioption2
- add language packs
- version working with eZ Publish v3.x as many sites that can need this 
  extension are old.
