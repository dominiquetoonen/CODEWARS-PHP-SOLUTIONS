<?php

class MyTestCases extends TestCase
{
    public function testFromExample() {
        $this->assertEquals('HEY JUDE', decode_morse('.... . -.--   .--- ..- -.. .'));
    }

    public function testBasicCases() {
        $this->assertEquals('A', decode_morse('.-'));
        $this->assertEquals('E', decode_morse('.'));
        $this->assertEquals('I', decode_morse('..'));
        $this->assertEquals('EE', decode_morse('. .'));
        $this->assertEquals('E E', decode_morse('.   .'));
        $this->assertEquals('SOS', decode_morse('...---...'));
        $this->assertEquals('SOS', decode_morse('... --- ...'));
        $this->assertEquals('S O S', decode_morse('...   ---   ...'));
    }

    public function testComplexCases()
    {
        $this->assertEquals('E', decode_morse(' . '));
        $this->assertEquals('E E', decode_morse('   .   . '));
        $this->assertEquals('SOS! THE QUICK BROWN FOX JUMPS OVER THE LAZY DOG.', decode_morse('      ...---... -.-.--   - .... .   --.- ..- .. -.-. -.-   -... .-. --- .-- -.   ..-. --- -..-   .--- ..- -- .--. ...   --- ...- . .-.   - .... .   .-.. .- --.. -.--   -.. --- --. .-.-.-     '));
    }
}

function decode_morse(string $code): string {
    $morseDictionary = [
        "A"=>".-",
        "B"=>"-...",
        "C"=>"-.-.",
        "D"=>"-..",
        "E"=>".",
        "F"=>"..-.",
        "G"=>"--.",
        "H"=>"....",
        "I"=>"..",
        "J"=>".---",
        "K"=>"-.-",
        "L"=>".-..",
        "M"=>"--",
        "N"=>"-.",
        "O"=>"---",
        "P"=>".--.",
        "Q"=>"--.-",
        "R"=>".-.",
        "S"=>"...",
        "T"=>"-",
        "U"=>"..-",
        "V"=>"...-",
        "W"=>".--",
        "X"=>"-..-",
        "Y"=>"-.--",
        "Z"=>"--..",
        "0"=>"-----",
        "1"=>".----",
        "2"=>"..---",
        "3"=>"...--",
        "4"=>"....-",
        "5"=>".....",
        "6"=>"-....",
        "7"=>"--...",
        "8"=>"---..",
        "9"=>"----.",
        "."=>".-.-.-",
        ","=>"--..--",
        "?"=>"..--..",
        "!"=>"-.-.--",
        "/"=>"-..-.",
        "SOS"=>"...---...",
        " "=>""];

    $morseTranslate = '';
    $heyJude = explode(' ', $code);
    for ($i = 0; $i < count($heyJude); $i++)
    {
        foreach ($morseDictionary as $key => $value)
        {
            if ($value == $heyJude[$i])
                $morseTranslate .= $key;
        }
    }
    $morseTranslate = trim(preg_replace('/[^\S\r\n]+/', ' ', $morseTranslate));
    return $morseTranslate;
}

?>