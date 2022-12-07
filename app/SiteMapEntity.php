<?php
namespace App;

class SiteMapEntity
{

    private $lastMod;
    private $loc;
    private $priority;
    private $changefreq;

    public function setLastMod($date)
    {
        $this->lastMod = $date;
        return $this;
    }

    public function setLoc($url)
    {
        $this->loc = $url;
        return $this;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }

    public function setChangefreq($param)
    {
        $this->changefreq = $param;
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
        return $this->priority;
    }

    public function getChangefreq()
    {
        return $this->changefreq;
    }
}
