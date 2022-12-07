<?php
namespace App;

use App\SiteMap;

class SiteMapIndex extends SiteMap
{
    public function writeToFile($path)
    {

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;

        $content = $content . ' <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($this->collection as $key => $obj) {


            $content = $content . '<sitemap>' . PHP_EOL;
            $content = $content . '<loc>' . $obj->getLoc() . '</loc>' . PHP_EOL;
            if ($obj->getChangefreq() != '') {
                $content = $content . '<changefreq>' . $obj->getChangefreq() . '</changefreq>' . PHP_EOL;
            }
            $content = $content . '</sitemap>' . PHP_EOL;
        }


        $content = $content . ' </sitemapindex>' . PHP_EOL;


        if (file_put_contents($path, $content)) {
            $result['result'] = 1;
            return $result;
        }
    }
}
