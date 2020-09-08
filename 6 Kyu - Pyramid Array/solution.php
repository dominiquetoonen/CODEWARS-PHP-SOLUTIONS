<?php

class MyTestCases extends TestCase {
    public function testBasicTests() {
        $this->assertEquals([], pyramid(0));
        $this->assertEquals([[1]], pyramid(1));
        $this->assertEquals([[1], [1, 1]], pyramid(2));
        $this->assertEquals([[1], [1, 1], [1, 1, 1]], pyramid(3));
    }

    private function sol($n) {
        return $n === 0 ? [] : array_map(function($x) {
            return array_fill(0, $x, 1);
        }, range(1, $n));
    }

    public function testRandomTests() {
        for ($i = 0; $i < 100; $i++) $this->assertEquals($this->sol($n = rand(0, 20)), pyramid($n));
    }
}

function pyramid($n) {
    $buildPyramid = [];
    for($i=1; $i<=$n; $i++){
        $buildPyramid[] = array_fill(0,$i,1);
    }

    return $buildPyramid;
}

?>