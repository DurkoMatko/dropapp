	<div class="form-group">
		{if $element['indented']}<div class="col-sm-2"></div>{/if}
		<div class="col-sm-{if $element['width']>0 and $element['width']<11}{$element['width']}{else}6{/if}">
	 		<h2>{$element['label']}</h2>
			{if $element['tooltip']}{include file="cms_tooltip.tpl"}{/if}
		</div>
	</div>