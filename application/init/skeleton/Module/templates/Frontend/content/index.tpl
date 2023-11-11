
{* @see https://getbootstrap.com/docs/5.3/migration/#jumbotron AND https://getbootstrap.com/docs/5.3/examples/jumbotron/*}
<div class="container py-4">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold"">
                {$oDTRoutingAdditional->get_sTitle()}
            </h1>
            <p class="col-md-8 fs-4">
                {* @see https://fontawesome.com/icons/php?f=brands&s=solid *}
                done by <b>myMVC</b>, the PHP <i class="fa-brands fa-php"></i> MVC Framework
                <br>
            </p>
            <p>
                <a class="btn btn-primary btn-lg" href="https://mymvc.ueffing.net/" role="button" target="_blank">
                    see myMVC Documentation
                </a>
            </p>
        </div>
    </div>
</div>

<div class="container py-4">
    {include file="Frontend/content/info.tpl"}
    <hr>
</div>

