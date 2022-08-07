{*
colors
---------
blue: hsl(210,50%,50%)
*}

{* value for css automatic generation parts *}
{$iStyleIteration=81}
<link href="/myMVC/styles/myMVCInfoTool.min.css" rel="stylesheet" type="text/css">
<style>
{section name=columns start=0 step=1 loop=$iStyleIteration}
	#tab{$smarty.section.columns.iteration}:checked ~ figure .tab{$smarty.section.columns.iteration},
{/section}
{literal}
#tab99:checked ~ figure .tab99 {display: block;}
{/literal}
{section name=columns start=0 step=1 loop=$iStyleIteration}
	#tab{$smarty.section.columns.iteration}:checked ~ navi label[for="tab{$smarty.section.columns.iteration}"],
{/section}
{literal}
#tab99:checked ~ navi label[for="tab99"] {background: whitesmoke;color: #111;position: relative;border-bottom: none;}
{/literal}
{section name=columns start=0 step=1 loop=$iStyleIteration}
	#tab{$smarty.section.columns.iteration}:checked ~ navi label[for="tab{$smarty.section.columns.iteration}"]:after,
{/section}
{literal}
#tab99:checked ~ navi label[for="tab99"]:after {content: "";display: block;position: absolute;height: 2px;width: 100%;background: whitesmoke;left: 0;bottom: -1px;}
/**
 sub menu
 */
{/literal}
{section name=columns start=0 step=1 loop=$iStyleIteration}
	#subtab{$smarty.section.columns.iteration}:checked ~ figure .subtab{$smarty.section.columns.iteration},
{/section}
{literal}
#subtab99:checked ~ figure .subtab99 {display: block;}
{/literal}
{section name=columns start=0 step=1 loop=$iStyleIteration}
	#subtab{$smarty.section.columns.iteration}:checked ~ navi label[for="subtab{$smarty.section.columns.iteration}"],
{/section}
{literal}
#subtab99:checked ~ navi label[for="subtab99"] {background: whitesmoke;color: #111;position: relative;border-bottom: none;}
{/literal}
{section name=columns start=0 step=1 loop=$iStyleIteration}
	#subtab{$smarty.section.columns.iteration}:checked ~ navi label[for="subtab{$smarty.section.columns.iteration}"]:after,
{/section}
{literal}
#subtab99:checked ~ navi label[for="subtab99"]:after {content: "";display: block;position: absolute;height: 2px;width: 100%;background: whitesmoke;left: 0;bottom: -1px;}
{/literal}
</style>
<div id="myMvcToolbar" class="myMvcToolbar_expand">
	<div id="myMvcToolbar_head" class="myMvcToolbar_expand">
		<span>PHP {$aToolbar.sPHP}, Operating System {$aToolbar.sOS}, Construction Time: {$aToolbar.sConstructionTime} s</span>
		<br>
		<span>myMVC: {$aToolbar.sMyMvcVersion}, MVC_ENV: {$aToolbar.sEnv}, MVC_UNIQUE_ID: {$aToolbar.sUniqueId}, session_id(): {$aToolbar.session_id}</span>
	</div>

	<!-- invisible action detection -->
	<input id="tab1" type="radio" name="tabs" />
	<input id="tab2" type="radio" name="tabs" />
	<input id="tab3" type="radio" name="tabs" />
	<input id="tab4" type="radio" name="tabs" />
	<input id="tab5" type="radio" name="tabs" />
	<input id="tab6" type="radio" name="tabs" />
	<input id="tab7" type="radio" name="tabs" />
	<input id="tab8" type="radio" name="tabs" />

	<!-- content -->
	<figure>
		<div class="tab1">

			<!-- invisible action detection -->
			<input id="subtab11" type="radio" name="subtabs1" checked="checked" />
			<input id="subtab12" type="radio" name="subtabs1" />
			<input id="subtab13" type="radio" name="subtabs1" />
			<input id="subtab14" type="radio" name="subtabs1" />
			<input id="subtab15" type="radio" name="subtabs1" />
			<input id="subtab16" type="radio" name="subtabs1" />
			<input id="subtab17" type="radio" name="subtabs1" />
			<input id="subtab18" type="radio" name="subtabs1" />

			<!-- menu -->
			<navi>
				<label for="subtab11">$_GET</label>
				<label for="subtab12">$_POST</label>
				<label for="subtab13">$_COOKIE</label>
				<label for="subtab14">$_REQUEST</label>
				<label for="subtab15">Session</label>
				<label for="subtab16">$_SERVER</label>
				<label for="subtab17">$_ENV</label>
				<label for="subtab18">Constants</label>
			</navi>

			<!-- content -->
			<figure>

				<a name="myMvcToolbar_top"></a>

				<div class="subtab11">
					<p>
						{$aToolbar.aGet}
					</p>
				</div>
				<div class="subtab12">{$aToolbar.aPost}</div>
				<div class="subtab13">{$aToolbar.aCookie}</div>
				<div class="subtab14">{$aToolbar.aRequest}</div>
				<div class="subtab15">
					<h6>Overview</h6>
					<ul>
						<li><a href="#myMvcToolbar_Session_KeyValues">$_SESSION Key/Values</a></li>
						<li><a href="#myMvcToolbar_Session_Settings">Session Settings</a></li>
						<li><a href="#myMvcToolbar_Session_Files">Session Files</a></li>
					</ul>

					<h6>$_SESSION Key/Values <a name="myMvcToolbar_Session_KeyValues"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aSessionKeyValues}
					</p>

					<h6>Session Settings <a name="myMvcToolbar_Session_Settings"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aSessionSettings}
					</p>

					<h6>Session Files <a name="myMvcToolbar_Session_Files"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aSessionFiles}
					</p>
				</div>
				<div class="subtab16">{$aToolbar.aServer}</div>
				<div class="subtab17">{$aToolbar.aEnv}</div>
				<div class="subtab18">{$aToolbar.aConstant}</div>
			</figure>

		</div>
		<div class="tab2">

			<!-- invisible action detection -->
			<input id="subtab24" type="radio" name="subtabs2" checked="checked" />
			<input id="subtab25" type="radio" name="subtabs2" />
			<input id="subtab23" type="radio" name="subtabs2" />
			<input id="subtab22" type="radio" name="subtabs2" />
			<input id="subtab21" type="radio" name="subtabs2" />

			<!-- menu -->
			<navi>
				<label for="subtab24">ROUTING</label>
				<label for="subtab25">MVC_POLICY</label>
				<label for="subtab23">MVC_Event</label>
				<label for="subtab22">MVC_Request</label>
				<label for="subtab21">MVC_CORE</label>
			</navi>

			<!-- content -->
			<figure>

				<a name="myMvcToolbar_top2"></a>

				<div class="subtab21">
					<p>
						{$aToolbar.sMyMVCCore}
					</p>
				</div>
				<div class="subtab22">
					<h6>Overview</h6>
					<ul>
						<li><a href="#myMvcToolbar_getQueryArray">\MVC\Request::getInstance()->getQueryArray()</a></li>
						<li><a href="#myMvcToolbar_getwhitelistParams">\MVC\Request::getInstance()->getwhitelistParams()</a></li>
					</ul>

					<h6>\MVC\Request::getInstance()->getQueryArray() <a name="myMvcToolbar_getQueryArray"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>{$aToolbar.oMvcRequestGetQueryArray}</p>
					<h6>\MVC\Request::getInstance()->getwhitelistParams() <a name="myMvcToolbar_getwhitelistParams"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>{$aToolbar.oMvcRequestGetWhitelistParams}</p>
				</div>
				<div class="subtab23">
					<h6>Overview</h6>
					<ul>
						<li><a href="#myMvcToolbar_BINDindex">BIND <small>list by index</small></a></li>
						<li><a href="#myMvcToolbar_BINDname">BIND <small>group by event name</small></a></li>
						<li><a href="#myMvcToolbar_RUN">RUN</a></li>
						<li><a href="#myMvcToolbar_UNBIND">UNBIND</a></li>
					</ul>

					<h6>BIND <small>list by index</small> <a name="myMvcToolbar_BINDindex"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aEventBIND}
					</p>

					<h6>BIND <small>group by event name</small> <a name="myMvcToolbar_BINDname"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aEventBINDNAME}
					</p>

					<h6>RUN <a name="myMvcToolbar_RUN"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aEventRUN}
					</p>

					{if !empty($aToolbar.aEventRUNBONDED)}
					<p>
						<b>BONDED</b><br>
						{$aToolbar.aEventRUNBONDED}
					</p>
					{/if}

					<h6>UNBIND <a name="myMvcToolbar_UNBIND"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					{if !empty($aToolbar.aEventUNBIND)}
						<p>
							{$aToolbar.aEventUNBIND}
						</p>
					{/if}
				</div>
				<div class="subtab24">

					<h6>Path <a name="myMvcToolbar_Path"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>{$aToolbar.sRoutingPath|escape:"htmlall":"UTF-8"}</p>

					{if '' !== $aToolbar.sRoutingQuery}
					<h6>Query <a name="myMvcToolbar_Query"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>{$aToolbar.sRoutingQuery|unescape:"url"|escape:"htmlall":"UTF-8"}</p>
					{/if}

					<h6>Routing <a name="myMvcToolbar_Routing"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>{$aToolbar.aRouting.aRoute}</p>

					<h6>Target <a name="myMvcToolbar_Target"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>\{$aToolbar.aRouting.sModule}\Controller\{$aToolbar.aRouting.sController}::{$aToolbar.aRouting.sMethod}({$aToolbar.aRouting.sArg|escape:"htmlall":"UTF-8"})	</p>

					<h6>Routing JsonBuilder <a name="myMvcToolbar_Routing_JsonBuilder"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>{$aToolbar.aRouting.sRoutingJsonBuilder|escape:"htmlall":"UTF-8"}</p>

					<h6>Routing Handling <a name="myMvcToolbar_Routing_Handling"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>{$aToolbar.aRouting.sRoutingHandling|escape:"htmlall":"UTF-8"}</p>
				</div>
				<div class="subtab25">
					<h6>Overview</h6>
					<ul>
						<li><a href="#myMvcToolbar_RULES">POLICY RULES</a></li>
						<li><a href="#myMvcToolbar_APPLIED">POLICY RULES APPLIED</a></li>
					</ul>

					<h6>POLICY RULES <a name="myMvcToolbar_RULES"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aPolicy.aRule}
					</p>
					<h6>POLICY RULES APPLIED <a name="myMvcToolbar_APPLIED"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>
						<b>{$aToolbar.aPolicy.sAppliedAt}</b><br />
						{$aToolbar.aPolicy.aApplied}
					</p>
				</div>
			</figure>
		</div>
		<div class="tab3">

			<!-- invisible action detection -->
			<input id="subtab31" type="radio" name="subtabs3" checked="checked" />
			<input id="subtab32" type="radio" name="subtabs3" />
			<input id="subtab33" type="radio" name="subtabs3" />

			<!-- menu -->
			<navi>
				<label for="subtab31">Template</label>
				<label for="subtab32">Smarty Template Vars</label>
				<label for="subtab33">Rendered</label>
			</navi>

			<!-- content -->
			<figure style="width: 1000px;">

				<a name="myMvcToolbar_top"></a>

				<div class="subtab31">
					<h6>Template File</h6>
					<p>
						{$aToolbar.sTemplate|replace:$aToolbar.aRegistry.MVC_VIEW_TEMPLATES:''|escape:'htmlall'}
					</p>
					<h6>Template Folder</h6>
					<p>
						{$aToolbar.aRegistry.MVC_VIEW_TEMPLATES|escape:'htmlall'}
					</p>
					<h6>Template Content</h6>
					<!-- @see https://www.w3schools.com/howto/tryit.asp?filename=tryhow_syntax_highlight -->
					<pre class="prettyprint">{$aToolbar.sTemplateContent|escape:'htmlall'}</pre>
				</div>
				<div class="subtab32">{$aToolbar.aSmartyTemplateVars}</div>
				<div class="subtab33"><pre class="prettyprint"><code class="html">{$aToolbar.sRendered|escape:'htmlall'}</code></pre></div>
			</figure>
		</div>
		<div class="tab4">

			<!-- invisible action detection -->
			<input id="subtab41" type="radio" name="subtabs4" checked="checked" />

			<!-- menu -->
			<navi>
				<label for="subtab41">Files loaded</label>
			</navi>

			<!-- content -->
			<figure>

				<a name="myMvcToolbar_top"></a>

				<div class="subtab41">
					<h6>MVC_BASE_PATH</h6>
					<p>
						{$aToolbar.aRegistry.MVC_BASE_PATH|escape:'htmlall'}
					</p>
					<h6>Files</h6>
					<ol class="prettyprint">
						{foreach key=key item=item from=$aToolbar.aFilesIncluded}
							<li>{$item|replace:$aToolbar.aRegistry.MVC_BASE_PATH:''|escape:'htmlall'}</li>
						{/foreach}
					</ol>
				</div>
			</figure>
		</div>
		<div class="tab5">

			<!-- invisible action detection -->
			<input id="subtab51" type="radio" name="subtabs5" checked="checked" />

			<!-- menu -->
			<navi>
				<label for="subtab51">Files loaded</label>
			</navi>

			<!-- content -->
			<figure>

				<a name="myMvcToolbar_top"></a>

				<div class="subtab51">
					<b>Real Memory Usage</b>: {$aToolbar.aMemory.iRealMemoryUsage} KB<br />
					<b>Memory Usage</b>: {$aToolbar.aMemory.dMemoryUsage} KB<br />
					<b>Memory Peak Usage</b>: {$aToolbar.aMemory.dMemoryPeakUsage} KB<br />
				</div>
			</figure>
		</div>
		<div class="tab6">

			<!-- invisible action detection -->
			<input id="subtab61" type="radio" name="subtabs6" checked="checked" />

			<!-- menu -->
			<navi>
				<label for="subtab61">Registry</label>
			</navi>

			<!-- content -->
			<figure style="width: 1000px;">

				<a name="myMvcToolbar_top"></a>

				<div class="subtab61">{$aToolbar.sRegistry}</div>
			</figure>
		</div>
		<div class="tab7">

			<!-- invisible action detection -->
			<input id="subtab71" type="radio" name="subtabs7" checked="checked" />

			<!-- menu -->
			<navi>
				<label for="subtab71">Cache</label>
			</navi>

			<!-- content -->
			<figure>

				<a name="myMvcToolbar_top"></a>

				<div class="subtab71">
					<h6>Cache Folder</h6>
					<p>
						{$aToolbar.aRegistry.MVC_CACHE_DIR}
					</p>
					<h6>Cache Files</h6>
					<p>
						{$aToolbar.aCache}
					</p>
				</div>
			</figure>
		</div>
		<div class="tab8">

			<!-- invisible action detection -->
			<input id="subtab81" type="radio" name="subtabs8" checked="checked" />

			<!-- menu -->
			<navi>
				<label for="subtab81">Error</label>
			</navi>

			<!-- content -->
			<figure>

				<a name="myMvcToolbar_top"></a>

				<div class="subtab81">
					<ul>
					{foreach key=key item=oDTArrayObject from=$aToolbar.aError}
						{assign var="_sErrorTime" value="."|explode:$oDTArrayObject->getDTKeyValueByKey('_sErrorTime')->get_sValue()}
						<li>
							<b>{$key}: {$oDTArrayObject->getDTKeyValueByKey('sMessage')->get_sValue()}</b>
							<span class="myMvcToolbar-float-right">
								🕑{$oDTArrayObject->getDTKeyValueByKey('_sErrorTime')->get_sValue()|date_format:"%Y-%m-%d, %T"}.{$_sErrorTime[1]}
							</span>
							<hr>
							<pre class="myMvcToolbar-bg-kbd">{$oDTArrayObject->getDTKeyValueByKey('oException')->get_sValue()}</pre>
						</li>
					{/foreach}
					</ul>
				</div>
			</figure>
		</div>
	</figure>

	<!-- Main menu -->
	<navi>
		<label for="tab2">
			<i class="fa fa-cube"></i> myMVC
		</label>
		<label for="tab1">
			<i class="fa fa-cubes"></i> Variables
		</label>
		<label for="tab3">
			<i class="fa fa-code"></i> View
		</label>
		<label for="tab6">
			<i class="fa fa-key"></i> Registry
		</label>
		<label for="tab7">
			<i class="fa fa-refresh"></i> Cache
		</label>
		<label for="tab4">
			<i class="fa fa-file-o"></i> Files
		</label>
		<label for="tab5">
			<i class="fa fa-bar-chart-o"></i> Memory
		</label>
		{if !empty($aToolbar.aError)}
		<label for="tab8" class="myMvcToolbar-bg-danger">
			<i class="fa fa-warning myMvcToolbarBlink"></i> Error
		</label>
		{/if}
		<label id="myMvcToolbar_toggle" class="myMvcToolbar-bg-info" title="toggle"><b>&larr;&rarr;</b></label>
	</navi>
</div>
<script src="/myMVC/scripts/myMVCInfoTool.min.js" type="text/javascript"></script>
<script defer>
	{literal}
	ready(function () {

		console.log('%cmyMVC %cInfoTool', 'color: blue;', 'color: red;');
		console.dir({/literal}{$aToolbar|json_encode|strip_tags}{literal});
		var fMyMvcToolbar_toggle = localStorage.getItem('myMvcToolbar_toggle');

		if (null === fMyMvcToolbar_toggle) {
			localStorage.setItem("myMvcToolbar_toggle", 657);
			fMyMvcToolbar_toggle = 0;
		}

		var iLeft = localStorage.getItem('myMvcToolbar_toggle');
		localStorage.setItem("myMvcToolbar_toggle", parseInt(iLeft));
		(iLeft < 0) ? iLeft = 0 : false;
		{/literal}
		{if empty($aToolbar.aError)}
		(iLeft > 658) ? iLeft = 0 : false;
		{/if}
		{literal}

		if (parseInt(iLeft) > 0){setExpand();}else{setShrink();}
		document.getElementById('myMvcToolbar').style.display = 'block';
	});
	{/literal}
</script>
