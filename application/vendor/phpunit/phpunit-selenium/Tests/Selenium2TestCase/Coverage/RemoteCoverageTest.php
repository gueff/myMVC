<?php

namespace Tests\Selenium2TestCase\Coverage;

use PHPUnit\Extensions\SeleniumCommon\RemoteCoverage;
use PHPUnit\Framework\TestCase;

class RemoteCoverageTest extends TestCase
{
    public function testObtainsCodeCoverageInformationFromAPossiblyRemoteHttpServer()
    {
        $coverageScriptUrl = PHPUNIT_TESTSUITE_EXTENSION_SELENIUM_TESTS_URL . '/coverage/dummy.txt';
        $coverage = new RemoteCoverage(
            $coverageScriptUrl,
            'dummyTestId'
        );
        $content = $coverage->get();
        $dummyClassSourceFile = $this->classSourceFile('DummyClass', $content);
        $expectedCoverage = array(
            3 => 1,
            6 => 1,
            7 => -2,
            11 => -1,
            12 => -2,
            14 => 1
        );
        $this->assertTrue(isset($content[$dummyClassSourceFile]), "Coverage: " . var_export($content, true));
        $this->assertEquals($expectedCoverage, $content[$dummyClassSourceFile]);
    }

    private function classSourceFile($className, array $content)
    {
        foreach ($content as $file => $coverage) {
            if (strstr($file, $className)) {
                return $file;
            }
        }
        $this->fail("Class $className not found in coverage: " . var_export($content, true));
    }
}
