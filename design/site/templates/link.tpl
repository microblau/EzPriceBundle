{default enable_print=true()}

<link rel="Home" href={"/"|ezurl} title="{'%sitetitle front page'|i18n('design/ezwebin/link',,hash('%sitetitle',$site.title))|wash}" />
<link rel="Index" href={"/"|ezurl} />
<link rel="Top"  href={"/"|ezurl} title="Ediciones Francis Lefebvre" />
<link rel="Search" href={"content/advancedsearch"|ezurl} title="{'Search %sitetitle'|i18n('design/ezwebin/link',,hash('%sitetitle',$site.title))|wash}" />
<link rel="Shortcut icon" href="/favicon.ico" />
<link rel="Copyright" href={"/ezinfo/copyright"|ezurl} />
<link rel="Author" href={"/ezinfo/about"|ezurl} />
{*
{$pagedesign.data_map|attribute(show)}
{if and( is_set($pagedesign), $pagedesign.data_map.rss_feed.has_content )}
<link rel="Alternate" type="application/rss+xml" title="RSS" href="{$pagedesign.data_map.rss_feed.data_text|ezurl(no)}" />
{/if}*}
{if is_set( ezpagedata().persistent_variable.rss) }
<link rel="Alternate" type="application/rss+xml" title="RSS" href="{concat( 'feeds/', ezpagedata().persistent_variable.rss )|ezurl(no)}" />
{/if}
{/default}