<?php

class Tests extends TestCase
{
    public function genRandEven() {
        return rand(0, 1000000) * 2;
    }
    public function testBasic()
    {
        $oddAtTheBack = [2,6,8,10,3];
        $oddInTheMiddle = [2,6,8,200,700,31,84,10,4];
        $oddInTheFront = [17,6,8,10,6,12,24,36];
        $evenInTheFront = [2002,1,7,17,19,211,7];
        $evenInTheMiddle = [1,1,1,1,1,144,7,7,7,7,7,7,7,7];
        $evenAtTheEnd = [3,3,3,3,3,3,3,3,3,3,3,3,3,3,35,5,5,5,5,5,5,5,5,5,5,7,7,7,7,10002];
        $oddAtTheEndNegative = [2,-6,8,-10,-3523];
        $oddInTheMiddleNegative = [2,6,8,2,-66,34,-3523,66,700,1002,-84,10,4];
        $oddInTheFrontNegative = [-1 * 10000000003,-18,6,-8,-10,6,12,-24,36];
        $evenInTheFrontNegative = [-12,1,7,17,19,211,7];
        $evenInTheMiddleNegative= [1,1,-1,1,1,-44,7,7,7,7,7,7,7,7];
        $oddResultZeroes = [0,0, 1139, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $zeroResult = [3,7,-99,81,90211,0,7];

        $this->assertSame(3, find($oddAtTheBack));
        $this->assertSame(31, find($oddInTheMiddle));
        $this->assertSame(17, find($oddInTheFront));
        $this->assertSame(2002, find($evenInTheFront));
        $this->assertSame(144, find($evenInTheMiddle));
        $this->assertSame(10002, find($evenAtTheEnd));
        $this->assertSame(-3523, find($oddAtTheEndNegative));
        $this->assertSame(-3523, find($oddInTheMiddleNegative));
        $this->assertSame(-1 * 10000000003, find($oddInTheFrontNegative));
        $this->assertSame(-12, find($evenInTheFrontNegative));
        $this->assertSame(-44, find($evenInTheMiddleNegative));
        $this->assertSame(1139, find($oddResultZeroes));
        $this->assertSame(0, find($zeroResult));
    }

    public function testRandom()
    {
        for ($i = 0; $i < 1000; $i++) {
            $evens = [];
            for ($j = 0; $j < rand(3, 100000); $j++) {
                $evens[] = $this->genRandEven();
            }
            $oddValue = $this->genRandEven() + 1;
            $evens[rand(0, count($evens) - 1)] = $oddValue;
            $this->assertSame($oddValue, find($evens));
        }

        for ($i = 0; $i < 1000; $i++) {
            $odds = [];
            for ($j = 0; $j < rand(3, 100000); $j++) {
                $odds[] = $this->genRandEven() + 1;
            }
            $evenValue = $this->genRandEven();
            $odds[rand(0, count($odds) - 1)] = $evenValue;
            $this->assertSame($evenValue, find($odds));
        }

    }
}

function find($integers) {

    $oddIntegers = [];
    $evenIntegers = [];
    foreach ($integers as $catchOutlier) {
        if ($catchOutlier % 2) array_push($oddIntegers, $catchOutlier);
        else array_push($evenIntegers, $catchOutlier);
    }
    return count($evenIntegers) == 1 ? $evenIntegers[0] : $oddIntegers[0];
}

?>