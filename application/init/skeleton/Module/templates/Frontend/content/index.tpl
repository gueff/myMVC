
{* @see https://getbootstrap.com/docs/5.3/examples/cheatsheet/ *}
<div class="container py-4 shadow bg-white padding20">
    <div class="text-center">
        <h1 class="display-5 fw-bold">
            {$oDTRoutingAdditional->get_sTitle()}
        </h1>
        <p class="fs-4">
            {* @see https://fontawesome.com/icons/php?f=brands&s=solid *}
            done by <img src="/favicon-32x32.png" style="border: none;margin-top: 5px;margin-right: 2px;"><b>myMVC</b>, PHP <i class="fa-brands fa-php"></i> MVC Framework
            <br>
        </p>
        <p>
            <a class="btn btn-primary btn-lg" href="https://myMVC.ueffing.net/" role="button" target="_blank">
                see Documentation
            </a>
        </p>
    </div>
    <br>
    {include file="Frontend/content/info.tpl"}
</div>