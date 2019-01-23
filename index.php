<?php declare(strict_types=1);

/**
 * @param string $a
 * @param string $b
 * @return string
 */
function sum(string $a, string $b) : string
{
    if (preg_match('/\D/', $a . $b)) {
        return 'Incorrect number format';
    }

    $lengthA = strlen($a);
    $lengthB = strlen($b);

    $maxLength = max($lengthA, $lengthB);
    ($maxLength === $lengthA)?
        ($b = str_pad($b, $maxLength, '0', STR_PAD_LEFT)) :
        ($a = str_pad($a, $maxLength, '0', STR_PAD_LEFT));

    $extra = 0;
    $i = $maxLength-1;
    while($i >= 0 ) {
        $extra += $a[$i] + $b[$i];
        $a[$i] = $extra % 10;
        $extra = ($extra - $a[$i]) / 10;
        $i--;
    }

    $result = ltrim($extra . $a, '0');
    return  strlen($result)? $result : '0';
}

/* TESTS */
echo sum('aa', '99') . PHP_EOL; // ERROR
echo sum('0000', '000000') . PHP_EOL; // '0'
echo sum('0010', '100') . PHP_EOL; // '110'
echo sum('100', '0010') . PHP_EOL; // '110'
echo sum('11111111111111111111111111111111111111111111111111', '22222222222222222222222223333333333333333333333333') . PHP_EOL; // '33333333333333333333333334444444444444444444444444'
echo sum('6789678967896789678967896789678967896789678967896789', '9876987698769876987698769876987698769876987698769876') . PHP_EOL; // '16666666666666666666666666666666666666666666666666665'
