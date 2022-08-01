{*
colors
---------
blue: hsl(210,50%,50%)
*}

{* value for css automatic generation parts *}
{$iStyleIteration=81}
<style>
{literal}
#myMvcToolbar {/* div */
	position: fixed !important;
	bottom: 0px;
	left: 0px;
	font-family: monospace, monospace;
	display: none;
	z-index: 9999999999 !important;
}
#myMvcToolbar * {
	box-sizing: unset !important;
}
#myMvcToolbar navi label, #myMvcToolbar figure {
	font-size: 12px;
	box-sizing: unset !important;
}
#myMvcToolbar_head {/* div */
	position: fixed;
	bottom: 43px;
	left: 0px;
	min-width: 600px;
	font-size: 12px;
	z-index: -1;
}
#myMvcToolbar_head span {
	font-family: monospace, monospace;
	font-size: 10px;
	background-color: antiquewhite;
}
figure h1,figure h2, figure h3, figure h4, figure h5, figure h6 {
	font-family: monospace, monospace !important;
	border-bottom: 1px solid silver;
}
figure h6 {
	font-weight: bold;
}
pre.prettyprint {
	font-size: 12px !important;
}
.myMvcToolbar-float-right {
	float: right;
}
.myMvcToolbar-tree {
	overflow-wrap: break-word !important;
	word-wrap: break-word !important;
	hyphens: auto !important;
}
.myMvcToolbar-bg-info {
	background-color: darkgray !important;
}
.myMvcToolbar-bg-primary {
	background-color: hsl(210,50%,50%) !important;
	border-radius: 3px;
	color: white !important;
	padding: 2px;
}
.myMvcToolbar-bg-danger {
	background-color: darkred !important;
	color: white !important;
}
.myMvcToolbar-bg-kbd {
	background-color: #333 !important;
	border-radius: 3px;
	color: white !important;
	padding: 10px;
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
/*******************************************************************/

#myMvcToolbar figure {
	display: block;
	clear: both;
}

#myMvcToolbar > input,
#myMvcToolbar figure > div {
	height: 100%;
	display: none;
}

#myMvcToolbar figure > div {
	width: 100%;
	line-height: 1.5em;
	letter-spacing: 0.3px;
	color: #333;
	background-color: transparent;
	margin: 0 0 125px 0px;
}

navi label:nth-child(1) { border-left: 1px solid silver; }
navi label:hover { background: hsl(210,50%,40%); }
navi label:active { background: whitesmoke; }

navi label {
	float: left;
	padding: 15px 15px;
	border-top: 1px solid silver;
	border-right: 1px solid silver;
	background: hsl(210,50%,50%);
	color: #eee;
	cursor: pointer;
	margin: 0;
	font-size: 16px;
	line-height: 1;
}

/**
 main menu
 */
.tab1, .tab2, .tab3, .tab4, .tab6, .tab7, .tab8 {height: 600px !important;}
/*.tab7 {height: 300px !important;}*/
.tab5 {height: 100px !important;}
.tab8 {height: 600px !important;}

{/literal}
{section name=columns start=0 step=1 loop=$iStyleIteration}
#tab{$smarty.section.columns.iteration}:checked ~ figure .tab{$smarty.section.columns.iteration},
{/section}
{literal}
#tab99:checked ~ figure .tab99 {
	display: block;
}

{/literal}
{section name=columns start=0 step=1 loop=$iStyleIteration}
#tab{$smarty.section.columns.iteration}:checked ~ navi label[for="tab{$smarty.section.columns.iteration}"],
{/section}
{literal}
#tab99:checked ~ navi label[for="tab99"] {
	background: whitesmoke;
	color: #111;
	position: relative;
	border-bottom: none;
}

{/literal}
{section name=columns start=0 step=1 loop=$iStyleIteration}
#tab{$smarty.section.columns.iteration}:checked ~ navi label[for="tab{$smarty.section.columns.iteration}"]:after,
{/section}
{literal}
#tab99:checked ~ navi label[for="tab99"]:after {
	content: "";
	display: block;
	position: absolute;
	height: 2px;
	width: 100%;
	background: whitesmoke;
	left: 0;
	bottom: -1px;
}

/**
 sub menu
 */
#myMvcToolbar figure div input {
	height: 100%;
	display: none;
}
#myMvcToolbar figure div figure {
	display: block;
	width: 800px;
	height: 100%;
	padding: 20px;
	box-shadow: 0 0 10px 2px rgba(0, 0, 0, .15);
	overflow: auto;
	background-color: whitesmoke;
}

{/literal}
{section name=columns start=0 step=1 loop=$iStyleIteration}
#subtab{$smarty.section.columns.iteration}:checked ~ figure .subtab{$smarty.section.columns.iteration},
{/section}
{literal}
#subtab99:checked ~ figure .subtab99 {
	display: block;
}

{/literal}
{section name=columns start=0 step=1 loop=$iStyleIteration}
#subtab{$smarty.section.columns.iteration}:checked ~ navi label[for="subtab{$smarty.section.columns.iteration}"],
{/section}
{literal}
#subtab99:checked ~ navi label[for="subtab99"] {
	background: whitesmoke;
	color: #111;
	position: relative;
	border-bottom: none;
}

{/literal}
{section name=columns start=0 step=1 loop=$iStyleIteration}
#subtab{$smarty.section.columns.iteration}:checked ~ navi label[for="subtab{$smarty.section.columns.iteration}"]:after,
{/section}
{literal}
#subtab99:checked ~ navi label[for="subtab99"]:after {
	content: "";
	display: block;
	position: absolute;
	height: 2px;
	width: 100%;
	background: whitesmoke;
	left: 0;
	bottom: -1px;
}

{/literal}
</style>

<div id="myMvcToolbar">
	<div id="myMvcToolbar_head">
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
						<li><a href="#myMvcToolbar_getQueryArray">MVC_Request::getQueryArray</a></li>
						<li><a href="#myMvcToolbar_getwhitelistParams">MVC_Request::getwhitelistParams</a></li>
					</ul>

					<h6>MVC_Request::getQueryArray <a name="myMvcToolbar_getQueryArray"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>{$aToolbar.oMvcRequestGetQueryArray}</p>
					<h6>MVC_Request::getwhitelistParams <a name="myMvcToolbar_getwhitelistParams"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
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

	function getOffset(oElement) {
		var rect = oElement.getBoundingClientRect(),
				scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
				scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
	}

	document.getElementById("myMvcToolbar").addEventListener("click", function(oEvent){
		oEvent.stopPropagation();
	});

	document.getElementById("myMvcToolbar_toggle").addEventListener("click", function(oEvent){

		var oCoords = getOffset(this);
		document.getElementById("myMvcToolbar_head").style.left = "-" + oCoords.left + "px";
		document.getElementById("myMvcToolbar").style.left = "-" + oCoords.left + "px";
		localStorage.setItem("myMvcToolbar_toggle", oCoords.left);
	});

	window.addEventListener('click', function (evt) {
		for (var i = 1; i < 10; i++) {
			var oElement = document.getElementById('tab' + i);
			if (null !== oElement) {
				oElement.checked = false;
			}
		}
	});

	ready(function () {

		console.log('%cmyMVC %cInfoTool', 'color: blue;', 'color: red;');
		console.dir({/literal}{$aToolbar|json_encode}{literal});

		var fMyMvcToolbar_toggle = localStorage.getItem('myMvcToolbar_toggle');
		if (null === fMyMvcToolbar_toggle) {
			localStorage.setItem("myMvcToolbar_toggle", 0);
			fMyMvcToolbar_toggle = 0;
		}

		document.getElementById("myMvcToolbar").style.display = "block";
		document.getElementById("myMvcToolbar_head").style.display = "block";
		document.getElementById("myMvcToolbar").style.left = "-" + localStorage.getItem('myMvcToolbar_toggle') + "px";
		document.getElementById("myMvcToolbar_head").style.left = "-" +localStorage.getItem('myMvcToolbar_toggle') + "px";
	});
	{/literal}
</script>
