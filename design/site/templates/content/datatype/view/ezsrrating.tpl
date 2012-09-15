{def $rating = $attribute.content}

<ul id="ezsr_rating_{$attribute.id}" class="ezsr-star-rating frt">
   <li id="ezsr_rating_percent_{$attribute.id}" class="ezsr-current-rating" style="width:{$rating.rounded_average|div(5)|mul(100)}%;">{'Currently %current_rating out of 5 Stars.'|i18n('extension/ezstarrating/datatype', '', hash( '%current_rating', concat('<span>', $rating.rounded_average|wash, '</span>') ))}</li>
   {for 1 to 5 as $num}
       <li><a href="JavaScript:void(0);" id="ezsr_{$attribute.id}_{$attribute.version}_{$num}" title="{$num} sobre 5" class="ezsr-stars-{$num}" rel="nofollow" onfocus="this.blur();">{$num}</a></li>
   {/for}
</ul>
{run-once}
{ezcss_require( 'star_rating.css' )}


{if and( $attribute.data_int|not, has_access_to_limitation( 'ezjscore', 'call', hash( 'FunctionList', 'ezstarrating_rate' ) ))}
    {*
       eZStarRating supports both yui3.0 and jQuery as decided by ezjscore.ini[eZJSCore]PreferredLibrary
       For the JavaScript code look in: design/standard/javascript/ezstarrating_*.js

       (This dual approach is not something you need to do in your extensions, but currently a service done on official extensions for now!)
    *}
    {def $preferred_lib = ezini('eZJSCore', 'PreferredLibrary', 'ezjscore.ini')}
    {if array( 'yui3', 'jquery' )|contains( $preferred_lib )|not()}
        {* Prefer jQuery if something else is used globally, since it's smaller then yui3. *}
        {set $preferred_lib = 'jquery'}
    {/if}
    {ezscript_require( array( concat( 'ezjsc::', $preferred_lib ), concat( 'ezjsc::', $preferred_lib, 'io' ), concat( 'ezstarrating_', $preferred_lib, '.js' ) ) )}
{else}
    {if ezmodule( 'user/register' )}
        <p id="ezsr_no_permission_{$attribute.id}" class="ezsr-no-permission">{'%login_link_startLog in%login_link_end or %create_link_startcreate a user account%create_link_end to rate this page.'|i18n( 'extension/ezstarrating/datatype', , hash( '%login_link_start', concat( '<a href="', '/user/login'|ezurl('no'), '">' ), '%login_link_end', '</a>', '%create_link_start', concat( '<a href="', "/user/register"|ezurl('no'), '">' ), '%create_link_end', '</a>' ) )}</p>
    {else}
        <p id="ezsr_no_permission_{$attribute.id}" class="ezsr-no-permission">{'%login_link_startLog in%login_link_end to rate this page.'|i18n( 'extension/ezstarrating/datatype', , hash( '%login_link_start', concat( '<a href="', '/user/login'|ezurl('no'), '">' ), '%login_link_end', '</a>' ) )}</p>
    {/if}
{/if}
{/run-once}
{undef $rating}