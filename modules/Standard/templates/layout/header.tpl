
		<div class="header">
			
			<nav class="nav nav-pills pull-right">
				
				{* Navigation based on routing.json *}
				{foreach key=sKey item=aValue from=$aRouting}
				<li{if $sKey == $smarty.server.REQUEST_URI} class="active"{/if}>
					{if $aValue.title}<a href="{$sKey}">{$aValue.title}</a>{/if}
				</li>					
				{/foreach}
				
			</nav>
			
				<h3 class="text-muted">myMVC <small>[maɪ ɛm viː siː]</small></h3>
			
		</div>

		<hr />
