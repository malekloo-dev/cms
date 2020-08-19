<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class export
{
    /**
     * @return siteMap
     */
    public static function create()
    {
        return siteMap::create();
    }
}


/**
 * @method  setLastMod(string $date)
 * @method  setLoc(string $url)
 * @method setPriority(float $priority)
 */

class siteMap
{

    private $fileName;
    protected $collection;

    private $locFieldName;
    private $lastModFieldName;
    private $priorityFieldName;
    private $changefreqFieldName;

    private $defultPriority;
    private $defultChangefreq;

    /**
     * @param $comp_id
     */

    public static function create()
    {
       return new siteMap();
    }

    public static function createIndex()
    {
        return new siteMapIndex();
    }

    //todo add anonymouse function for priroty
    //todo set defult path for url
    public function addByCollection($collection)
    {
        foreach ($collection as $key =>$object) {


            if ($this->locFieldName != '') {

                $loc=$this->locFieldName;
                $property['loc'] = $object->$loc;
            }

            if ($this->lastModFieldName != '') {

                $lastmod=$this->lastModFieldName;
                $property['lastmod'] = $object->$lastmod;
            }

            if ($this->changefreqFieldName != '')
            {
                $changefreq=$this->changefreqFieldName;
                $property['changefreq'] = $object->$changefreq;

            } else if ($this->defultChangefreq != '')
            {
                $property['changefreq'] = $this->defultChangefreq;
            }

            if ($this->priorityFieldName != '')
            {
                $priority=$this->priorityFieldName;
                $property['priority'] = $object->$priority;

            } else if ($this->defultPriority != '') {
                $property['priority'] = $this->defultPriority;
            }
            $this->add($property);


        }

        return $this;
    }

    public function add($property=array())
    {
        $tempObj=new siteMapEntity();

        if(count($property))
        {
            foreach ($property as $property=>$params) {
                $method = 'set' . ucfirst($property);

                if (method_exists($tempObj, $method)) {
                    $tempObj->$method($params);
                }
            }
        }

        $this->collection[]= $tempObj;

        return  $this;
    }

    function __call($method, $params)
    {
        if (method_exists($this->collection[count($this->collection) - 1], $method)) {
            $this->collection[count($this->collection) - 1]->$method($params[0]);
            return $this;

        }
    }


    public function setLocFieldName($fieldName)
    {

        $this->locFieldName=$fieldName;
        return $this;
    }

    public function setLastModFieldName($fieldName)
    {
        $this->lastModFieldName=$fieldName;
        return $this;
    }
    public function setPriorityFieldName($fieldName)
    {
        $this->priorityFieldName=$fieldName;
        return $this;
    }

    public function setChangefreqFieldName($fieldName)
    {
        $this->changefreqFieldName=$fieldName;
        return $this;
    }


    public function setDefultPriority($priority)
    {
        $this->defultPriority=$priority;
        return $this;
    }
    public function setDefultChangefreq($string)
    {
        $this->defultChangefreq=$string;
        return $this;
    }
    public function writeToFile($path)
    {

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $content = $content . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($this->collection as $key => $obj) {

            $content = $content.'<url>' . PHP_EOL;
            $content = $content . '<loc>' . url($obj->getLoc()) . '</loc>' . PHP_EOL;
            $content = $content . '<lastmod>' . date('Y-m-d', strtotime($obj->getLastMod())). '</lastmod>' . PHP_EOL;
            //$content = $content . '<lastmod>' . gmdate(DateTime::W3C, strtotime($obj->getLastMod())) . '</lastmod>' . PHP_EOL;
            $content = $content . '<changefreq>'.$obj->getChangefreq().'</changefreq>' . PHP_EOL;
            $content = $content . '<priority>'.$obj->getPriority().'</priority>' . PHP_EOL;
            $content = $content . '</url>' . PHP_EOL;

        }

        $content = $content . ' </urlset>' . PHP_EOL;


        if (file_put_contents($path, $content)) {
            $result['result'] = 1;
            return $result;
        }
    }



}
class siteMapIndex extends siteMap
{
    public function writeToFile($path)
    {

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;

        $content = $content . ' <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($this->collection as $key => $obj) {


            $content = $content.'<sitemap>' . PHP_EOL;
            $content = $content . '<loc>' . $obj->getLoc() . '</loc>' . PHP_EOL;
            if($obj->getChangefreq()!='')
            {
                $content = $content . '<changefreq>'.$obj->getChangefreq().'</changefreq>' . PHP_EOL;

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
class siteMapEntity
{

    private $lastMod;

    private $loc;

    private $priority;
    private $changefreq;

    public function setLastMod($date)
    {
        $this->lastMod=$date;
        return $this;
    }

    public function setLoc($url)
    {
        $this->loc=$url;
        return $this;
    }

    public function setPriority($priority)
    {
        $this->priority=$priority;
        return $this;
    }
    public function setChangefreq($param)
    {
        $this->changefreq=$param;
        return $this;
    }

    public function getLastMod()
    {

        return $this->lastMod;

    }

    public function getLoc()
    {
        return $this->loc;

    }

    public function getPriority()
    {
        return  $this->priority;
    }
    public function getChangefreq()
    {
        return $this->changefreq;

    }

}
