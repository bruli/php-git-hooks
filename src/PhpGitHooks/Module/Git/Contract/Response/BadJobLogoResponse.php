<?php

namespace PhpGitHooks\Module\Git\Contract\Response;

final class BadJobLogoResponse
{
    /**
     * @param string $message
     * @param bool $enableFace
     *
     * @return string
     */
    public static function paint($message, $enableFace)
    {
        $face = $enableFace ? "<fg=red;options=bold;>
                @@@@@@@@@@@@@@@
             @@@@@@@@@@@@@@@@@@@@
           @@@@@@@@  @@@@@  @@@@@@@
          @@@@@@@@@@  @@@  @@@@@@@@@@
         @@@@@@@@@@@@  @  @@@@@@@@@@@@
        @@@@@@@@@@@  @@@@@  @@@@@@@@@@@
       @@@@@@@@@@@@  @@@@@  @@@@@@@@@@@@
       @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
       @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        @@@@@@@@@@@@       @@@@@@@@@@@@
         @@@@@@@@@@  @@@@@  @@@@@@@@@@
          @@@@@@@@  @@@@@@@  @@@@@@@@
           @@@@@@@@@@@@@@@@@@@@@@@@@
             @@@@@@@@@@@@@@@@@@@@@
                @@@@@@@@@@@@@@@
        </fg=red;options=bold;>\n" : '';

        return sprintf(
            "$face<fg=white;bg=red;options=bold;>   %s    </fg=white;bg=red;options=bold;>\n",
            $message
        );
    }
}
