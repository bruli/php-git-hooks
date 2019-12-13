<?php

namespace PhpGitHooks\Module\Git\Contract\Response;

final class GoodJobLogoResponse
{
    /**
     * @param string $message
     * @param bool $enableFace
     *
     * @return string
     */
    public static function paint($message, $enableFace)
    {
        $face = $enableFace ? "<fg=yellow;options=bold;>
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
        </fg=yellow;options=bold;>\n" : '';

        return sprintf(
            "$face<fg=white;bg=yellow;options=bold;>       %s       </fg=white;bg=yellow;options=bold;>",
            $message
        );
    }
}
