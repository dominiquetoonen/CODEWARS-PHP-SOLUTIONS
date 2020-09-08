<?php

class PersistenceTest extends TestCase {
    public function testDescriptionExamples() {
        $this->assertEquals(3, persistence(39));
        $this->assertEquals(4, persistence(999));
        $this->assertEquals(0, persistence(4));
    }
    public function testFixed() {
        $this->assertEquals(0, persistence(1));
        $this->assertEquals(0, persistence(2));
        $this->assertEquals(0, persistence(3));
        $this->assertEquals(0, persistence(5));
        $this->assertEquals(0, persistence(6));
        $this->assertEquals(0, persistence(7));
        $this->assertEquals(0, persistence(8));
        $this->assertEquals(0, persistence(9));
        $this->assertEquals(1, persistence(10));
        $this->assertEquals(1, persistence(15));
        $this->assertEquals(1, persistence(23));
        $this->assertEquals(2, persistence(28));
        $this->assertEquals(1, persistence(40));
        $this->assertEquals(3, persistence(47));
        $this->assertEquals(2, persistence(48));
        $this->assertEquals(2, persistence(58));
        $this->assertEquals(1, persistence(100));
        $this->assertEquals(2, persistence(127));
        $this->assertEquals(2, persistence(223));
        $this->assertEquals(2, persistence(255));
        $this->assertEquals(5, persistence(769));
        $this->assertEquals(2, persistence(1225));
        $this->assertEquals(1, persistence(1984540231));
        $this->assertEquals(2, persistence(1984541231));
        $this->assertEquals(2, persistence(1984341231));
    }
    protected function solution(int $n): int {
        return $n < 10 ? 0 : 1 + $this->solution(array_reduce(str_split(strval($n)), function ($s, $n) {return $s * $n;}, 1));
    }
    public function testRandom() {
        for ($i = 0; $i < 1e3; $i++) $this->assertEquals($this->solution($n = rand(1, 1e6)), persistence($n));
    }
}

function persistence(int $num): int {
    $singleDigit = 0;

    while ( $num >= 10 ) {
        $num = array_product(str_split($num));
        $singleDigit++;
    }

    return $singleDigit;

}

?>