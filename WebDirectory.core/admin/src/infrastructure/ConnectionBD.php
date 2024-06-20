<?php

namespace WebDirectory\admin\infrastructure;

use Illuminate\Database\Capsule\Manager as DB;

class ConnectionBD
{
    static function init(string $iniFile)
    {
        $db = new DB();
        $db->addConnection(parse_ini_file($iniFile));
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}
