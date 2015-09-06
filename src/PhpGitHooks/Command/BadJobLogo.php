<?php

namespace PhpGitHooks\Command;

final class BadJobLogo
{
    /**
     * @return string
     */
    public static function paint()
    {
        return "<fg=red;options=bold;>
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
        <fg=white;bg=red;options=bold;>   FIX YOUR FUCKING CODE!!!    </fg=white;bg=red;options=bold;>\n";
    }
}
