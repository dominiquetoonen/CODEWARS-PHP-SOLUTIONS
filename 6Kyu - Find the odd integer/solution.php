<?php

class CompleteTestCases extends TestCase
{
    public function testFindItReturnsValueAppearingOddNumberOfTimes()
    {
        $this->assertEquals(5, findIt([20,1,-1,2,-2,3,3,5,5,1,2,4,20,4,-1,-2,5]));
        $this->assertEquals(-1, findIt([1,1,2,-2,5,2,4,4,-1,-2,5]));
        $this->assertEquals(5, findIt([20,1,1,2,2,3,3,5,5,4,20,4,5]));
        $this->assertEquals(10, findIt([10]));
        $this->assertEquals(10, findIt([1,1,1,1,1,1,10,1,1,1,1]));
    }

    public function testRandomGeneratedArrays()
    {
        array_map(function() {
            $seq = $this->generateSeq();
            shuffle($seq);
            $this->assertEquals($this->solution($seq), findIt($seq));
        },
            range(1, 40)
        );
    }

    private function randInt($a, $b)
    {
        return rand(1, $b - $a + 1) + $a;
    }

    private function solution($seq)
    {
        $valueCount = array_count_values($seq);
        $oddValue = array_filter($valueCount, function($value) {
            return fmod($value, 2) != 0;
        });
        return key($oddValue);
    }

    private function generateSeq()
    {
        $randomSeqStub = array_map(
            function(&$value) {
                return $this->randInt(1,20);
            },
            range(1, $this->randInt(1,10))
        );
        return array_merge($randomSeqStub, $randomSeqStub, [$this->randInt(1,20)]);
    }
}

function findIt(array $seq) : int
{
    $seqOdd = array_count_values($seq);
    foreach($seqOdd as $key => $value) {
        if ($value % 2) {
            return $key;
        }
    }
}

?>