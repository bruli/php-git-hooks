<?php

namespace PhpGitHooks\Command;

final class BadJobLogo
{
    /**
     * @param string $message
     *
     * @return string
     */
    public static function paint($message)
    {
        return sprintf("<fg=red;options=bold;>
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
        </fg=red;options=bold;>\n
        <fg=white;bg=red;options=bold;>   %s    </fg=white;bg=red;options=bold;>\n", $message);
    }
}
