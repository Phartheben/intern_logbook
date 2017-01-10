<?php
namespace App\Vetter\Helpers;

if(!isset($PROPEL_CON))
    $PROPEL_CON = null;

class PropelHelper
{
    public static function propelDebug($name = 'orm')
    {
        global $PROPEL_CON;

        $PROPEL_CON = \Propel::getConnection($name);
        $PROPEL_CON->useDebug(true);
    }

    public static function propelQuery()
    {
        global $PROPEL_CON;

        if(isset($PROPEL_CON))
        {
            $executed_query = $PROPEL_CON->getLastExecutedQuery();

            return $executed_query;
        }

        return false;
    }
}