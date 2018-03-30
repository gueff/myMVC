{* 

see /modules/InfoTool/doc/README
for more Info

*}
<style>
{literal}	

#myMvcToolbar {
    display: block;
    width: 1000px;
    height: 50px;
    background-color: transparent;
    border: 1px solid transparent;
    
    position: fixed;
    bottom: 20px;
    left: 10px;
    z-index: 9999999;    
}
#myMvcToolbar pre {
    background-color: silver;
    padding: 10px !important;
    white-space: pre-wrap;       /* css-3 */
    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: -o-pre-wrap;    /* Opera 7 */
    word-wrap: break-word;       /* Internet Explorer 5.5+ */
}
#myMvcToolbarInfo {
    position: absolute;
    top: 40px;
    padding: 0px 5px;
    background-color: transparent;
    color: #000;
    text-shadow: 1px 1px 1px #fff;
}
#myMvcToolbar ul {
    margin: 10px 0 0 0;
    padding: 0;
}
#myMvcToolbar ul li {
    float: left;
    list-style: none;
}
    /* Toolbar Buttons */
    #myMvcToolbar > ul > li > a {
        height: 20px;
        background-color: silver;
        padding: 10px;
        border: 1px solid silver;
        border-top: 1px solid #fff;
z-index: 999;
    }
    #myMvcToolbar > ul > li > ul > ul {
    }
    #myMvcToolbar > ul > li > ul > ul > li {
        position: relative;
        top: -8px;
    }
    /* Content Buttons */
    #myMvcToolbar > ul > li > ul > ul > li > a {
        height: 20px;
        background-color: silver;
        padding: 10px;
        border: 1px solid silver;
        border-bottom: 1px solid #fff;
    }
        #myMvcToolbar ul li a:hover, #myMvcToolbar ul li a:active {
            background-color: silver;
        }
.myMvcToolbarContent {
    display: none;
    position: absolute;
    bottom: 43px;
    left: 0px;
    width: 950px;
    height: 600px;
    padding: 0px;
z-index: -1;
}
    .myMvcToolbarVariables {
        display: none;
        overflow: auto;
        width: 100%;
        height: 565px;        
        padding: 20px;
        background-color: #fff;
        border: 1px solid silver;
    }   
.myMvcToolbarActive, .myMvcToolbarTabActive {
    background-color: #fff !important;
}
{/literal}	
</style>  
<script>
{literal}	
    /**
     * 
     * @param {string} sElement
     * @returns {void}
     */
    function removeActive(sElement) {
        var aActive = document.getElementsByClassName(sElement);
        Array.prototype.forEach.call(aActive, function(oTarget) {
            oTarget.classList.remove(sElement);
        });         
    }
    
    /**
     * 
     * @param {object} oElement
     * @param {string} sElement
     * @returns {void}
     */
    function toggle(oElement, sElement) {
        
        var aSplit = sElement.split('_');
        // 2 === button, 3 === content
        var iCount = parseInt(aSplit.length);
        
        if (iCount === 2) {
            removeActive('myMvcToolbarActive');                        
            oElement.classList.add('myMvcToolbarActive');        
            removeActive('myMvcToolbarTabActive');        
        }        
        if (iCount === 3) {
            removeActive('myMvcToolbarTabActive');                        
            oElement.classList.add('myMvcToolbarTabActive');        
        }

        // set all inactive
        for (i = 0; i < 10; i++) {
            
            var sTmp = aSplit[0] + '_' + i;
            var oTmp = document.getElementById(sTmp);

            if (null !== oTmp) {
                
                // button
                if (i !== parseInt(aSplit[1])) {
                    oTmp.style.display = 'none';
                }
                
                // sub content
                for (k = 0; k < 10; k++) {
                    var sTmp2 = sTmp + '_' + k;
                    var oTmp2 = document.getElementById(sTmp2);
                    
                    if (null !== oTmp2) {
                        oTmp2.style.display = 'none';
                    }
                }
            }
        }    
        
        // set active
        document.getElementById(sElement).style.display = ((document.getElementById(sElement).style.display === 'block') ? 'none' : 'block');
        
        // inactive button
        if (iCount === 2) {
            ((document.getElementById(sElement).style.display === 'none') ? removeActive('myMvcToolbarActive') : false);
        }
        
        // 1. sub content active as default
        if (2 === iCount) {            
            document.getElementById(sElement + '_1').style.display = 'block';
            document.getElementById('btn_' + sElement + '_1').classList.add('myMvcToolbarTabActive');             
        }
    }
{/literal}	
</script>		


<div id="myMvcToolbar">
    <ul>

        <div id="myMvcToolbarInfo">
            <small>
					Env: {$aToolbar.sEnv} | PHP {$aToolbar.sPHP}, Operating System {$aToolbar.sOS}, Construction Time: {$aToolbar.sConstructionTime} s
            </small>    
        </div>
            
        <li>
            <a href="#" 
               onclick="toggle(this, 'myMvcToolbarContent_1');" 
               >
                <i class="fa fa-cubes"></i> Variables
            </a>                    
            <ul id="myMvcToolbarContent_1" class="myMvcToolbarContent">
                <ul>
                    <li>
                        <a href="#" id="btn_myMvcToolbarContent_1_1" onclick="toggle(this, 'myMvcToolbarContent_1_1');">$_GET</a>
                    </li>
                    <li>
                        <a href="#" id="btn_myMvcToolbarContent_1_2" onclick="toggle(this, 'myMvcToolbarContent_1_2');">$_POST</a>
                    </li>
                    <li>
                        <a href="#" id="btn_myMvcToolbarContent_1_3" onclick="toggle(this, 'myMvcToolbarContent_1_3');">$_COOKIE</a>
                    </li>
                    <li>
                        <a href="#" id="btn_myMvcToolbarContent_1_4" onclick="toggle(this, 'myMvcToolbarContent_1_4');">$_REQUEST</a>
                    </li>
                    <li>
                        <a href="#" id="btn_myMvcToolbarContent_1_5" onclick="toggle(this, 'myMvcToolbarContent_1_5');">$_SESSION</a>
                    </li>
                    <li>
                        <a href="#" id="btn_myMvcToolbarContent_1_6" onclick="toggle(this, 'myMvcToolbarContent_1_6');">$_SERVER</a>
                    </li>
                    <li>
                        <a href="#" id="btn_myMvcToolbarContent_1_7" onclick="toggle(this, 'myMvcToolbarContent_1_7');">Constants</a>
                    </li>
                    <li>
                        <a href="#" id="btn_myMvcToolbarContent_1_8" onclick="toggle(this, 'myMvcToolbarContent_1_8');">$GLOBALS</a>
                    </li>
                    <li>
                        <a href="#" id="btn_myMvcToolbarContent_1_9" onclick="toggle(this, 'myMvcToolbarContent_1_9');">$_ENV</a>
                    </li>
                </ul>   
                
                <div id="myMvcToolbarContent_1_1" class="myMvcToolbarVariables">
                    <p>
                        <br />unfiltered Values in $_GET:
                    </p>
                    <pre>{$aToolbar.aGet|@print_r:true|escape:'htmlall'}</pre>		
                    <p>									
                        to see filtered $_GET Values by myMVC, see [myMVC] => [MVC_Request::getQueryArrays]
                    </p>
                </div>                                    
                <div id="myMvcToolbarContent_1_2" class="myMvcToolbarVariables">
                    <pre>{$aToolbar.aPost|@print_r:true|escape:'htmlall'}</pre>
                </div>                     
                <div id="myMvcToolbarContent_1_3" class="myMvcToolbarVariables">
                    <pre>{$aToolbar.aCookie|@print_r:true|escape:'htmlall'}</pre>
                </div>                     
                <div id="myMvcToolbarContent_1_4" class="myMvcToolbarVariables">
                    <pre>{$aToolbar.aRequest|@print_r:true|escape:'htmlall'}</pre>
                </div>                     
                <div id="myMvcToolbarContent_1_5" class="myMvcToolbarVariables">
                    <pre>{$aToolbar.aSession|@print_r:true|escape:'htmlall'}</pre>
                </div>                     
                <div id="myMvcToolbarContent_1_6" class="myMvcToolbarVariables">
                    <pre>{$aToolbar.aServer|@print_r:true|escape:'htmlall'}</pre>
                </div>                     
                <div id="myMvcToolbarContent_1_7" class="myMvcToolbarVariables">
                    <pre>{$aToolbar.aConstant|@print_r:true|escape:'htmlall'}</pre>
                </div>                     
                <div id="myMvcToolbarContent_1_8" class="myMvcToolbarVariables">
                    <pre>{$aToolbar.aGLOBALS|@print_r:true|escape:'htmlall'}</pre>
                </div>                     
                <div id="myMvcToolbarContent_1_9" class="myMvcToolbarVariables">
                    <pre>{$aToolbar.aEnv|@print_r:true|escape:'htmlall'}</pre>
                </div>                     
            </ul>
        </li>
        
        <li>
            <a href="#" 
               onclick="toggle(this, 'myMvcToolbarContent_2');" 
               >
                <i class="fa fa-cube"></i> myMVC
            </a>                    
            <ul id="myMvcToolbarContent_2" class="myMvcToolbarContent">
                <ul>
                    <li>
                        <a href="#" id="btn_myMvcToolbarContent_2_1" onclick="toggle(this, 'myMvcToolbarContent_2_1');">MVC_Request::getWhitelistParams</a>
                    </li>
                    <li>
                        <a href="#" id="btn_myMvcToolbarContent_2_2" onclick="toggle(this, 'myMvcToolbarContent_2_2');">MVC_Request::getQueryArray</a>
                    </li>
                    <li>
                        <a href="#" id="btn_myMvcToolbarContent_2_3" onclick="toggle(this, 'myMvcToolbarContent_2_3');">MVC_Event</a>
                    </li>
                    <li>
                        <a href="#" id="btn_myMvcToolbarContent_2_4" onclick="toggle(this, 'myMvcToolbarContent_2_4');">ROUTING</a>
                    </li>
                    <li>
                        <a href="#" id="btn_myMvcToolbarContent_2_5" onclick="toggle(this, 'myMvcToolbarContent_2_5');">MVC_POLICY</a>
                    </li>                    
                </ul>        
                <div id="myMvcToolbarContent_2_1" class="myMvcToolbarVariables">
                    <pre>{$aToolbar.oMvcRequestGetWhitelistParams|@print_r:true|escape:'htmlall'}</pre>
                </div>                  
                <div id="myMvcToolbarContent_2_2" class="myMvcToolbarVariables">
                    <pre>{$aToolbar.oMvcRequestGetQueryArray|@print_r:true|escape:'htmlall'}</pre>
                </div>                  
                <div id="myMvcToolbarContent_2_3" class="myMvcToolbarVariables">
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
                <div id="myMvcToolbarContent_2_4" class="myMvcToolbarVariables">
                    <table style="width: 100%;">
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
                <div id="myMvcToolbarContent_2_5" class="myMvcToolbarVariables">
                    <h3>RULES</h3>
                    <pre>{$aToolbar.aPolicy.aRule|@print_r:true|escape:'htmlall'}</pre>	
                    <h3>APPLIED</h3>
                    <b>{$aToolbar.aPolicy.sAppliedAt}</b><br />
                    <pre>{$aToolbar.aPolicy.aApplied|@print_r:true|escape:'htmlall'}</pre>	
                </div>                  
            </ul>
        </li>
        
        {assign var="sTmp" value="myMvcToolbarContent_3"}
        <li>
            <a href="#" 
               onclick="toggle(this, '{$sTmp}');" 
               >
                <i class="fa fa-code"></i> View
            </a>                    
            <ul id="{$sTmp}" class="myMvcToolbarContent">
                <ul>
                    <li>
                        <a href="#" id="btn_{$sTmp}_1" onclick="toggle(this, '{$sTmp}_1');">Template</a>
                    </li>
                    <li>
                        <a href="#" id="btn_{$sTmp}_2" onclick="toggle(this, '{$sTmp}_2');">Smarty Template Vars</a>
                    </li>
                    <li>
                        <a href="#" id="btn_{$sTmp}_3" onclick="toggle(this, '{$sTmp}_3');">Rendered</a>
                    </li>
                </ul>   
                
                <div id="{$sTmp}_1" class="myMvcToolbarVariables">
                    <pre class="prettyprint">{$aToolbar.sTemplate|escape:'htmlall'}</pre>			  
                    <pre class="prettyprint">{$aToolbar.sTemplateContent|escape:'htmlall'}</pre>
                </div>                     
                <div id="{$sTmp}_2" class="myMvcToolbarVariables">
                    <pre>{$aToolbar.aSmartyTemplateVars|@print_r:true|escape:'htmlall'}</pre>
                </div>                     
                <div id="{$sTmp}_3" class="myMvcToolbarVariables">
                    <pre class="prettyprint">{$aToolbar.sRendered|escape:'htmlall'}</pre>
                </div>                     
            </ul>
        </li>          
        
        {assign var="sTmp" value="myMvcToolbarContent_4"}
        <li>
            <a href="#" 
               onclick="toggle(this, '{$sTmp}');" 
               >
                <i class="fa fa-file-o"></i> Files
            </a>                    
            <ul id="{$sTmp}" class="myMvcToolbarContent">
                <ul>
                    <li>
                        <a href="#" id="btn_{$sTmp}_1" onclick="toggle(this, '{$sTmp}_1');">Files loaded</a>
                    </li>
                </ul>   
                
                <div id="{$sTmp}_1" class="myMvcToolbarVariables">
                    <pre class="prettyprint">{foreach key=key item=item from=$aToolbar.aFilesIncluded}{$key} - {$item}
{/foreach}</pre>
                </div>                     
            </ul>
        </li>  
        
        {assign var="sTmp" value="myMvcToolbarContent_5"}
        <li>
            <a href="#" 
               onclick="toggle(this, '{$sTmp}');" 
               >
                <i class="fa fa-bar-chart-o"></i> Memory
            </a>                    
            <ul id="{$sTmp}" class="myMvcToolbarContent">
                <ul>
                    <li>
                        <a href="#" id="btn_{$sTmp}_1" onclick="toggle(this, '{$sTmp}_1');">Memory</a>
                    </li>
                </ul>   
                
                <div id="{$sTmp}_1" class="myMvcToolbarVariables">
                    <b>Real Memory Usage</b>:<br>{$aToolbar.aMemory.iRealMemoryUsage} KB<br><br>
                    <b>Memory Usage</b>:<br>{$aToolbar.aMemory.dMemoryUsage} KB<br><br>
                    <b>Memory Peak Usage</b>:<br>{$aToolbar.aMemory.dMemoryPeakUsage} KB
                </div>                     
            </ul>
        </li>        
        
        {assign var="sTmp" value="myMvcToolbarContent_6"}
        <li>
            <a href="#" 
               onclick="toggle(this, '{$sTmp}');" 
               >
                <i class="fa fa-key"></i> Registry
            </a>                    
            <ul id="{$sTmp}" class="myMvcToolbarContent">
                <ul>
                    <li>
                        <a href="#" id="btn_{$sTmp}_1" onclick="toggle(this, '{$sTmp}_1');">Registry</a>
                    </li>
                </ul>   
                
                <div id="{$sTmp}_1" class="myMvcToolbarVariables">
                    <pre>{$aToolbar.aRegistry|@print_r:true|escape:'htmlall'}</pre>
                </div>                     
            </ul>
        </li>
        
        {assign var="sTmp" value="myMvcToolbarContent_7"}
        <li>
            <a href="#" 
               onclick="toggle(this, '{$sTmp}');" 
               >
                <i class="fa fa-refresh"></i> Cache
            </a>                    
            <ul id="{$sTmp}" class="myMvcToolbarContent">
                <ul>
                    <li>
                        <a href="#" id="btn_{$sTmp}_1" onclick="toggle(this, '{$sTmp}_1');">Cache</a>
                    </li>
                </ul>   
                
                <div id="{$sTmp}_1" class="myMvcToolbarVariables">
                    <pre>{$aToolbar.aCache|@print_r:true|escape:'htmlall'}</pre>
                </div>                     
            </ul>
        </li>        
        
        {if !empty($aToolbar.aError)}
        {assign var="sTmp" value="myMvcToolbarContent_8"}
        <li>
            <a href="#" 
               onclick="toggle(this, '{$sTmp}');" 
               >
                <i class="fa fa-warning myMvcToolbarBlink"></i> Error
            </a>                    
            <ul id="{$sTmp}" class="myMvcToolbarContent">
                <ul>
                    <li>
                        <a href="#" id="btn_{$sTmp}_1" onclick="toggle(this, '{$sTmp}_1');">Last Error</a>
                    </li>
                </ul>   
                
                <div id="{$sTmp}_1" class="myMvcToolbarVariables">
                    {foreach key=key item=item from=$aToolbar.aError}
                        <b>{$key}</b>: {$item}<br />
                    {/foreach}
                </div>                     
            </ul>
        </li>   
        {/if}
    </ul>
</div>
