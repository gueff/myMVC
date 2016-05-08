{* 

see /modules/InfoTool/doc/README
for more Info

*}
<style>
{literal}
	#myMvcToolbar h3 {color: #000;}
	#myMvcToolbar {
		position: fixed;
		bottom: -30px;
		left: -20px;		
		border: 1px solid silver;
		box-shadow: 0 0 10px 2px rgba(0, 0, 0, .15);		
	}
	#myMvcToolbar div,#myMvcToolbar ul, #myMvcToolbar li {
		background-color: white !important;
		font-family: monospace;
		font-size: 12px;
		font-weight: normal;
		color: #000;
	}
	#myMvcToolbar a {
		color: #303030;
	}	
	#myMvcToolbar textarea {
		border: none;
	}
	#myMvcToolbar pre, .myMvcToolbarToolbarDataBg {
		background-color: whitesmoke;
		border: none;
		line-height: 150%;
		padding: 20px;
	}	
	.myMvcToolbarDropUp {
		top: auto;
		bottom: 100% !important;
	}	
	#myMvcToolbar, #myMvcToolbar pre, .myMvcToolbarToolbarDataBg, .myMvcToolbarDropUp {
		line-height: 100%;
	}	
    .myMvcToolbarBlink {
		animation: myMvcToolbarBlink 1s steps(5, start) infinite;
		-webkit-animation: myMvcToolbarBlink 1s steps(5, start) infinite;
    }
    @keyframes myMvcToolbarBlink {
		to {
			visibility: hidden;
		}
    }
    @-webkit-keyframes myMvcToolbarBlink {
		to {
			visibility: hidden;
		}
    }
	
	.navbar, .navbar-collapse, .collapse, .collapse ul li a {
/*		height: 20px !important;
		border: 1px solid red !important;*/
	}	
{/literal}	
</style>
		


<div id="myMvcToolbar" class="navbar" role="navigation">
	<div class="container-fluid">
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				
				<div style="position: absolute;top: -20px;"><small>
					Env: {$aToolbar.sEnv} | PHP {$aToolbar.sPHP}, Operating System {$aToolbar.sOS}, Construction Time: {$aToolbar.sConstructionTime} s
				</small></div>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cubes"></i> Variables <span class="caret"></span></a>
					<ul class="dropdown-menu myMvcToolbarDropUp" 
						role="menu" 
						data-placement="auto" 
						style="width: 950px;height: 600px;padding: 20px;">

						<ul id="meinTab" class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#Variables1" role="tab" data-toggle="tab">$_GET</a></li>
							<li class=""><a href="#Variables2" role="tab" data-toggle="tab">$_POST</a></li>
							<li class=""><a href="#Variables3" role="tab" data-toggle="tab">$_COOKIE</a></li>
							<li class=""><a href="#Variables4" role="tab" data-toggle="tab">$_REQUEST</a></li>
							<li class=""><a href="#Variables5" role="tab" data-toggle="tab">$_SESSION</a></li>
							<li class=""><a href="#Variables8" role="tab" data-toggle="tab">$_SERVER</a></li>
							<li class=""><a href="#Variables7" role="tab" data-toggle="tab">Constants</a></li>
						</ul>
						<div class="tab-content" style="overflow: auto;width: 100%;height: 500px;">
							<div class="tab-pane active in" id="Variables1">
								<p>
									<br />unfiltered Values in $_GET:
								</p>
								<pre>{$aToolbar.aGet|@print_r:true|escape:'htmlall'}</pre>		
								<p>									
									to see filtered $_GET Values by myMVC, see [myMVC] => [MVC_Request::getQueryArrays]
								</p>
							</div>
							<div class="tab-pane" id="Variables2" style="overflow: auto;width: 100%;height: 500px;">
								<pre>{$aToolbar.aPost|@print_r:true|escape:'htmlall'}</pre>
							</div>
							<div class="tab-pane" id="Variables3" style="overflow: auto;width: 100%;height: 500px;">
								<pre>{$aToolbar.aCookie|@print_r:true|escape:'htmlall'}</pre>
							</div>
							<div class="tab-pane" id="Variables4" style="overflow: auto;width: 100%;height: 500px;">
								<pre>{$aToolbar.aRequest|@print_r:true|escape:'htmlall'}</pre>
							</div>
							<div class="tab-pane" id="Variables5" style="overflow: auto;width: 100%;height: 500px;">
								<pre>{$aToolbar.aSession|@print_r:true|escape:'htmlall'}</pre>
							</div>
							<div class="tab-pane" id="Variables7" style="overflow: auto;width: 100%;height: 500px;">
								<pre>{$aToolbar.aConstant|@print_r:true|escape:'htmlall'}</pre>
							</div>
							<div class="tab-pane" id="Variables8" style="overflow: auto;width: 100%;height: 500px;">
								<pre>{$aToolbar.aServer|@print_r:true|escape:'htmlall'}</pre>
							</div>
						</div>							
					</ul>
				</li>

				<li class="dropdown">
					<a id="menuMyMvc" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cube"></i> myMVC <span class="caret"></span></a>
					<ul class="dropdown-menu myMvcToolbarDropUp" 
						role="menu" 
						data-placement="auto" 
						style="width: 950px;height: 600px;padding: 20px;">

						<ul id="meinTab" class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#myMvc2" role="tab" data-toggle="tab">MVC_Request::getWhitelistParams</a></li>
							<li id="tabTest" class=""><a href="#myMvc1" role="tab" data-toggle="tab">MVC_Request::getQueryArray</a></li>
							<li class=""><a href="#myMvc3" role="tab" data-toggle="tab">MVC_Event</a></li>
							<li class=""><a href="#myMvc5" role="tab" data-toggle="tab">ROUTING</a></li>
							<li class=""><a href="#myMvc4" role="tab" data-toggle="tab">MVC_POLICY</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active in" id="myMvc2" style="overflow: auto;width: 100%;height: 500px;">
								<pre>{$aToolbar.oMvcRequestGetWhitelistParams|@print_r:true|escape:'htmlall'}</pre>	  
							</div>
							<div class="tab-pane" id="myMvc1" style="overflow: auto;width: 100%;height: 500px;">
								<pre>{$aToolbar.oMvcRequestGetQueryArray|@print_r:true|escape:'htmlall'}</pre>	  
							</div>
							<div class="tab-pane" id="myMvc3" style="overflow: auto;width: 100%;height: 500px;">
								<h3>BIND</h3>
								{if isset($aToolbar.aEvent.BIND)}
								{foreach key=key item=item from=$aToolbar.aEvent.BIND}
									BIND #<b>{$key}</b><pre class="prettyprint">{$item}</pre><br />
								{/foreach}
								{/if}

								<h3>RUN</h3>
								{if isset($aToolbar.aEvent.RUN)}
								{foreach key=key item=item from=$aToolbar.aEvent.RUN}
									RUN #<b>{$key}</b><pre class="prettyprint">{$item}</pre><br />
								{/foreach}
								{/if}

								{if isset($aToolbar.aEvent.RUN_BONDED)}
								<ul>
								{foreach key=key item=item from=$aToolbar.aEvent.RUN_BONDED}
									<li>RUN BONDED #<b>{$key}</b><pre class="prettyprint">{$item}</pre></li>
								{/foreach}
								</ul>
								{/if}
								
								<h3>UNBIND</h3>
								{if isset($aToolbar.aEvent.UNBIND)}
								{foreach key=key item=item from=$aToolbar.aEvent.UNBIND}
									UNBIND #<b>{$key}</b><pre class="prettyprint">{$item}</pre><br />
								{/foreach}
								{/if}
							</div>
							<div class="tab-pane" id="myMvc5" style="overflow: auto;width: 100%;height: 500px;">
								<table class="table table-striped table-bordered table-hover">
									<tr>
										<th>Path:</th>
										<td>{$aToolbar.aRouting.aRequest.path|escape:"htmlall":"UTF-8"}</td>
									</tr>
									{if isset($aToolbar.aRouting.aRequest.query)}
									<tr>
										<th>Query:</th>
										<td>{$aToolbar.aRouting.aRequest.query|unescape:"url"|escape:"htmlall":"UTF-8"}</td>
									</tr>
									{/if}
									<tr>
										<th>Target:</th>
										<td>\{$aToolbar.aRouting.sModule}\Controller\{$aToolbar.aRouting.sController}::{$aToolbar.aRouting.sMethod}({$aToolbar.aRouting.sArg|escape:"htmlall":"UTF-8"})	</td>
									</tr>
									<tr>
										<th>Routing:</th>
										<td><pre>{$aToolbar.aRouting.aRoute|@print_r|escape:"htmlall":"UTF-8"}</pre></td>
									</tr>
									<tr>
										<th>Routing JsonBuilder:</th>
										<td><pre>{$aToolbar.aRouting.sRoutingJsonBuilder|escape:"htmlall":"UTF-8"}</pre></td>
									</tr>
									<tr>
										<th>Routing Handling:</th>
										<td><pre>{$aToolbar.aRouting.sRoutingHandling|escape:"htmlall":"UTF-8"}</pre></td>
									</tr>
								</table>
							</div>							
							<div class="tab-pane" id="myMvc4" style="overflow: auto;width: 100%;height: 500px;">
								<h3>RULES</h3>
								<pre>{$aToolbar.aPolicy.aRule|@print_r:true|escape:'htmlall'}</pre>	
								<h3>APPLIED</h3>
								<b>{$aToolbar.aPolicy.sAppliedAt}</b><br />
								<pre>{$aToolbar.aPolicy.aApplied|@print_r:true|escape:'htmlall'}</pre>	
							</div>
						</div>						
					</ul>
				</li>	

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-code"></i> View <span class="caret"></span></a>					
					<ul class="dropdown-menu myMvcToolbarDropUp" 
						role="menu" 
						data-placement="auto" 
						style="width: 800px;max-height: 600px;padding: 20px;">

						<ul id="meinTab" class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#view1" role="tab" data-toggle="tab">Template</a></li>
							<li class=""><a href="#Variables6" role="tab" data-toggle="tab">Smarty Template Vars</a></li>							
							<li class=""><a href="#view2" role="tab" data-toggle="tab">Rendered</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active in" id="view1" style="overflow: auto;width: 100%;max-height: 500px;">
								<pre class="prettyprint">{$aToolbar.sTemplate|escape:'htmlall'}</pre>			  
								<pre class="prettyprint">{$aToolbar.sTemplateContent|escape:'htmlall'}</pre>			  
							</div>
							<div class="tab-pane" id="view2" style="overflow: auto;width: 100%;max-height: 500px;">
								<pre class="prettyprint">{$aToolbar.sRendered|escape:'htmlall'}</pre>	
							</div>
							<div class="tab-pane" id="Variables6" style="overflow: auto;width: 100%;height: 500px;">
								<pre>{$aToolbar.aSmartyTemplateVars|@print_r:true|escape:'htmlall'}</pre>
							</div>							
						</div>						
					</ul>
				</li>				

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-o"></i> Files <span class="caret"></span></a>
					<ul class="dropdown-menu myMvcToolbarDropUp" 
						role="menu" 
						data-placement="auto" 
						style="width: 800px;max-height: 600px;padding: 20px;">

						<ul id="meinTab" class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#Files1" role="tab" data-toggle="tab">Files loaded</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active in" id="Files1" style="overflow: auto;width: 100%;max-height: 500px;">
								<pre class="prettyprint">{foreach key=key item=item from=$aToolbar.aFilesIncluded}{$key} - {$item}
{/foreach}</pre>
							</div>
						</div>						
					</ul>
				</li>		

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bar-chart-o"></i> Memory <span class="caret"></span></a>
					<ul class="dropdown-menu myMvcToolbarDropUp" 
						role="menu" 
						data-placement="auto" 
						style="width: 400px;max-height: 300px;padding: 20px;">

						<ul id="meinTab" class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#Memory1" role="tab" data-toggle="tab">Memory</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active in myMvcToolbarToolbarDataBg" id="Memory1" style="overflow: auto;width: 100%;max-height: 200px;">
								<b>Real Memory Usage</b>: {$aToolbar.aMemory.iRealMemoryUsage} KB<br />
								<b>Memory Usage</b>: {$aToolbar.aMemory.dMemoryUsage} KB<br />
								<b>Memory Peak Usage</b>: {$aToolbar.aMemory.dMemoryPeakUsage} KB<br />
							</div>
						</div>							
					</ul>
				</li>		

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-key"></i> Registry <span class="caret"></span></a>
					<ul class="dropdown-menu myMvcToolbarDropUp" 
						role="menu" 
						data-placement="auto" 
						style="width: 800px;max-height: 600px;padding: 20px;">

						<ul id="meinTab" class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#Registry1" role="tab" data-toggle="tab">Registry</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active in" id="Registry1" style="overflow: auto;width: 100%;height: 500px;">
								<pre>{$aToolbar.aRegistry|@print_r:true|escape:'htmlall'}</pre> 
							</div>
						</div>						
					</ul>
				</li>		

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-refresh"></i> Cache <span class="caret"></span></a>
					<ul class="dropdown-menu myMvcToolbarDropUp" 
						role="menu" 
						data-placement="auto" 
						style="width: 800px;max-height: 600px;padding: 20px;">

						<ul id="meinTab" class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#Cache1" role="tab" data-toggle="tab">Cache</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active in" id="Cache1" style="overflow: auto;width: 100%;max-height: 500px;">
								<pre>{$aToolbar.aCache|@print_r:true|escape:'htmlall'}</pre>
							</div>
						</div>							
					</ul>
				</li>		

				{if !empty($aToolbar.aError)}
				<li class="dropdown bg-danger">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-warning myMvcToolbarBlink"></i> Error <span class="caret"></span></a>
					<ul class="dropdown-menu myMvcToolbarDropUp" 
						role="menu" 
						data-placement="auto" 
						style="width: 800px;max-height: 300px;padding: 20px;">

						<ul id="meinTab" class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#Error1" role="tab" data-toggle="tab">Last Error</a></li>
						</ul>
						<div class="tab-content myMvcToolbarToolbarDataBg">
							<div class="tab-pane active in" id="Error1" style="overflow: auto;width: 100%;max-height: 200px;">			
								{foreach key=key item=item from=$aToolbar.aError}
									<b>{$key}</b>: {$item}<br />
								{/foreach}
							</div>
						</div>								
					</ul>
				</li>		
				{/if}

				{if $aToolbar.oIds != ''}
				<li class="dropdown{if $aToolbar.oIds->getImpact () >= $aToolbar.aIdsConfig->config.General.impactThreshold} bg-danger{/if}">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						{if $aToolbar.oIds->getImpact () >= $aToolbar.aIdsConfig->config.General.impactThreshold}
							<i class="fa fa-shield myMvcToolbarBlink"></i> 
							{else}
							<i class="fa fa-check"></i> 
						{/if}
						{$aToolbar.oIds->getImpact ()}/{$aToolbar.aIdsConfig->config.General.impactThreshold}
						IDS <span class="caret"></span></a>
					<ul class="dropdown-menu myMvcToolbarDropUp" 
						role="menu" 
						data-placement="auto" 
						style="width: 700px;height: 400px;padding: 20px;">

						<ul id="meinTab" class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#IDS2" role="tab" data-toggle="tab">Config</a></li>
							<li class=""><a href="#IDS1" role="tab" data-toggle="tab">IDS</a></li>
							<li class=""><a href="#IDS3" role="tab" data-toggle="tab">Disposed</a></li>
							<li class=""><a href="#IDS4" role="tab" data-toggle="tab"><i>Help</i></a></li>
						</ul>
						<div class="tab-content myMvcToolbarToolbarDataBg">
							<div class="tab-pane" id="IDS1" style="overflow: auto;width: 100%;max-height: 250px;">
								Impact {$aToolbar.oIds->getImpact ()} while Threshold {$aToolbar.aIdsConfig->config.General.impactThreshold}.<br />
								{if $aToolbar.oIds->getImpact () >= $aToolbar.aIdsConfig->config.General.impactThreshold}
									<i class="fa fa-shield myMvcToolbarBlink"></i> <b>Threshold exceeded</b>							
									{else}
									<i class="fa fa-check"></i> Impact below Threshold value.
								{/if}								
								<hr />
								{$aToolbar.oIds}
							</div>
							<div class="tab-pane active in" id="IDS2" style="overflow: auto;width: 100%;max-height: 250px;">
								{foreach key=key item=item from=$aToolbar.aIdsConfig->config}
									<ul>
										<li>{$key|escape}</li> 
										<ul>
										{foreach key=key2 item=item2 from=$item}
											<li>{$key2|escape}: 
											{if is_array($item2)}
												{$item2|@print_r:true|escape:'htmlall'}
												{else}
												{$item2}
											{/if}
											</li> 											
										{/foreach}			
										</ul>
									</ul>
								{/foreach}								
							</div>	
							<div class="tab-pane" id="IDS3" style="overflow: auto;width: 100%;max-height: 250px;">
								{if !empty($aToolbar.aIdsDisposed)}
								{foreach key=key item=item from=$aToolbar.aIdsDisposed}
									<ul>
										<li>{$item|escape}</li> 
									</ul>
								{/foreach}				
								{else}
									nothing disposed
								{/if}
							</div>								
							<div class="tab-pane" id="IDS4" style="overflow: auto;width: 100%;max-height: 250px;">
								<h3>PHPIDS</h3>
								<ul>
									<li><a href="https://github.com/PHPIDS/PHPIDS">Project at GitHub</a></li>
									<li><a href="http://forum.itratos.de/forum.php">Forum</a></li>
								</ul>			
							</div>								
						</div>							
					</ul>
				</li>	
				{/if}

			</ul>
		</div>
	</div>
</div>	  
			
<script defer>
	
	{literal}
	/**
	 * vanilla js dom ready
	 * @see http://stackoverflow.com/a/13456810/2487859
	 */
	window.readyHandlers = [];
	window.ready = function ready(handler) {window.readyHandlers.push(handler); handleState();};
	window.handleState = function handleState () {if (['interactive', 'complete'].indexOf(document.readyState) > -1) {while(window.readyHandlers.length > 0) {(window.readyHandlers.shift())();}}};		
	document.onreadystatechange = window.handleState;

	/** 
	 * load jquery if not available
	 * @see http://stackoverflow.com/a/4686195/2487859
	 */
	!window.jQuery && document.write(unescape('%3Cscript src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"%3E%3C/script%3E'));
	
	ready(function () {		
		
		/**
		 * load bootstrap.js if not available
		 */
		if (false === (typeof $().emulateTransitionEnd == 'function'))
		{
			(function() {
				var newscript = document.createElement('script');
				newscript.type = 'text/javascript';newscript.async = true;
				newscript.src = '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js';
				(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(newscript);
			})();
		}
	
		// switch tabs on hover
		$('#myMvcToolbar .nav-tabs > li > a').hover( function(){
			$(this).tab('show');
		});		
		{/literal}
				
		// say Hello
		console.log('%cmyMVC %cInfoTool', 'color: blue;', 'color: red;');
		console.dir({$aToolbar|json_encode});
		{*
//		console.log(JSON.stringify({$aToolbar.aEvent|json_encode}));
//		console.log('{$aToolbar.aEvent}');
		*}
//		console.group("Variables");
//
//			console.group("$_GET");
//			console.table([{$aToolbar.aGet|json_encode}]);
//			console.groupEnd();
//
//			console.group("$_POST");
//			console.dir({$aToolbar.aPost|json_encode});
//			console.groupEnd();
//
//			console.group("$_COOKIE")
//			console.dir({$aToolbar.aCookie|json_encode});
//			console.groupEnd();
//
//			console.group("aRequest");
//			console.dir({$aToolbar.aRequest|json_encode});
//			console.groupEnd();
//
//			console.group("aSession");
//			console.dir({$aToolbar.aSession|json_encode});
//			console.groupEnd();
//
//			console.group("aSmartyTemplateVars");
//			console.dir({$aToolbar.aSmartyTemplateVars|json_encode});
//			console.groupEnd();
//
//			console.group("aConstant");
////			console.log(JSON.stringify({$aToolbar.aConstant|json_encode}));
//			console.dir({$aToolbar.aConstant|json_encode});
//			console.groupEnd();
//
//			console.group("sRendered");
//			console.table({$aToolbar.sRendered|json_encode});
//			console.groupEnd();
//
//			console.group("Memory");
//			console.table([{$aToolbar.aMemory|json_encode}]);
//			console.groupEnd();
//
//		console.groupEnd();		
	});
</script>
