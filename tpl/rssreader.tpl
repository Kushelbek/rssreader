<!-- BEGIN: MAIN -->
<div class="block">
<!-- BEGIN: RSS_BLOCK -->
	<div class="rsselem">
		<h5>
			<a rel="nofollow noindex" target="_blank" href="{RSS_LINK}" title="{RSS_TITLE}">{RSS_TITLE}</a>
			<span class="small pull-right">[ {RSS_DATESTAMP|cot_date('date_text', $this)} ]</span>
		</h5>
		<p>{RSS_DESCRIPTION|cot_string_truncate($this, 160, 1, 0, '...')}</p>
	</div>
<!-- END: RSS_BLOCK -->
	<div class="small text-right"><a rel="nofollow" href="{RSS_INFO_LINK}" title="{RSS_INFO_TITLE}">{RSS_INFO_TITLE}</a></div>
</div>
<!-- END: MAIN -->