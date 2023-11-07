{*
application/library/MVC/templates/infoTool.tpl

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
	{literal}
	#myMvcToolbar pre {background-color: lightgray; font-family: monospace, monospace; padding: 2px 5px; border: 1px dashed #333}
	{/literal}
</style>
<div id="myMvcToolbar" class="myMvcToolbar_expand">
	<div id="myMvcToolbar_head" class="myMvcToolbar_expand">
		<span>
			PHP {$aToolbar.sPHP}, Operating System {$aToolbar.sOS}, {$aToolbar.sEnvOfRequest}, Construction Time: {$aToolbar.sConstructionTime} s,
			<a href="https://mymvc.ueffing.net/" target="_blank">Documentation</a>
		</span>
		<br>
		<span>{$aToolbar.sMyMvcVersion}, MVC_ENV={$aToolbar.sEnv}, MVC_UNIQUE_ID={$aToolbar.sUniqueId}, session_id()={$aToolbar.session_id}</span>
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
				<label for="subtab17">Environment</label>
				<label for="subtab18">Constants</label>
			</navi>

			<!-- content -->
			<figure>

				<a id="myMvcToolbar_top"></a>

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
						<li><a href="#myMvcToolbar_Session_Status">Session Status</a></li>
						<li><a href="#myMvcToolbar_Session_Values">Session Values</a></li>
						<li><a href="#myMvcToolbar_Session_Rules">Session Activation Rules</a></li>
						<li><a href="#myMvcToolbar_Session_Options">Session Options</a></li>
						<li><a href="#myMvcToolbar_Session_Files">Session Files</a></li>
					</ul>

					<h6>Session Status
						<a id="myMvcToolbar_Session_Status"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top">&uarr; top</a></small></span>
					</h6>
					<b>enabled: {MVC\Session::is()->enabled()}</b>
					<pre>Session::is()->enabled()</pre>
					<b>Session ID</b>
					<p>{MVC\Session::is()->getSessionId()}</p>
					<pre>Session::is()->getSessionId()</pre>

					<h6>Session Values
						<a id="myMvcToolbar_Session_Values"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top">&uarr; top</a></small></span>
					</h6>
					<b>Namespace</b>
					<p>{MVC\Session::is()->getNamespace()}</p>
					<pre>Session::is()->getNamespace()</pre>

					<b>Values</b>
					<p>
						{$aToolbar.aSessionKeyValues}
					</p>
					<pre>Session::is()->getAll()
OR
$_SESSION['{MVC\Session::is()->getNamespace()}']</pre>

					<!------------------------------------------->

					<h6>Session Rules
						<a id="myMvcToolbar_Session_Rules"></a>
						<small>* = any</small>
						<span class="myMvcToolbar-float-right">
							<small>
								<a href="#myMvcToolbar_top">&uarr; top</a>
							</small>
						</span>
					</h6>
					{assign var="aModuleConfig" value=MVC\Config::MODULE()}
					<p>
						<span class="text-success">Enable</span> Session explicitely for Controller:<br>
						{$aToolbar.aSessionRules.aEnableSessionForController}
					</p>
					<p>
						<span class="text-danger">Disable</span> Session explicitely for Controller:<br>
						{$aToolbar.aSessionRules.aDisableSessionForController}
					</p>
					<pre>Config::MODULE()['SESSION']
OR
Config::MODULE('{MVC\Config::get_MVC_MODULE_CURRENT_NAME()}')['SESSION']</pre>

					<!------------------------------------------->

					<h6>Session Options <a id="myMvcToolbar_Session_Options"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aSessionSettings.MVC_SESSION_OPTIONS}
					</p>
					<pre>Config::get_MVC_SESSION_OPTIONS()</pre>

					<h6>Session Files <a id="myMvcToolbar_Session_Files"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aSessionFiles}
					</p>
				</div>
				<div class="subtab16">{$aToolbar.aServer}</div>
				<div class="subtab17">
					<h6>Overview</h6>
					<ul>
						<li><a href="#myMvcToolbar_getenv">getenv()</a></li>
						<li><a href="#myMvcToolbar_ENV">$_ENV</a></li>
					</ul>

					<h6>getenv() <a id="myMvcToolbar_getenv"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aEnvGetenv}
					</p>

					<h6>$_ENV <a id="myMvcToolbar_ENV"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aEnvEnv}
					</p>
				</div>
				<div class="subtab18">{$aToolbar.aConstant}</div>
			</figure>

		</div>
		<div class="tab2">

			<!-- invisible action detection -->
			<input id="subtab26" type="radio" name="subtabs2" />
			<input id="subtab24" type="radio" name="subtabs2" />
			<input id="subtab25" type="radio" name="subtabs2" />
			<input id="subtab23" type="radio" name="subtabs2" />
			<input id="subtab22" type="radio" name="subtabs2" checked="checked" />
			<input id="subtab21" type="radio" name="subtabs2" />

			<!-- menu -->
			<navi>
				<label for="subtab22">Request</label>
				<label for="subtab24">Routing</label>
				<label for="subtab23">Event</label>
				<label for="subtab25">Policy</label>
				<label for="subtab26">Config</label>
				<label for="subtab21">Core</label>
			</navi>

			<!-- content -->
			<figure>

				<a id="myMvcToolbar_top2"></a>

				<div class="subtab26">
					<h6>Config Directories</h6>
					<b>Config Directory of current Module</b>
					<p>
						{MVC\Config::get_MVC_MODULE_CURRENT_CONFIG_DIR()}
					</p>
					<pre>Config::get_MVC_MODULE_CURRENT_CONFIG_DIR()</pre>

					<b>Staging (develop|test|live) config Files Directory of current Module</b>
					<p>
						{MVC\Config::get_MVC_MODULE_CURRENT_STAGING_CONFIG_DIR()}
					</p>
					<pre>Config::get_MVC_MODULE_CURRENT_STAGING_CONFIG_DIR()</pre>

					<b>Config Directory of current Module for composer.json</b>
					<p>
						{MVC\Config::get_MVC_MODULE_CURRENT_COMPOSER_DIR()}
					</p>
					<pre>Config::get_MVC_MODULE_CURRENT_COMPOSER_DIR()</pre>

					<h6>Current Module Config</h6>
					<p>{$aToolbar.aModuleCurrentConfig}</p>
					<pre>Config::MODULE()</pre>

					<h6>Getter</h6>
					<br>
					<p>
						{foreach key=key item=aData from=$aToolbar.aConfig}
						<b>{$aData.sVar}</b><br>
					<p>{$aData.mResult|@print_r:true}</p>
					<pre>{$aData.sMethod}</pre>
					<hr>
					{/foreach}
					</p>
				</div>

				<div class="subtab21">
					<p>
						{$aToolbar.sMyMVCCore}
					</p>
					<pre>Config::get_MVC_CORE()</pre>

				</div>
				<div class="subtab22">
					<h6>Path <small>requested</small><a id="myMvcToolbar_Path"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>{$aToolbar.sRoutingPath|escape:"htmlall":"UTF-8"}</p>
					<pre>Request::getCurrentRequest()->get_path()</pre>

					<h6>Path Param Array</h6>
					<p>
						{if true == empty($aToolbar.aPathParam)}
							...no path parameters
						{else}
							{$aToolbar.sPathParam}
						{/if}
					</p>
					<pre>Request::getPathParam();
Request::getPathParam( $sKey )</pre>

					<h6>Query <small>requested</small><a id="myMvcToolbar_Query"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>
						{if '' === $aToolbar.sRoutingQuery}
							...no GET query
						{else}
							{$aToolbar.sRoutingQuery|unescape:"url"|escape:"htmlall":"UTF-8"}
						{/if}
					</p>
					<pre>Request::getCurrentRequest()->get_query()</pre>

					<h6>Current Request Object</h6>
					<pre>{MVC\Request::getCurrentRequest()|@print_r:true}</pre>
					<i>MVC\DataType\DTRequestCurrent</i>
					<pre>Request::getCurrentRequest()</pre>
				</div>
				<div class="subtab23">
					<h6>Overview</h6>
					<ul>
						<li><a href="#myMvcToolbar_BINDindex">bind() <small>list by index</small></a></li>
						<li><a href="#myMvcToolbar_BINDname">bind() <small>group by event name</small></a></li>
						<li><a href="#myMvcToolbar_RUN">run()</a></li>
						<li><a href="#myMvcToolbar_DELETE">delete()</a></li>
					</ul>

					<h6>bind() <small>list by index</small> <a id="myMvcToolbar_BINDindex"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aEventBIND}
					</p>
					<pre>Event::bind('event.name', \Closure $oClosure, $oObject = NULL);</pre>

					<h6>bind() <small>group by event name</small> <a id="myMvcToolbar_BINDname"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aEventBINDNAME}
					</p>
					<pre>Event::bind('event.name', \Closure $oClosure, $oObject = NULL);</pre>

					<h6>run() <a id="myMvcToolbar_RUN"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aEventRUN}
					</p>
					<pre>Event::run('event.name', DTArrayObject::create());</pre>

					{if !empty($aToolbar.aEventRUNBONDED)}
						<p>
							<b>BONDED</b><br>
							{$aToolbar.aEventRUNBONDED}
						</p>
					{/if}

					<h6>delete() <a id="myMvcToolbar_DELETE"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					{if !empty($aToolbar.aEventDELETE)}
						<p>
							{$aToolbar.aEventDELETE}
						</p>
					{/if}
					<pre>Event::delete('event.name');</pre>
				</div>
				<div class="subtab24">
					<h6>Target Controller method <a id="myMvcToolbar_Target"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					{*					<p>\{$aToolbar.aRouting.sModule}\Controller\{$aToolbar.aRouting.sController}::{$aToolbar.aRouting.sMethod}({$aToolbar.aRouting.sArg|escape:"htmlall":"UTF-8"})	</p>*}
					{if isset($aToolbar.aRouting.aRoutingCurrent.class)}
						<p>\{$aToolbar.aRouting.aRoutingCurrent.class}::{$aToolbar.aRouting.aRoutingCurrent.m}()</p>
						<pre>Route::getCurrent()->get_class()  ::  Route::getCurrent()->get_m()</pre>
					{else}
						<p>unknown</p>
					{/if}
					<h6>Current Route <a id="myMvcToolbar_Routing"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>{$aToolbar.aRouting.sRoutingCurrent}</p>
					<i>array</i>
					<pre>Route::getCurrent()->getPropertyArray()</pre>
					<i>\MVC\DataType\DTRoute</i>
					<pre>Route::getCurrent()</pre>

					<h6>All Routes <small>paths only</small></h6>
					<p>{$aToolbar.aRouting.aRoute}</p>
					<i>array</i> - paths only
					<pre>array_keys(Route::$aRoute)</pre>
					<i>array</i> - full information
					<pre>Route::$aRoute</pre>
				</div>
				<div class="subtab25">
					<h6>Overview</h6>
					<ul>
						<li><a href="#myMvcToolbar_RULES">POLICY RULES</a></li>
						<li><a href="#myMvcToolbar_APPLIED">POLICY RULES APPLIED</a></li>
					</ul>

					<h6>POLICY RULES <a id="myMvcToolbar_RULES"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aPolicy.aRule}
					</p>
					<pre>Policy::getRules()</pre>

					<h6>POLICY RULES ACTUALLY APPLIED <a id="myMvcToolbar_APPLIED"></a> <span class="myMvcToolbar-float-right"><small><a href="#myMvcToolbar_top2">&uarr; top</a></small></span></h6>
					<p>
						{$aToolbar.aPolicy.aApplied}
					</p>
					<pre>Policy::getRulesApplied()</pre>
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

				<a id="myMvcToolbar_top"></a>

				<div class="subtab31">
					<h6>Current View</h6>
					{assign var=oViewCurrent value=MVC\Config::get_MVC_MODULE_CURRENT_VIEW()}

					<p>{get_class(MVC\Config::get_MVC_MODULE_CURRENT_VIEW())}</p>
					<i>ClassName</i>
					<pre>get_class(Config::get_MVC_MODULE_CURRENT_VIEW())</pre>
					<i>Object</i>
					<pre>Config::get_MVC_MODULE_CURRENT_VIEW()</pre>

					<h6>Template Folder</h6>
					<p>
						{MVC\Config::get_MVC_VIEW_TEMPLATES()|escape:'htmlall'}
					</p>
					<pre>\{get_class(MVC\Config::get_MVC_MODULE_CURRENT_VIEW())}::init()->sTemplateDir</pre>

					<h6>Template Files</h6>
					<b>Current Template relative</b>
					<p>
						{$oViewCurrent->sTemplateRelative}
					</p>
					<pre>\{get_class(MVC\Config::get_MVC_MODULE_CURRENT_VIEW())}::init()->sTemplateRelative</pre>

					<b>Current Template absolute</b>
					<p>
						{$oViewCurrent::init()->sTemplate}
					</p>
					<pre>\{get_class(MVC\Config::get_MVC_MODULE_CURRENT_VIEW())}::init()->sTemplate</pre>

					<b>Default Template</b>
					<p>{MVC\View::getSmartyTemplateDefault()}</p>
					<pre>View::getSmartyTemplateDefault()</pre>

					<h6>Template Content</h6>
					<!-- maybe later... @see https://www.w3schools.com/howto/tryit.asp?filename=tryhow_syntax_highlight -->
					<pre class="prettyprint">{$aToolbar.sTemplateContent|escape:'htmlall'}</pre>
					<pre>file_get_contents(\{get_class(MVC\Config::get_MVC_MODULE_CURRENT_VIEW())}::init()->sTemplate, true)</pre>
				</div>
				<div class="subtab32">
					<p>{$aToolbar.sSmartyTemplateVars}</p>
					<pre>\{get_class(MVC\Config::get_MVC_MODULE_CURRENT_VIEW())}::init()->getTemplateVars()</pre>
				</div>
				<div class="subtab33">
					<pre class="prettyprint"><code class="html">{$aToolbar.sRendered|escape:'htmlall'}</code></pre>
					<pre>\{get_class(MVC\Config::get_MVC_MODULE_CURRENT_VIEW())}::init()->fetch('string:' . file_get_contents(\{get_class(MVC\Config::get_MVC_MODULE_CURRENT_VIEW())}::init()->sTemplate))</pre>
				</div>
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

				<a id="myMvcToolbar_top"></a>

				<div class="subtab41">
					<h6>MVC_BASE_PATH</h6>
					<p>
						{$aToolbar.aRegistry.MVC_BASE_PATH|escape:'htmlall'}
					</p>
					<pre>Config::get_MVC_BASE_PATH()</pre>
					<h6>Files</h6>
					<ol class="prettyprint">
						{foreach key=key item=item from=$aToolbar.aFilesIncluded}
							<li>{$item|replace:$aToolbar.aRegistry.MVC_BASE_PATH:''|escape:'htmlall'}</li>
						{/foreach}
					</ol>
					<pre>get_required_files()</pre>
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

				<a id="myMvcToolbar_top"></a>

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

				<a id="myMvcToolbar_top"></a>

				<div class="subtab61">
					<p>{$aToolbar.sRegistry}</p>
					<pre>Registry::getStorageArray()</pre>
				</div>
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

				<a id="myMvcToolbar_top"></a>

				<div class="subtab71">
					<h6>Cache Folder</h6>
					<p>
						{$aToolbar.aRegistry.MVC_CACHE_DIR}
					</p>
					<pre>Config::get_MVC_CACHE_DIR()</pre>

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
				<label for="subtab81">E_*</label>
			</navi>

			<!-- content -->
			<figure>

				<a id="myMvcToolbar_top"></a>

				<div class="subtab81">
					<ul>
						{foreach key=key item=oDTArrayObject from=$aToolbar.aError}
							<li>
								{assign var="oErrorException" value=$oDTArrayObject->getDTKeyValueByKey('$oException')->get_sValue()}
								<b>{MVC\Error::$aExceptionTranslation[$oErrorException->getCode()]}</b> ({$oErrorException->getCode()})<br>
								{$oErrorException->getFile()}<br>
								Line: {$oErrorException->getLine()}<br>
								<u>Message:</u> <i>{$oErrorException->getMessage()}</i>
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
			<label for="tab8" class="myMvcToolbar-bg-primaryx" style="position: relative;">
				<i class="fa fa-warning myMvcToolbarBlinkx"></i> E_* <sup>({count($aToolbar.aError)})</sup>
			</label>
		{/if}
		<label id="myMvcToolbar_toggle" class="myMvcToolbar-bg-info" title="toggle"><b>&larr;&rarr;</b></label>
	</navi>
</div>
<script src="/myMVC/scripts/myMVCInfoTool.min.js" type="text/javascript"></script>