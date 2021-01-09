<?php

// Copyright 2020 Jeffrey Harris

declare(strict_types=1);

namespace Entombed;

class RowOutput
{
    public const MAX_MAZE_HEIGHT = 11;

    /**
     * @return int
     */
    private static function leftRandomBit(): int
    {
        return self::getRandomBit();
    }

    /**
     * @return int
     */
    private static function rightRandomBit(): int
    {
        return self::getRandomBit();
    }

    /**
     * @return int
     */
    private static function midRandomBit(): int
    {
        return self::getRandomBit();
    }

    /**
     * @return int
     */
    private static function getRandomBit(): int
    {
        /** @noinspection RandomApiMigrationInspection */
        return rand(0, 1);
    }

    /**
     * @param int $seed
     * @return string
     */
    private static function prrow(int $seed): string
    {
        $output = '';
        for ($i = 0; $i < 8; ++$i) {
            if ($seed & 1) {
                $output = 'XX' . $output;
            } else {
                $output = '__' . $output;
            }
            $seed >>= 1;
        }
        $output = 'XXXX' . $output;

        return $output . strrev($output);
    }

    /**
     * @param $lastRows
     * @return array
     */
    public static function rowgen(array $lastRows): array
    {
        // Prepend and append random bits to last row
        $lastRowPadded = self::leftRandomBit();
        $lastRowPadded <<= 8;
        $lastRowPadded |= $lastRows[array_key_last($lastRows)];
        $lastRowPadded <<= 1;
        $lastRowPadded |= self::rightRandomBit();

        // Last two bits generated in current row, initial value = 0b10 (2 decimal)
        $lastTwo = 0b10;
        $newRow = 0;

        # Iterate from 7 to 0 inclusive
        foreach (range(7, 0, -1) as $i) {
            $threeAbove = ($lastRowPadded >> $i) & 0b111;
            $newBit = MagicEnum::MAGIC[$lastTwo][$threeAbove];
            if ($newBit === MagicEnum::RANDOM_BIT) {
                $newBit = self::midRandomBit();
            }
            $newRow = ($newRow << 1) | $newBit;
            $lastTwo = (($lastTwo << 1) | $newBit) && 0b11;
        }

        // Hook for verification
        self::generated($newRow);

        // Now do post-processing
        $lastRows[] = $newRow;
        $lastRows = array_slice($lastRows, -self::MAX_MAZE_HEIGHT);

        // Post-processing condition 1
        $history = [];
        foreach ($lastRows as $row) {
            $history[] = $row & 0xf0;
        }
        if (!in_array(0, $history, true)) {
            $sum = 0;
            foreach ($history as $row) {
                $sum += $row & 0x80;
            }
            if ($sum === 0) {
                $lastRows[array_key_last($lastRows)] = 0;
            }
        }

        // Post-processing condition 2
        $history = array_slice($lastRows, -7);
        if (!in_array(0, $history, true)) {
            $comparator = 0;
            if (count($lastRows) >= 9) {
                $comparator = array_slice($lastRows, -9, 1);
            }
            $sum = 0;
            foreach ($history as $row) {
                $sum += $row & 1;
            }
            if ($sum === ($comparator & 1) * 7) {
                $lastRows[array_key_last($lastRows)] &= 0xf0;
            }
        }
        echo self::prrow($lastRows[array_key_last($lastRows)]);

        return $lastRows;
    }

    /**
     * @param int $newRow
     */
    public static function generated(int $newRow)
    {
        return;
    }
}
