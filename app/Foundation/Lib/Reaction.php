<?php

namespace Foundation\Lib;

use Kiranti\Supports\BaseConstant;

/**
 * Class Reaction
 * @package Foundation\Lib
 */
final class Reaction extends BaseConstant
{

    /**
     * Reaction Happy
     */
    const REACTION_HAPPY = 0;

    /**
     * Reaction Sad
     */
    const REACTION_SAD = 1;

    /**
     * Reaction Excited
     */
    const REACTION_EXCITED = 2;

    /**
     * Reaction Sleepy
     */
    const REACTION_SLEEPY = 3;

    /**
     * Reaction Angry
     */
    const REACTION_ANGRY = 4;

    /**
     * Reaction Surprise
     */
    const REACTION_SURPRISE = 5;

    /**
     * @var $current
     */
    public static $current = [
        self::REACTION_HAPPY     => 'Happy',
        self::REACTION_SAD       => 'Sad',
        self::REACTION_EXCITED   => 'Excited',
//        self::REACTION_SLEEPY    => 'Sleepy',
        self::REACTION_ANGRY     => 'Angry',
        self::REACTION_SURPRISE  => 'Surprise'
    ];

}
