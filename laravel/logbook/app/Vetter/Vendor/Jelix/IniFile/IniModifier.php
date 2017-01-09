<?php

namespace App\Vetter\Vendor\Jelix\IniFile;

class IniModifier extends \Jelix\IniFile\IniModifier {

    protected function getIniValue($value)
    {
        if ($value === '' || is_numeric(trim($value)) || (preg_match("/^[\w-.]*$/", $value) && strpos("\n",$value) === false) ) {
            return $value;
        } else if ($value === false) {
            $value = "0";
        } else if ($value === true) {
            $value = "1";
        } else {
            $value = $value;
        }

        return $value;
    }

}

