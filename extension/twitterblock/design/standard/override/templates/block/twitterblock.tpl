{def $twitter=$block.name}
{*
<script 
 src="http://twitterjs.googlecode.com/svn/trunk/src/twitter.min.js" 
 type="text/javascript">
</script>
*}

{ezcss_require( 'twitterblock.css' )}
<a  class='pollo'  href="http://twitter.com/{$twitter}"><img alt="" src={"twitter_newbird_blue.png"|ezimage}  height="40" width="40"/></a>
<div class="twitter-block clearFix" id="twitterpost">
	     <div id="tweet{$block.id}" class="balloon">
  
	{"Espere mientras se cargan los tweets"|i18n('design/standard/twitterblock')} <img alt="" src={"spinner.gif"|ezimage} /><br />
	 <!--a href="http://twitter.com/{$twitter}">{"If you can't wait - check out what I've been twittering"|i18n('design/standard/twitterblock')}</a-->

	</div>

</div>

<script type="text/javascript"> 
getTwitters('tweet{$block.id}', {ldelim} 
        id: '{$twitter}', 
        prefix: '', 
        clearContents: true, // leave the original message in place
        count: {ezini('TwitterBlock', 'Count', 'twitterblock.ini')}, 
        withFriends: true,
        ignoreReplies: false,
        newwindow: true
{rdelim});

</script>

{ezscript_require( 'twitter.min.js' )}

{undef $twitter}