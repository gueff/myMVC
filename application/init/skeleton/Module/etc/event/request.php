<?php

# List of myMVC Standard Events
# @see https://mymvc.ueffing.net/3.4.x/events#myMVCStandardEvents


\MVC\Event::processBindConfigStack([

    /**
     * after current request was get
     */
    'mvc.request.getCurrentRequest.after' => [
        /*
         * logging requests
         * uncomment if you want requests to your application get logged
         * watch the log on command line with `tail -f request.log`
         */
        function(\MVC\DataType\DTArrayObject $oDTArrayObject, \MVC\DataType\DTEventContext $oDTEventContext) {

//            /** @var \MVC\DataType\DTRequestCurrent $oDTRequestCurrent */
//            $oDTRequestCurrent = $oDTArrayObject->flatten()['oDTRequestCurrent'];
//
//            \MVC\Log::write($oDTRequestCurrent, 'request.log');
        },
    ],

]);
