<?php
namespace App;

use App\SiteMap;

class Export
{
    /**
     * @return SiteMap
     */
    public static function create()
    {
        return SiteMap::create();
    }
}

