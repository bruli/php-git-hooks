<?php

namespace PhpGitHooks\Command;

final class GoodJobLogo
{
    /**
     * @param string $message
     *
     * @return string
     */
    public static function paint($message)
    {
        return sprintf("<fg=yellow;options=bold;>
                 @@@@@@@@@@@@@@@
     @@@@      @@@@@@@@@@@@@@@@@@@
    @    @   @@@@@@@@@@@@@@@@@@@@@@@
    @    @  @@@@@@@@   @@@   @@@@@@@@@
    @   @  @@@@@@@@@   @@@   @@@@@@@@@@
    @  @   @@@@@@@@@@@@@@@@@@@@@@@@@@@@@
   @@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@
  @         @ @@  @@@@@@@@@@@@@  @@@@@@@@
 @@         @ @@@  @@@@@@@@@@@  @@@@@@@@@
@@   @@@@@@@@ @@@@  @@@@@@@@@  @@@@@@@@@@
@            @ @@@@           @@@@@@@@@@
@@           @ @@@@@@@@@@@@@@@@@@@@@@@@
 @   @@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@
 @@         @ @@@@@@@@@@@@@@@@@@@@@@
  @@@@@@@@@@   @@@@@@@@@@@@@@@@@@@
                 @@@@@@@@@@@@@@@
        </fg=yellow;options=bold;>\n
        <fg=white;bg=yellow;options=bold;>       %s       </fg=white;bg=yellow;options=bold;>", $message);
    }
}
