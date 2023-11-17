
{* @see https://getbootstrap.com/docs/5.3/components/navbar/ *}
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary shadow">
    <div class="container">
        <a class="navbar-brand" href="/">
            {$oDTRoutingAdditional->get_sTitle()}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            {*            <ul class="navbar-nav me-auto mb-2 mb-md-0">*}
            {*                <li class="nav-item">*}
            {*                    <a class="nav-link active" aria-current="page" href="#">Home</a>*}
            {*                </li>*}
            {*                <li class="nav-item">*}
            {*                    <a class="nav-link" href="#">Link</a>*}
            {*                </li>*}
            {*                <li class="nav-item">*}
            {*                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>*}
            {*                </li>*}
            {*            </ul>*}

            {*            <form class="d-flex" role="search">*}
            {*                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">*}
            {*                <button class="btn btn-success" type="submit">Search</button>*}
            {*            </form>*}

            {*            <ul class="navbar-nav mb-2 mb-md-0">*}
            {*                <li class="nav-item">*}
            {*                    <a class="nav-link" href="#">*}
            {*                        <i class="fa fa-sign-in"></i> Login*}
            {*                    </a>*}
            {*                </li>*}
            {*            </ul>*}

        </div>
    </div>
</nav>
