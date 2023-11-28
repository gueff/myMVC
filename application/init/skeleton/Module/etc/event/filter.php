<?php

# List of myMVC Standard Events
# @see https://mymvc.ueffing.net/3.4.x/events#myMVCStandardEvents


\MVC\Event::processBindConfigStack([

    /**
     * on Input ($_POST, etc.)
     */
    'DTRequestCurrent.set_input.before' => [
        /**
         * converts
         * 'email=john%28.doe%29%40exa%2F%2Fmple.com&password=EinPa%C3%9Fwort'
         * into
         * ['email' => 'john(.doe)@exa//mple.com', 'password' => 'EinPaßwort',]
         */
        function(\MVC\DataType\DTValue $oDTValue){
            parse_str($oDTValue->get_mValue(), $mValue);
            $oDTValue->set_mValue($mValue);
        },
    ],
]);
