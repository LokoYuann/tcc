
const BOARD_SIZE = 10; //10x10 board
const SUBMARINE = 1;
const DESTROYER = 2;
const BATTLESHIP = 3;
const AIRCRAFTCARRIER = 4;

$ships_available = [];
//populate with some data based on game rule
array_push($ships_available, SUBMARINE);
array_push($ships_available, SUBMARINE);
array_push($ships_available, DESTROYER);
array_push($ships_available, DESTROYER);
array_push($ships_available, DESTROYER);
array_push($ships_available, BATTLESHIP);
array_push($ships_available, BATTLESHIP);
array_push($ships_available, AIRCRAFTCARRIER);

$board = [];

while(count($ships_available) > 0) {
    deployShip($board, $ships_available);
}

$lastColumnLetter = chr(ord('A')+ BOARD_SIZE-1);

//print table
echo "<table border='1' align='center'>";
echo "<tr><td></td><td>".implode('</td><td>',range(1, BOARD_SIZE))."</td></tr>";
for($i = 'A'; $i <= $lastColumnLetter; $i++) {
    echo "<tr><td>".$i."</td>";
    for($j=0; $j < BOARD_SIZE; $j++) {
        echo "<td align='center'>";
        echo $board[$i][$j] ?? '&nbsp;&nbsp;&nbsp;&nbsp;';
        echo "</td>";
    }
    echo "</tr>";
}
echo "</table>";
exit;

function array_merge_custom($array1, $array2) {
    foreach($array2 as $key => $value) {
        foreach($value as $k => $v) {
            $array1[$key][$k] = $v;
        }
    }
    return $array1;
}

function deployShip(&$board, &$ships_available) {
    $randomShipKey = array_rand($ships_available);
    $ship = $ships_available[$randomShipKey];
    $beginCoordinates = getRandomCoordinates();
    $coordinates = getShipCoordinates($board, $beginCoordinates, $ship);

    if(!$coordinates) {
        return false;
    }

    unset($ships_available[$randomShipKey]);
    $board = array_merge_custom($board,$coordinates);
}

function getRowNumberByLetter($letter) {
    return array_search($letter, range('A','Z'));
}

function getRowLetterByNumber($number) {
    $letters = range('A','Z');
    return $letters[$number];
}

function getRandomCoordinates() {
    return ['row' => chr(mt_rand(ord('A'), (ord('A') + BOARD_SIZE-1))), 'col' => mt_rand(0,BOARD_SIZE -1)];
}

function getShipCoordinates($board, $beginCoordinates, $ship) {
    if(isset($board[$beginCoordinates['row']][$beginCoordinates['col']])) {
        return false; //anchor position already taken
    }
    if($ship == 1) {
        $return[$beginCoordinates['row']][$beginCoordinates['col']] = 1;
        return $return;
    }

    $shipArraySize = $ship -1;
    $directions = ['left', 'right', 'up', 'down'];
    $tries = 10;
    while($tries > 0) {
        $tries--;
        $direction = $directions[array_rand($directions)];
        $return = [];
        switch($direction) {
            case 'left':
                if(($beginCoordinates['col'] - $shipArraySize) < 0) { //check if can go left
                    break;
                }
                for($colBegin = ($beginCoordinates['col'] - $shipArraySize), $colEnd = $beginCoordinates['col']; $colBegin <= $colEnd; $colBegin++) {
                    if(!empty($board[$beginCoordinates['row']][$colBegin])) {
                        break 2;
                    } else {
                        $return[$beginCoordinates['row']][$colBegin] = $ship;
                    }
                }
                return $return;
            case 'right':
                if(($beginCoordinates['col'] + $shipArraySize) > BOARD_SIZE -1) { //check if can go right
                    break;
                }
                for($colBegin = $beginCoordinates['col'], $colEnd = ($beginCoordinates['col'] + $shipArraySize); $colBegin <= $colEnd; $colBegin++) {
                    if(!empty($board[$beginCoordinates['row']][$colEnd])) {
                        break 2;
                    } else {
                        $return[$beginCoordinates['row']][$colBegin] = $ship;
                    }
                }
                return $return;
            case 'up':
                if((getRowNumberByLetter($beginCoordinates['row']) - $shipArraySize) < 0) { //check if can go up
                    break;
                }
                for($rowBegin = (getRowNumberByLetter($beginCoordinates['row']) - $shipArraySize), $rowEnd = getRowNumberByLetter($beginCoordinates['row']); $rowBegin <= $rowEnd; $rowBegin++) {
                    if(!empty($board[getRowLetterByNumber($rowBegin)][$beginCoordinates['col']])) {
                        break 2;
                    } else {
                        $return[getRowLetterByNumber($rowBegin)][$beginCoordinates['col']] = $ship;
                    }
                }
                return $return;
            case 'down':
                if((getRowNumberByLetter($beginCoordinates['row']) + $shipArraySize) > BOARD_SIZE -1) { //check if can go down
                    break;
                }
                for($rowBegin = getRowNumberByLetter($beginCoordinates['row']), $rowEnd = (getRowNumberByLetter($beginCoordinates['row']) + $shipArraySize); $rowBegin <= $rowEnd; $rowBegin++) {
                    if(!empty($board[getRowLetterByNumber($rowBegin)][$beginCoordinates['col']])) {
                        break 2;
                    } else {
                        $return[getRowLetterByNumber($rowBegin)][$beginCoordinates['col']] = $ship;
                    }
                }
                return $return;
        }
    }

    return false;
}
