<?php

namespace App\Services;

use App\Models\Role;
use App\Models\spider;
use CURLFile;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use phpDocumentor\Reflection\Types\This;


class wpService
{

    protected $role;

    public function __construct()
    {
        // $this->role = $role;
    }

    public function getproduct()
    {
        $url='https://garmgah.com/wp-json/wp/v2/product/?page=3';
        $url='https://garmgah.com/wp-json/wp/v2/product/?slug=%D8%AF%DB%8C%DA%AF-%DA%86%D8%AF%D9%86%DB%8C-%D8%AA%D9%88%D8%B1%D8%A8%D9%88-13-%D9%BE%D8%B1%D9%87-%D8%B4%D9%88%D9%81%D8%A7%DA%98%DA%A9%D8%A7%D8%B1';
        //$url='https://garmgah.com/wp-json/wc/v3/products/';
        $url='https://garmgah.com/wp-json/wc/v3/products/2548';
        //$url=' https://example.com/wp-json/wc/v3/products/1949/variations';
        //$url=' https://example.com/wp-json/wc/v3/products/attributes/';


        $respone=$this->get_web_page($url);
        dd(json_decode($respone['content']));
    }
    public function get_web_page( $url )
    {

        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => "spider", // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false ,   // Disabled SSL Cert checks
            CURLOPT_HTTPHEADER => array(
        "authorization: Basic Y2tfODFiNDNjODgwODgxNmMzNmUyMWU4ZDJlYTlmNjQ5M2UyZjAzNmU4Yzpjc185NmI0NWNjMzlmYTkzOTgxODJjNTc2MjM5NDdmYjgyMDk5NDlkYTFh",
        "cache-control: no-cache",
        "postman-token: dcb63ae9-cbc9-e748-4eb9-de612a0ba42d")
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
    }

    public static function addToCms($request)
    {

        //return $request->file('images');
        //return $request->file('files');
        $result = app('App\Http\Controllers\ContentController')->storeService($request);
        return $result;
    }

    public static function build_query($arrays, &$new = array(), $prefix = null)
    {

        if (is_object($arrays)) {
            $arrays = get_object_vars($arrays);
        }

        foreach ($arrays as $key => $value) {
            $k = isset($prefix) ? $prefix . '[' . $key . ']' : $key;
            if (is_array($value) or is_object($value)) {
                self::build_query($value, $new, $k);
            } else {
                $new[$k] = $value;
            }
        }
    }


    public static function attrToDescription($attr)
    {
        $des = '<p>{attr}</p>';
        foreach ($attr as $key => $fields) {
            $des = $des . '<p>' . $fields['field'] . '</p>';
            $des = $des . '<p>' . $fields['value'] . '</p>';
        }
        $des = $des . '<p>{/attr}</p>';
        return $des;
    }
    public static function attrToBrief_description($attr)
    {

        $rand_keys = array_rand($attr, 4);

        $des = '';
        foreach ($rand_keys as $key => $arrkey) {
            $des = $des . ' <p> ' . $attr[$arrkey]['field'] . ' : ';
            $des = $des . ' ' . $attr[$arrkey]['value'] . ' </p> ';
        }
        return $des;
    }
    public static function titleToMeta_keywords($title)
    {
        return $title . ',' . 'قیمت ' . $title . ',' . 'مشخصات ' . $title . ',';
    }
    public static function titleToMeta_title($title)
    {
        return ' قیمت روز و مشخصات کامل ' . $title . ' | ' . 'درب کالا ';
    }


    public static function attrToMeta_description($title, $attr)
    {
        $count = 1;
        $des = ' قیمت روز و مشخصات کامل ' . $title . ',';

        foreach ($attr as $key => $fields) {

            $des = $des . '،' . $fields['field'] . ' : ';
            $des = $des . $fields['value'] . ' ،';
            if ($count == 4) {
                return $des;
            }
            $count++;
        }
        return $des;
    }

    /**
     * @return mixed
     */
    public static function reload()
    {

        $list = spider::all();
        foreach ($list as $key => $val) {

            //$image=file_get_contents($val->image);

            $mimetype = mime_content_type(public_path($val->image));

            $output = new CURLFile(public_path($val->image), $mimetype, basename(public_path($val->image)));
            $data = array(
                'title' => $val->title,
                'parent_id' => ['44'],
                'brief_description' => self::attrToBrief_description($val->attr),
                'description' => self::attrToDescription($val->attr),
                'meta_keywords' => self::titleToMeta_keywords($val->title),
                'meta_title' => self::titleToMeta_title($val->title),
                'meta_description' => self::attrToMeta_description($val->title, $val->attr),
                'viewCount' => 1,
                'viewCount' => 1,
                'commentCount' => 1,
                'attr_type' => 'product',
                'attr' => array("brand" => "dorsam", "price" => convertNumToEn($val->price), "rate" => "4", "offer_price" => "10"),
                'attr_type' => 'product',
                'publish_date' => '۱۳۹۱/۱۱/۱۳',
                'status' => '1'
            );



            //$data= http_build_query($data);
            $post = array();
            self::build_query($data, $post);
            $post["images"] = $output;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
            curl_setopt($ch, CURLOPT_URL, 'https://'.request()->getHost() . '/api/spider/addToCms');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 50);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            //curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);


            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                $result = curl_error($ch);
            }
            curl_close($ch);
            //dd($result);
            // print_r($result);

            //            return $result;
            //
            //
            //            $http = new Client;
            //            $response = $http->post(
            //                request()->getHost() .'/api/spider/addToCms', [
            //                'headers' => [
            //                    'Accept'=> 'application/json',
            //                   // 'Content-Type'=> 'multipart/form-data'
            //                ],
            //                'multipart' => [
            //                    [
            //                        'name'     => 'images',
            //                        'contents' => $image,
            //                        'filename' => '0.jpg'
            //                    ],
            //                ],
            //            ]
            //            );
            //            return $response->getBody()->getContents();
            //
            //
            //            //return $image;
            //
            //            $http = new Client;
            //            $response = $http->request('POST', request()->getHost() . '/api/spider/addToCms', [
            //                'headers' => [
            //                    'Accept'                => 'application/json',
            //                    'Content-Type'          => 'multipart/form-data',
            //            ],
            //                /*'form_params' => [
            //                    'title' => 'hi',
            //                    'parent_id'=> '22',
            //                    'publish_date'=> '2021-04-17 00:00:00'
            //                ],*/
            //                'multipart' => [
            //                    [
            //                        'name'     => 'images',
            //                        'contents' => $image,
            //                        'filename' => 'screenshot.jpg'
            //                    ],
            //
            //                    ]
            //            ]);
            //
            //            $result = $response->getBody();
            //            return $response;
            //
            //
            //
            //
            //
            //            $image=file_get_contents($val->image);
            //            $ch = curl_init();
            //            $data = array('name' => 'Foo', 'file' =>'4');
            //            curl_setopt($ch, CURLOPT_URL, 'http://cms.local/spider/addToCms');
            //            curl_setopt($ch, CURLOPT_POST, 1);
            //            //CURLOPT_SAFE_UPLOAD defaulted to true in 5.6.0
            //            //So next line is required as of php >= 5.6.0
            //            //curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
            //            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            //            $data=curl_exec($ch);
            //            curl_close($ch);
            //
            //            return ($data);

        }
        //$result = app('App\Http\Controllers\ContentController')->storeService();
    }

    public static function dorsamList($pageAddress, $productClass)
    {
        $page = file_get_contents($pageAddress);
        @$doc = new DOMDocument();
        $doc->preserveWhiteSpace = false;
        @$doc->loadHTML($page);
        $selector = new DOMXPath($doc);

        $tags = $selector->query($productClass);

        //echo '<pre/>';
        foreach ($tags as $id => $div) {
            $list[] = $div->getAttribute("href");
            /*foreach ($div->attributes as $id1=>$div1)
                        {
                            print_r($div1);
                            echo '<br/>';
                        }*/

            // echo '<br/>';
        }

        return $list;
    }

    /**
     * @param $pageAddress
     */
    public static function dorsamDetail($pageAddress, $category)
    {
        $page = file_get_contents($pageAddress);
        @$doc = new DOMDocument();
        $doc->preserveWhiteSpace = false;
        @$doc->loadHTML($page);
        $selector = new DOMXPath($doc);

        //echo '<pre/>';
        $titleTag = $selector->query('//div[@class="product_info_page_title"]/p');

        $title = ($titleTag->item(0)->nodeValue);
        $price = ($titleTag->item(1)->nodeValue);
        $price = str_replace('تومان', '', $price);
        $price = str_replace(':', '', $price);
        $price = str_replace(',', '', $price);
        $price = str_replace('قیمت', '', $price);
        $price = str_replace('متری', '', $price);
        $price = trim($price);
        $price = convertNumToEn($price);
        // $imageTag= $selector->query('//p[@class="product_info_page_pic"]/img');
        $imageTag = $selector->query('//p[contains(@class,"product_info_page_pic")]/img');

        $image_url = ($imageTag->item(0)->getAttribute('src'));

        //echo file_get_contents($imageAddres);

        $attrTags = $selector->query('//div[@class="product_info"]/span');
        //echo '<pre/>';
        $count = 0;
        $index = 0;
        $attr = array();
        foreach ($attrTags as $key => $val) {
            if (($count % 2) == 0) {
                $attr[$index]['field'] = $val->nodeValue;
            } else {

                $attr[$index]['value'] = $val->nodeValue;
                $index++;
            }
            $count++;
        }


        $spider = new spider();
        $spider->url = $pageAddress;
        $spider->title = $title;
        $spider->attr = $attr;
        $spider->price = $price;
        $spider->image_url = $image_url;
        $spider->category = $category;
        $spider->save();

        $name = explode('/', $spider->image_url);
        $name = $name[count($name) - 1];

        $imagePath = "/upload/images/dorsam/" . $spider->id . '-' . $name;
        $imageContent = file_get_contents($image_url);

        file_put_contents(public_path($imagePath), $imageContent);
        $spider->image = $imagePath;
        $spider->save();
        // dd($spider->attr);
        //die();


    }

    public static function dorsam()
    {

        //category 1
        /*$address='http://www.doorsam.ir/%d8%af%d8%b1%d8%a8-%d8%b6%d8%af-%d8%b3%d8%b1%d9%82%d8%aa/%d8%af%d8%b1%d8%a8-%d9%87%d8%a7%db%8c-%d8%b6%d8%af-%d8%b3%d8%b1%d9%82%d8%aa-%d8%af%d8%b1%d8%b3%d8%a7%d9%85';
        $spider= new self();
        $productClass='//div[@class="pruduct300485"]/a';
        $list=$spider->dorsamList($address,$productClass);
        foreach ($list as $k=>$page)
        {
            $spider->dorsamDetail($page,1);

        }
        die();*/

        //category 1
        /*$address = 'http://www.doorsam.ir/antitheft-door/290-%d8%af%d8%b1%d8%a8-%d8%b6%d8%af-%d8%b3%d8%b1%d9%82%d8%aa-%d8%af%d9%88%d9%84%d9%86%da%af%d9%87/.html';
        $spider = new self();
        $productClass = '//div[@class="pruduct500500"]/a';
        $list = $spider->dorsamList($address, $productClass);
        //dd($list);
        foreach ($list as $k => $page) {
            $spider->dorsamDetail($page,2);
        }*/
        dd('finish');


        $address = 'http://www.doorsam.ir/products/anti-a28r';

        $spider->dorsamDetail($address);

        $page = file_get_contents('http://www.doorsam.ir/products/anti-a28r');
        @$doc = new DOMDocument();
        $doc->preserveWhiteSpace = false;
        @$doc->loadHTML($page);


        $divs = $doc->getElementsByTagName('div');
        foreach ($divs as $id => $div) {
            echo '<pre/>';
            print_r($div);
        }
        die();


        //class="product_info"
        $info = $doc->getElementsByTagName("product_info");
        dd($info);


        // discard white space
        $dom->preserveWhiteSpace = false;
    }

    public function find($id)
    {
        return $this->role->find($id);
    }


    public function treeSet($roleId)
    {
        $sql = "
                                 select  id,
                                        title,
                                        parent_id
                                from    (select * from roles
                                         order by parent_id, id) roles_sorted,
                                        (select @pv := '" . $roleId . "') initialisation
                                where   find_in_set(parent_id, @pv)
                                    and     length(@pv := concat(@pv, ',', id))

                                ";

        return DB::select($sql);
    }


    public function getAll()
    {
        //       return Role::select('*')->get();
        return $this->role->paginate(100);
    }


    public function create($request)
    {
        return $this->role->create($request);
    }


    public function update($input)
    {
        //return $this->role->where('id', $input['id'])->update($input);
        return $this->role->find($input['id'])->update($input);
    }


    public function findParent($parent_id)
    {
        return $this->role->where('id', $parent_id)->first();
    }


    public function updateParentIdToZero($id)
    {
        return $this->role->where('parent_id', $id)->update([
            'parent_id' => 0,
        ]);
    }


    public function updateParentIdToParentId($id, $parent_id)
    {
        return $this->role->where('parent_id', '=', $id)->update([
            'parent_id' => $parent_id,
        ]);
    }


    /*
     * Not Used
     */

    public function getUserRole($userObj)
    {

        if ($userObj->role_id == 0) {
            $user['role']['title'] = 'god';
            $user['role']['id'] = 1;
        } else {
            $role = $this->role->where('id', '=', $userObj->role_id)->first();
        }


        return $role;

        //        return $this->user->where('role_id', $role->id)
        //            ->with('role')
        //            ->get();

    }


    public function rolesId($role)
    {
        return collect($role)->pluck('id')->toArray();
    }


    public function orderByParentId()
    {
        return $this->role->orderBy('parent_id', 'desc')->get();
    }


    public function getAllTitle()
    {
        return $this->role->select('title')->get();
    }
}
