<?php
declare(strict_types=1);

class QueenAttack
{

    /**
     * This method does not actually "place" the Queen, it just returns if it possible or not to do so. Probably
     * should be named "CanPlaceQueen" or such.
     * @author NDG
     * @param int $i
     * @param int $j
     * @return bool
     * @throws InvalidArgumentException
     *
     */
    public function placeQueen(int $i, int $j): bool
    {
        // Out of bounds
        if ($i<0 || $i >= 8 || $j < 0 || $j >= 8) {
            throw new InvalidArgumentException("Given coordinates are out of board");
        }
        return true;
        // This method should actually do something to private coordinates to modelise a Queen Obecjt
    }

    /**
     * Check if White queen ($white) can attack black queen ($black)
     * @author NDG
     * @param  int[]  $white  Coordinates of the white Queen
     * @param  int[]  $black  Coordinates of the black Queen
     * @return bool
     * @throws InvalidArgumentException
     */
    public function canAttack(array $white, array $black): bool
    {
        // Assert we can later access $white[0] & $white[1]
        if (count($white) != 2 || count($black) != 2) {
            throw new InvalidArgumentException("Invalid format for coordinates, arrayof size (2) expected");
        }

        $v = [0, 1, 2, 3, 4, 5, 6, 7];

        // Valid coordinates?
        if (!in_array($white[0], $v) || !in_array($white[1], $v) || !in_array($black[0], $v) || !in_array($black[1], $v)) {
            throw new InvalidArgumentException("Given coordinates are Incorrect (invalid format or out of 8x8 grid");
        }

        // Now check if B position = W position (that would an error i guess)
        if ($white[0] == $black[0] && $white[1] == $black[1]) {
            throw new InvalidArgumentException("Given queens can not be on the same spot");
        }

        // Now check if they can attack each others (same column or same row)
        if ($white[0] == $black[0] || $white[1] == $black[1]) {
            return true;
        }

        // Check if same diagonal (best algo considering a NxN grid complexity : O(1)
		$diff = abs($white[0] - $black[0]);
		if ($white[0] + $diff == $black[1] || $white[0] - $diff == $black[1]) {
			return true;
		}		

        // Otherwise
        return false;
    }
}
