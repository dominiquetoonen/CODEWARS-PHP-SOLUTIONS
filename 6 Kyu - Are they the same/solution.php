<?php

/* Test case */

class AreTheyTheSameTest extends TestCase
{
    private function revTest($actual, $expected)
    {
        $this->assertEquals($expected, $actual);
    }

    public function testBasics()
    {
        $a1 = [121, 144, 19, 161, 19, 144, 19, 11];
        $a2 = [11 * 11, 121 * 121, 144 * 144, 19 * 19, 161 * 161, 19 * 19, 144 * 144, 19 * 19];
        $this->revTest(comp($a1, $a2), true);
        $a1 = [121, 144, 19, 161, 19, 144, 19, 11];
        $a2 = [11 * 21, 121 * 121, 144 * 144, 19 * 19, 161 * 161, 19 * 19, 144 * 144, 19 * 19];
        $this->revTest(comp($a1, $a2), false);
        $a1 = [121, 144, 19, 161, 19, 144, 19, 11];
        $a2 = [11 * 11, 121 * 121, 144 * 144, 190 * 190, 161 * 161, 19 * 19, 144 * 144, 19 * 19];
        $this->revTest(comp($a1, $a2), false);
        $a1 = [];
        $a2 = [];
        $this->revTest(comp($a1, $a2), true);
        $a1 = [4, 4];
        $a2 = [1, 31];
        $this->revTest(comp($a1, $a2), false);
        $a1 = [];
        $a2 = null;
        $this->revTest(comp($a1, $a2), false);
        $a1 = [121, 144, 19, 161, 19, 144, 19, 11, 1008];
        $a2 = [11 * 11, 121 * 121, 144 * 144, 190 * 190, 161 * 161, 19 * 19, 144 * 144, 19 * 19];
        $this->revTest(comp($a1, $a2), false);
        $a1 = [10000000, 100000000];
        $a2 = [10000000 * 10000000, 100000000 * 100000000];
        $this->revTest(comp($a1, $a2), true);
        $a1 = [3, 4];
        $a2 = [0, 25];
        $this->revTest(comp($a1, $a2), false);
        $a1 = [10000001, 100000000];
        $a2 = [10000000 * 10000000, 100000000 * 100000000];
        $this->revTest(comp($a1, $a2), false);
        $a1 = [2, 2, 3];
        $a2 = [4, 9, 9];
        $this->revTest(comp($a1, $a2), false);
    }

    function _compHJ($a1, $a2)
    {
        if ($a1 == null || $a2 == null) return false;
        $aa1 = array_values($a1);
        $aa2 = array_values($a2);
        sort($aa1);
        sort($aa2);
        foreach ($aa1 as $i => $___) {
            if (pow($aa1[$i], 2) != $aa2[$i]) return false;
        }
        return true;
    }

    public function testRandom()
    {
        for ($i = 0; $i < 200; $i++) {
            $testlen = rand(8, 25);
            $a1 = array();
            $a2 = array();
            for ($j = 0; $j < $testlen; $j++) {
                $elem = rand(0, 100);
                array_push($a1, $elem);
                array_push($a2, $elem * $elem);
            }
            $pos = rand(0, count($a2) - 1);
            $a2[$pos] = $a2[$pos] + rand(0, 1);
            $sol = $this->_compHJ($a1, $a2);
            $ans = comp($a1, $a2);
            $this->revTest($ans, $sol);
        }
    }
}

/* Solution */

function comp($a1, $a2)
{
    if ($a1 && $a2) {
        foreach ($a1 as &$e)
            $e = $e * $e;
        sort($a1);
        sort($a2);
    }
    return $a1 === $a2;
}

?>