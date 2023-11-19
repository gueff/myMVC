
<div class="row padding20">
    <table class="col-md-12 small table table-hover table-borderless table-sm">
        <tr>
            <td>module's Directory</td><td><code>{MVC\Config::get_MVC_MODULE_PRIMARY_DIR()}</code></td>
        </tr>
        <tr>
            <td>stage config file</td><td><code>{MVC\Config::get_MVC_MODULE_PRIMARY_STAGING_CONFIG_DIR()}/{MVC\Config::get_MVC_ENV()}.php</code></td>
        </tr>
        <tr>
            <td>template layout file</td><td><code>{MVC\Config::get_MVC_VIEW_TEMPLATE_DIR()}/{$oDTRoutingAdditional->get_sLayout()}</code></td>
        </tr>
        <tr>
            <td>template content file</td><td><code>{MVC\Config::get_MVC_VIEW_TEMPLATE_DIR()}/{$oDTRoutingAdditional->get_sContent()}</code></td>
        </tr>
    </table>
</div>