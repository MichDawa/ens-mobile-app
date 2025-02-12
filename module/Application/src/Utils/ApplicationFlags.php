<?php

namespace Application\Utils;

class ApplicationFlags {

    const NO = 0;
    const YES = 1;

    public static function toString($flag) {
        return ($flag === self::YES ? "TRUE" : "FALSE");
    }

}
