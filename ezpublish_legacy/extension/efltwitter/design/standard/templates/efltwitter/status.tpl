<div class="border-box">
<div class="border-tl"><div class="border-tr"><div class="border-tc"></div></div></div>
<div class="border-ml"><div class="border-mr"><div class="border-mc float-break">

<div class="content-view-full">
    <div class="class-twitter">
        <div class="attribute-header">
            <h1>Twitter</h1>
        </div>
        {def $items = fetch( "efltwitter", "getUserTimeline", hash('limit', 15 ) ) }
        {foreach $items as $item}
        <div class="twitter-status">
            <p class="twitter-status-text">{$item.text}</p>
            <p><span class="twitter-status-source">{'From'|i18n('twitter')} {$item.source},</span> <span class="twitter-status-source">{$item.timestamp|l10n(shortdatetime)}</span></p>
        </div>
        {/foreach}
    </div>
</div>

</div></div></div>
<div class="border-bl"><div class="border-br"><div class="border-bc"></div></div></div>
</div>