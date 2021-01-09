<?php

// Copyright 2020 Jeffrey Harris

declare(strict_types=1);

namespace Entombed;

/**
 * Class MazeEnum
 *
 * Magic array comes from https://arxiv.org/ftp/arxiv/papers/1811/1811.02035.pdf
 *
 * @package Entombed
 *
 */
class MagicEnum
{
    public const NO_WALL_BIT = 0;
    public const RANDOM_BIT = 2;
    public const WALL_BIT = 1;
    public const MAGIC = [
        0b00000 => [
            0b000 => self::WALL_BIT,
            0b001 => self::WALL_BIT,
            0b010 => self::WALL_BIT,
            0b011 => self::RANDOM_BIT,
            0b100 => self::NO_WALL_BIT,
            0b101 => self::NO_WALL_BIT,
            0b110 => self::RANDOM_BIT,
            0b111 => self::RANDOM_BIT,
        ],
        0b00001 => [
            0b000 => self::WALL_BIT,
            0b001 => self::WALL_BIT,
            0b010 => self::WALL_BIT,
            0b011 => self::WALL_BIT,
            0b100 => self::RANDOM_BIT,
            0b101 => self::NO_WALL_BIT,
            0b110 => self::NO_WALL_BIT,
            0b111 => self::NO_WALL_BIT,
        ],
        0b00010 => [
            0b000 => self::WALL_BIT,
            0b001 => self::WALL_BIT,
            0b010 => self::WALL_BIT,
            0b011 => self::RANDOM_BIT,
            0b100 => self::NO_WALL_BIT,
            0b101 => self::NO_WALL_BIT,
            0b110 => self::NO_WALL_BIT,
            0b111 => self::NO_WALL_BIT,
        ],
        0b00011 => [
            0b000 => self::RANDOM_BIT,
            0b001 => self::NO_WALL_BIT,
            0b010 => self::WALL_BIT,
            0b011 => self::RANDOM_BIT,
            0b100 => self::RANDOM_BIT,
            0b101 => self::NO_WALL_BIT,
            0b110 => self::NO_WALL_BIT,
            0b111 => self::NO_WALL_BIT,
        ],
    ];
}
