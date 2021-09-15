<?php
/**
 * Created by PhpStorm.
 * User: fardin
 * Date: 12/6/18
 * Time: 11:50 AM
 */

namespace App\Models;

trait FilterBuilder
{
    private $request;
    private $properties;

    private function addWhereLike(&$query, $property, $value)
    {
        $query->where($property, 'like', '%' . $value . '%');
    }

    private function addWhereEq(&$query, $property, $value)
    {
        $query->where($property, '=', $value);
    }

    private function addLimit(&$query)
    {
        $query->offset($this->request['start'])->limit($this->request['limit']);
    }

    private function addWhere(&$query)
    {
        if (isset($this->request['filter'])) {

            $_filter = json_decode(urldecode($this->request['filter']));

            foreach ($_filter as $key => $filter) {
                $methodName = 'addWhere' . ucfirst($filter->operator);

                if (in_array($filter->property, $this->properties)) {
                    if (method_exists($this, $methodName)) {
                        $this->$methodName($query, $filter->property, $filter->value);
                    }

                }

            }
        }
    }

    private function addOrderBy(&$query)
    {
        if (isset($request['dir'])) {
            $query->orderBy($this->request['sort'], $this->request['dir']);
        }
    }

    function setRequest($request)
    {

        $this->request = $request;
        if(!isset($this->request['start']) or (!isset($this->request['limit']))){
            $this->request['start'] = 0;
            $this->request['limit'] = 10;
        }

    }

    function setProperties($properties)
    {
        $this->properties = $properties;
    }

    function scopeFilter($query, $request, $properties)
    {
        //print_r($properties);
        //die();

        $this->setRequest($request);
        $this->setProperties($properties);

        $this->addWhere($query);

        $obj = clone $query;
        $totalCount = $obj->count();

        $this->addLimit($query);
        $this->addOrderBy($query);
        $query = $query->get();

        if (count($query) > 0) {
            //$query->push(['totalCount' => $totalCount , 'success' => true]);
            //$query = $query->toBase();
            //$query->push(['totalCount' => $totalCount]);
            //$query->put('totalCount', $totalCount );

            //$query->combine(['George', 29]);
            //$combined = $query->combine(['George', 29]);

            //$query->all();
             //$query->all();
            //dd($query);

            //echo '<pre/>';
            //print_r($query);
            ///die();
//            $result=collect(['data' => $query, 'totalCount' => $totalCount , 'success' => 'true']);
            $result['data'] = $query;
            $result['totalCount'] = $totalCount;
            $result['success'] = 'true';
        } else {
            //$query->push(['success' => false , 'data' => null]);
            //$query->all();
//           $result=collect(['success' => false , 'data' => null]);
            $result['success'] = 'false';
            $result['totalCount'] = 0;
            $result['data'] = array();
        }


        return $result;
    }

    function filter($query, $request, $properties)
    {

        return $this->scopeFilter($query, $request, $properties);

    }

}
