<?php /* #?ini charset="utf-8"?


[GeneralSettings]
# These are rather system settings, default values will satisfy most users

# The name of the session variable, if changed, all current codes will invalidate
TokenSessionVariableName=myEncryptedTokenVariable

# Toke encryption method, sha1 and md5 are available
TokenEncryptionMethod=sha1

# Toke encryption salt string
# Any, possibly unique and complex string that will be used to alter default
# encryption result; if left empty, standard token encryption method will
# be used
TokenEncryptionSalt=%8_3;L_6@Ck8%4A_e:+Xke

# Subdirectory of cache dir for captcha image storage
# The directory will be made if missing
# eZ Publish needs to be able to write to that location
TokenCacheDir=ezhumancaptcha

# Number of seconds after which a token image is considered garbage
# Note: it will only be cleaned up if you set up cleanup cronjob,
# the timeout by itself does not make anything happen
TokenTimeout=86400

# Filter class file name, default is 'default'
# All image processing is done within this class, users may easily 
# prepare and add their own filters without having to modify other files
TokenImageFilter=default

# An array of siteaccesses for which CAPTCH'a should be automatically
# validated without having to type in the code, typically userful for 
# administration interface
TokenBypassSiteaccessList[]
TokenBypassSiteaccessList[]=admin
TokenBypassSiteaccessList[]=panel

# An array of user IDs for which CAPTCH'a should be automatically
# validated without having to type in the code, typically userful for 
# administrators
TokenBypassUserIDList[]
# TokenBypassUserIDList[]=14

# An array of class attribute IDs of CAPTCHA type that should only be validated 
when user isn't logged in. Only for datatype mode.
# Note: the attribute should still be present, it just sends a different, 
# specially hashed value for additional security.
TokenBypassLoggedInClassAttributeID[]
TokenBypassLoggedInClassAttributeID[]=424
TokenBypassLoggedInClassAttributeID[]=425

# Prevent from editing an object when the CAPTCHA attribute is absent.
# For backward compatibility, set to false.
# At experimental stage, if any problems occur, set to false.
IsAttributeRequired=false


[CommonCAPTCHASettings]
# These settings have to be defined, no matter which image filter is used,
# they are used for other purposes than just generating token image itself

# Tokens can either be randomized, following the rules below this option,
# or can be taken from a dictionary. If dictionary fails to set a token,
# a fallback random mode will be used.
# Possible values: random, dictionary
TokenType=dictionary

# Number of character used in a token
TokenLength=5

# If enabled, upparcase characters will still be used in the images,
# but both lower and uppercase will pass the test
TokenUpperToLowerCase=enabled

# Token save format, jpg, gif and png are available
TokenFormat=jpg

# A set of unique chars that will be used to generate token images
# By default is avoids: D0oO, iIl
TokenCharset=345689QAXSWECVFRTGBLNHYUJMKPqazxswedcvfrtgbnhyujmkp

# If dictionary mode is chosen, here it is defined (semicolon separated)
TokenDictionary=kasza;zupka;fryty;pasta;rybka;banan;winko;piwko;kurak;miska;poncz;serek;serki;kumys;deser;zrazy;groch;grzyb;curry;ostro;flaki;rybna;ciasto;lipa;feta;cebula;kiwi;banan;mate;bekon;dieta;grill;keks;klops;krem;kokos;pianka;pesto;pory;ryba;steki;figi;szynka;zupy;oliwki;oliwa;zupa;tofu;trufle;sorbet;rukola;schab;tosty;soja;pizza;piwo;pasta;ragout;rzepa;rokpol;seler;uszka;zakwas;ziele;syrop;sarna;placki;gouda;nerki;panga;omlet;pekan;musaka;muskat;maliny


[DefaultFilterSettings]
# These settings are only used in the default token image filter
# If you add more filters, you may modify this block, but would be best
# practice to create a new ini block with a complete new set of params
# that your filter needs. 

# Token sizes
TokenWidth=200
TokenHeight=50

# Path to the fonts directory
TokenFontPath=design/standard/fonts/

# Array of TTF fonts that will be used to generate token images
# If more than one, fonts will be used at random per character
TokenFont[]=smartie.ttf
TokenFont[]=arial.ttf
TokenFont[]=archtura.ttf

# Path to the background image directory
TokenBackgroundPath=extension/ezhumancaptcha/design/standard/backgrounds/

# Array of background images that will be used to generate token images
# If more than one, fonts will be used at random per character
TokenBackgroundImage[]=capchar_blue.gif

# Font size
TokenFontSize=35

# Font rotation range, for example 50 means -25 to 25
TokenFontRotation=30

# Shift x and y position of each character
TokenFontShiftX=10
TokenFontShiftY=35



[CustomFilterSettings]
# Rename and use this block to setup your own image filters...


*/ ?>
