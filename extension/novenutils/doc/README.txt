Noven Utils
2009 Jerome Vieilledent - Noven

1/ Introduction
===============
This extension adds several template operators to the system :

- String operators (Must be used with pipe ("|") template syntax) :
  * espace_as_entities() => Does an "htmlentities" on the given string, taking the charset used into account.
  * split_words_in_parts($maxLength) => Splits too long words and adds one or more caesura character(s).
  * shorten_to_last_word($maxLength) => Cuts a string to $length characters and then cuts at the end of the last word. Also adds "..." to the cutted string

- Misc operators :
  * persistent_variable_append($key, $value, $mergeExisting=false) => Adds a value to the "persistent_variable" variable, available in node templates and in pagelayout when a node is displayed. 
    References :
      > http://ez.no/doc/ez_publish/technical_manual/4_x/templates/the_pagelayout/variables_in_pagelayout#module_result
      > http://ez.no/developer/forum/general/pass_variable_from_pagelayout/re_pass_variable_from_pagelayout
  * server_variable($name) => Returns the $_SERVER[$name] variable
  * session_set($variable, $value) => Sets a session variable from template
  * media_url($addQuotes='yes') => Adds a Media Host to an URL (useful if you want to host your media files - ie. css, js, contrib images... - on a different hostname)
      > Define your Media Host in novenutils.ini
      > In your templates, just add "|media_url" to your media URLs (ex.: <link type="text/css" rel="stylesheet" href={$css|ezroot|media_url} />)

2/ Install
==========
- Unpack the novenutils extension folder under extension/
- Activate novenutils in settings/override/site.ini.append.php
