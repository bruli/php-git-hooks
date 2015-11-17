<?php

namespace PhpGitHooks\Application\CodeCoverage;


class CloverFileProcessor
{
    public function calculateOverallCodeCoverage($filePath) {
        $xml = new \SimpleXMLElement(file_get_contents($filePath));
        $metrics = $xml->xpath('//metrics');
        $totalElements = 0;
        $checkedElements = 0;

        foreach ($metrics as $metric) {
            $totalElements += (int)$metric['elements'];
            $checkedElements += (int)$metric['coveredelements'];
        }

        $percentageCodeCoverage = (int)(($checkedElements / $totalElements) * 100);
        unlink($filePath);

        return $percentageCodeCoverage;
    }
}