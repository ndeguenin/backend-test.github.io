<?php
declare(strict_types=1);

class Luhn
{
    /**
     * @author NDG
     * Check if $str is a valid "Luhn" number
     * @param string $str
     * @return bool
     */
    public function isValid(string $str): bool
    {
        // Remove spaces
        $sNumber = str_replace(' ', '', $str);
        // Assert all Digits in number
        if(!ctype_digit($sNumber)) {
            return false;
        }

        // Doubling numbers & computing sum
        $iSum = 0;
        for ($i=strlen($sNumber)-1; $i>=0; $i--){
            // Adding every 2 digits value
            if ($i%2 == 0){
                $iSum += ($sNumber[$i] * 2 > 9) ? ($sNumber[$i] * 2) - 9 : $sNumber[$i] * 2;
            } else {
                $iSum += $sNumber[$i];
            }
        }

        // Check sum is multiple of 10
        return ($iSum%10 == 0);
    }
}
