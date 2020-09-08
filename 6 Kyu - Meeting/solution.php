<?php

function cmp_9340($a, $b) {
    if ($a[1] == $b[1]) {
        return $a[0] < $b[0] ? -1 : 1;
    }
    return $a[1] < $b[1] ? -1 : 1;
}

class MeetingTestCases extends TestCase {

    public function dotest($s, $expect) {
        printf("s: %s\r\n", $s);
        $actual = meeting($s);
        printf("Actual: %s\r\n", $actual);
        printf("Expect: %s\r\n", $expect);
        $this->assertEquals($expect, $actual);
        printf("%s\r\n", "-");
    }

    public function testBasics() {
        $this->dotest("Alexis:Wahl;John:Bell;Victoria:Schwarz;Abba:Dorny;Grace:Meta;Ann:Arno;Madison:STAN;Alex:Cornwell;Lewis:KERN;Megan:Stan;Alex:Korn",
            "(ARNO, ANN)(BELL, JOHN)(CORNWELL, ALEX)(DORNY, ABBA)(KERN, LEWIS)(KORN, ALEX)(META, GRACE)(SCHWARZ, VICTORIA)(STAN, MADISON)(STAN, MEGAN)(WAHL, ALEXIS)");
        $this->dotest("John:Gates;Michael:Wahl;Megan:Bell;Paul:Dorries;James:Dorny;Lewis:Steve;Alex:Meta;Elizabeth:Russel;Anna:Korn;Ann:Kern;Amber:Cornwell",
            "(BELL, MEGAN)(CORNWELL, AMBER)(DORNY, JAMES)(DORRIES, PAUL)(GATES, JOHN)(KERN, ANN)(KORN, ANNA)(META, ALEX)(RUSSEL, ELIZABETH)(STEVE, LEWIS)(WAHL, MICHAEL)");
        $this->dotest("Alex:Arno;Alissa:Cornwell;Sarah:Bell;Andrew:Dorries;Ann:Kern;Haley:Arno;Paul:Dorny;Madison:Kern",
            "(ARNO, ALEX)(ARNO, HALEY)(BELL, SARAH)(CORNWELL, ALISSA)(DORNY, PAUL)(DORRIES, ANDREW)(KERN, ANN)(KERN, MADISON)");
        $this->dotest("Anna:Wahl;Grace:Gates;James:Russell;Elizabeth:Rudd;Victoria:STAN;Jacob:Wahl;Alex:Wahl;Antony:Gates;Alissa:Meta;Megan:Bell;Amandy:Stan;Anna:Steve",
            "(BELL, MEGAN)(GATES, ANTONY)(GATES, GRACE)(META, ALISSA)(RUDD, ELIZABETH)(RUSSELL, JAMES)(STAN, AMANDY)(STAN, VICTORIA)(STEVE, ANNA)(WAHL, ALEX)(WAHL, ANNA)(WAHL, JACOB)");
        $this->dotest("Ann:Russel;John:Gates;Paul:Wahl;Alex:Tolkien;Ann:Bell;Lewis:Kern;Sarah:Rudd;Sydney:Korn;Madison:Meta",
            "(BELL, ANN)(GATES, JOHN)(KERN, LEWIS)(KORN, SYDNEY)(META, MADISON)(RUDD, SARAH)(RUSSEL, ANN)(TOLKIEN, ALEX)(WAHL, PAUL)");
        $this->dotest("Paul:Arno;Matthew:Schwarz;Amandy:Meta;Grace:Meta;Ann:Arno;Alex:Schwarz;Jacob:Rudd;Amber:Cornwell",
            "(ARNO, ANN)(ARNO, PAUL)(CORNWELL, AMBER)(META, AMANDY)(META, GRACE)(RUDD, JACOB)(SCHWARZ, ALEX)(SCHWARZ, MATTHEW)");
        $this->dotest("Abba:Bell;Lewis:Cornwell;Jacob:STAN;Matthew:Schwarz;Ann:STAN;Sophia:Gates;Victoria:Korn;Anna:Bell;Paul:Kern;Alissa:Tolkien",
            "(BELL, ABBA)(BELL, ANNA)(CORNWELL, LEWIS)(GATES, SOPHIA)(KERN, PAUL)(KORN, VICTORIA)(SCHWARZ, MATTHEW)(STAN, ANN)(STAN, JACOB)(TOLKIEN, ALISSA)");
        $this->dotest("Victoria:Thorensen;Ann:Arno;Alexis:Wahl;Emily:Stan;Anna:STAN;Jacob:Korn;Sophia:Gates;Amber:Kern",
            "(ARNO, ANN)(GATES, SOPHIA)(KERN, AMBER)(KORN, JACOB)(STAN, ANNA)(STAN, EMILY)(THORENSEN, VICTORIA)(WAHL, ALEXIS)");
        $this->dotest("Andrew:Arno;Jacob:Russell;Anna:STAN;Antony:Gates;Amber:Korn;Lewis:Dorries;Ann:Burroughs;Alex:Kern;Anna:Arno;Elizabeth:Kern;John:Schwarz;Sarah:STAN",
            "(ARNO, ANDREW)(ARNO, ANNA)(BURROUGHS, ANN)(DORRIES, LEWIS)(GATES, ANTONY)(KERN, ALEX)(KERN, ELIZABETH)(KORN, AMBER)(RUSSELL, JACOB)(SCHWARZ, JOHN)(STAN, ANNA)(STAN, SARAH)");
        $this->dotest("Megan:Wahl;Alexis:Arno;Alex:Wahl;Grace:STAN;Amber:Kern;Amandy:Schwarz;Alissa:Stan;Paul:Kern;Ann:Meta;Lewis:Burroughs;Andrew:Bell",
            "(ARNO, ALEXIS)(BELL, ANDREW)(BURROUGHS, LEWIS)(KERN, AMBER)(KERN, PAUL)(META, ANN)(SCHWARZ, AMANDY)(STAN, ALISSA)(STAN, GRACE)(WAHL, ALEX)(WAHL, MEGAN)");
    }

    private function combine($k) {
        $fnams=array("Emily", "Sophia", "Anna", "Anna", "Sarah", "Michael", "Jacob", "Alex", "Alex", "Alex", "Antony", "John",
            "Matthew", "Andrew", "Paul", "Paul", "Ann", "Ann", "Ann", "Ann", "Robert", "Megan", "Alissa", "Alexis",
            "Grace", "Madison", "Elizabeth", "James", "Amandy", "Abba", "Victoria", "Amber", "Sydney", "Haley", "Lewis");
        $names=array("Korn", "Arno", "Arno", "Bell", "Bell", "Kern", "Kern", "Kern", "Russel", "Meta", "Meta", "Meta",
            "Cornwell", "Cornwell", "Wahl", "Wahl", "Wahl", "Wahl", "Dorny", "Dorries", "Stan", "STAN", "STAN", "Thorensen",
            "Schwarz", "Schwarz", "Gates", "Steve", "Tolkien", "Burroughs", "Gates", "Bell", "Korn", "Russell", "Rudd");

        shuffle($fnams); shuffle($names);
        $i = 0; $res = "";
        while ($i < $k) {
            $res .= $fnams[$i] . ":" . $names[$i] . ";";
            $i++;
        }
        return substr($res, 0, strlen($res) - 2);
    }

    private function meetingD($s) {
        $x = array_map(function($a) {return explode(":", $a);}, explode(";", strtoupper($s)));
        usort($x, "cmp_9340");
        return implode("", array_map(function($a) {return "(" . $a[1] . ", " . $a[0] . ")";}, $x));
    }

    public function testRandom() {
        for($i = 0; $i < 100; $i++) {
            $s = $this->combine(rand(6, 12));
            $sol = $this->meetingD($s);
            $this->dotest($s, $sol);
        }
    }
}

function meeting($s) {
    $resultUppercase = array_filter(explode(';',preg_replace('/(\w*)\:(\w*);?/m', '$2, $1;', $s)));
    natcasesort($resultUppercase);
    return '(' . strtoupper(implode(')(', $resultUppercase)) . ')';
}

function meeting($s) {
    $resultUppercase = array_filter(explode(';',preg_replace('/(\w*)\:(\w*);?/m', '$2, $1;', $s)));
    natcasesort($resultUppercase);
    return '(' . strtoupper(implode(')(', $resultUppercase)) . ')';
}

?>