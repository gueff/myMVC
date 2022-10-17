<?php

/**
 * Policy
 */
\MVC\Policy::set('\{module}\Controller\Index', '*', '\{module}\Policy\Index::requestMethodHasToMatchRouteMethod');
