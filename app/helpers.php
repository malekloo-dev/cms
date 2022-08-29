<?php
/* function h_GetHash()
{
    return '%%1^^@@REWcmv21))--';
} */

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use App\Models\Content;
use App\Models\Menu;
use App\Models\WebsiteSetting;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

function h_encrypt($string)
{
    $result = '89ah45o' . $string . 'py34';

    return ($result);
}

function h_decrypt($string)
{


    $result = substr(substr($string, 7, 4), 0, -3);

    return $result;
}

function readMore($text, $limit = 100, $noLink = 0)
{
    //$string = strip_tags($text);
    $string = $text;
    if (strlen($string) > $limit) {

        // truncate string
        $stringCut = substr($string, 0, $limit);
        $endPoint = strrpos($stringCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '...';
        if ($noLink == 1) {
            $string .= ' <a  data-text="' . $text . '" data-title="' . $title . '" class="readMore" href="">ادامه</a>';
        }
    }

    return $string;
}

if (!function_exists('tableOfContent')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string|null $view
     * @param  \Illuminate\Contracts\Support\Arrayable|array $data
     * @param  array $mergeData
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function tableOfContent($content)
    {

        //preg_match_all( '|<h[^>]+>(.*)</h[^>]+>|iU',$detail->description, $matches );
        //echo '<pre/>';
        //print_r($matches);
        //$tag = $matches[1];
        // dd($matches);
        $depth = 3;
        $pattern = '/<h[2-' . $depth . ']*[^>]*>.*?<\/h[2-' . $depth . ']>/';
        $pattern = '|<h[^>]+>(.*)</h[^>]+>|iU';

        $whocares = preg_match_all($pattern, $content, $winners);

        //dd(Request::url());
        //dd(url()->current());

        //reformat the results to be more usable
        $heads = implode("\n", $winners[0]);
        //$replace='<a href="'.url()->current().'/';
        //$heads = str_replace('<a href="',$replace,$heads);
        //$heads = str_replace('</a>','',$heads);
        //$heads = preg_replace('/<h([1-'.$depth.'])>/','<li class="toc$1">',$heads);
        //$heads = preg_replace('/<\/h[1-'.$depth.']>/','</a></li>',$heads);

        //dd($detail->description);

        //$table=$winners;
        $table_of_content = '';
        foreach ($winners[1] as $key => $val) {
            $table_of_content .= '<li class="toc1">';
            $table_of_content .= '<a id="test" href="#' . str_replace(' ', '-', $val) . '">' . $val . '</a>';
            $table_of_content = '</li>';
            $list['tableOfContent'][] = $table_of_content;

            $anchor = '<a name="' . str_replace(' ', '-', $val) . '"></a>' . $winners[0][$key];
            $content = str_replace($winners[0][$key], $anchor, $content);
        }
        // print_r($winners[0]);
        // die();
        //foreach ()
        $list['$content'] = $content;

        //echo $contents;
        //echo '<pre/>';
        //print_r($heads);
        //die();

        //dd($heads);
        return $list;
    }
}

if (!function_exists('editorModule')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string|null $view
     * @param  \Illuminate\Contracts\Support\Arrayable|array $data
     * @param  array $mergeData
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function render($string, $data)
    {
        $php = Blade::compileString($string);
        $content = \Blade::compileString($bladeString);

        return $this->file->put($bladePath, $content)
            ? $bladePath
            : false;

        view("remotyadak.cms.Detail");
        $obLevel = ob_get_level();
        ob_start();
        extract($data, EXTR_SKIP);

        try {
            eval('?' . '>' . $php);
        } catch (Exception $e) {
            while (ob_get_level() > $obLevel) ob_end_clean();
            throw $e;
        } catch (Throwable $e) {
            while (ob_get_level() > $obLevel) ob_end_clean();
            throw new FatalThrowableError($e);
        }

        return ob_get_clean();
    }

    function editorModule($content)
    {

        //$content=str_replace('r','',$content);

        // $input=preg_replace('/\s+/', ' ', $input);
        // $content = strip_tags(trim($content));


        //$input=strip_tags(trim(preg_replace('/\s+/', ' ',$input)));
        // $input = str_replace("&nbsp;", '', $input);
        // echo $input;
        $content = str_replace("\r\n\r\n\r\n", "\r\n", $content);
        $content = str_replace("\r\n\r\n", "\r\n", $content);
        $content = str_replace("\r\n", "", $content);
        $content = str_replace("\n", "", $content);

        //dd($content);

        //$input = str_replace("\t", ' ', $input);

        // echo "<br/>********anjam shod********<br/>";
        //$input = decode_entities_full($input, ENT_COMPAT, "utf-8");

        //$content = trim(preg_replace('/\s\s+/', ' ', $content));

        //dd($content);


        preg_match_all("/({gallery(.*){\/gallery})|({attr}(.*){\/attr})|({faq}(.*){\/faq})/U", $content, $pat_array);
        // dd($pat_array);

        //{gallery&size=10&template=1}
        //parse_str($_SERVER['QUERY_STRING'], $outputArray);

        $module = array('gallery' => 'tableOfImages', 'faq' => 'faq', 'attr' => 'attribute');
        $count = 0;
        foreach ($pat_array[0] as $key => $val) {

            $moduleStart = substr((explode('}', $val)[0]), 1);

            //$value=str_replace('&amp;','&',$moduleStart);
            //parse_str($value, $outputArray);
            // dd($outputArray);
            $moduleGetAttrArray = (explode('&amp;', $moduleStart));
            $moduleName = $moduleGetAttrArray[0];

            $moduleAttr = array();
            if (count($moduleGetAttrArray) > 1) {
                $queryString = substr($moduleStart, strlen($moduleName));
                parse_str(htmlspecialchars_decode($queryString), $moduleAttr);
            }

            $findPos = strpos($content, $val);
            $description = substr($content, 0, $findPos);

            if (strlen($description)) {

                $arrayContent[$count]['type'] = 'description';
                $moduleContent = substr($content, 0, $findPos);
                if (substr($moduleContent, 0, 4) == '</p>') {
                    $moduleContent = substr($moduleContent, 4);
                }
                if (substr($moduleContent, -3) == '<p>') {
                    $moduleContent = substr($moduleContent, 0, -3);
                }

                $arrayContent[$count]['content'] = $moduleContent;
                $count++;
            }
            $moduleContent = substr($content, $findPos, strlen($val));
            $moduleContent = substr($moduleContent, strlen($moduleStart) + 2, - (strlen($moduleName)) - 3);

            //dd(substr($moduleContent,strlen($moduleStart)+2,4));
            if (substr($moduleContent, 0, 4) == '</p>') {
                $moduleContent = substr($moduleContent, 4);
            }

            if (substr($moduleContent, -3) == '<p>') {
                $moduleContent = substr($moduleContent, 0, -3);
            }
            $funcname = $module[$moduleName];
            if (function_exists($funcname)) {

                $moduleContent = $funcname($moduleContent);
            }
            $arrayContent[$count]['type'] = $moduleName;
            $arrayContent[$count]['content'] = $moduleContent;
            $arrayContent[$count]['config'] = $moduleAttr;
            $content = substr($content, $findPos + strlen($val));
            $count++;
        }
        $arrayContent[$count]['type'] = 'description';
        $moduleContent = $content;

        if (substr($moduleContent, 0, 4) == '</p>') {
            $moduleContent = substr($moduleContent, 4);
        }
        if (substr($moduleContent, -3) == '<p>') {
            $moduleContent = substr($moduleContent, 0, -3);
        }
        $arrayContent[$count]['content'] = $moduleContent;


        // dd($arrayContent);
        return $arrayContent;
    }
}

if (!function_exists('attribute')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string|null $view
     * @param  \Illuminate\Contracts\Support\Arrayable|array $data
     * @param  array $mergeData
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */

    function attribute($content)
    {

        // $string= "here is a sample: this text, and this will be exploded. this also | this one too :)";

        $delimiters = array("<p>", "</p>");
        $ready = trim(str_replace($delimiters, $delimiters[0], $content));

        $arrayList = explode($delimiters[0], $ready);
        $arrayList = array_filter($arrayList, 'strlen');
        $result = array();
        $count = 0;
        $index = 0;
        foreach ($arrayList as $key => $val) {
            if (($count % 2) == 0) {
                $result[$index]['field'] = $val;
            } else {

                $result[$index]['value'] = $val;
                $index++;
            }
            $count++;
        }


        return $result;
    }
}
if (!function_exists('faq')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string|null $view
     * @param  \Illuminate\Contracts\Support\Arrayable|array $data
     * @param  array $mergeData
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */

    function faq($content)
    {

        // $string= "here is a sample: this text, and this will be exploded. this also | this one too :)";

        $delimiters = array("<p>", "</p>");
        $ready = trim(str_replace($delimiters, $delimiters[0], $content));

        $arrayList = explode($delimiters[0], $ready);
        $arrayList = array_filter($arrayList, 'strlen');
        $result = array();
        $count = 0;
        $index = 0;
        foreach ($arrayList as $key => $val) {
            if (($count % 2) == 0) {
                $result[$index]['question'] = $val;
            } else {

                $result[$index]['answer'] = $val;
                $index++;
            }
            $count++;
        }


        return $result;
    }
}

if (!function_exists('tableOfImages')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string|null $view
     * @param  \Illuminate\Contracts\Support\Arrayable|array $data
     * @param  array $mergeData
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */

    function tableOfImages($content)
    {

        $doc = new \DOMDocument();
        /* use @ or libxml_use_internal_errors
         * libxml_use_internal_errors(true);
        $dom->loadHTML('...');
        libxml_clear_errors();*/
        // dd($content);
        if ($content == null) $content = '<div></div>';
        @$doc->loadHTML($content);

        /*echo '<pre/>';
        print_r($a);
        die();*/
        $tags = $doc->getElementsByTagName('figure');

        $count = -1;
        $images = array();
        foreach ($tags as $tag) {


            foreach ($tag->childNodes as $tag1) {
                //print_r($tag1);
                if ($tag1->nodeName == 'img') {
                    $count++;
                    foreach ($tag1->attributes as $tag3) {
                        $images[$count]['src'] = $tag3->value;
                        $images[$count]['alt'] = '';
                        break;
                    }
                }
                if ($tag1->nodeName == 'figcaption') {
                    $images[$count]['alt'] = $tag1->nodeValue;
                }
            }
        }
        return $images;
    }
}
if (!function_exists('forceRedirect')) {


    function forceRedirect()
    {

        if (env('FORCE_REDIRECT', false)) {

            $segments = app('request')->segments();

            if (count($segments) > 1 && !app('request')->is('admin/*') && !app('request')->is('company/*')) {
                header("HTTP/1.1 301 Moved Permanently");
                // header("Location: " . url(end($urlexplod)));
                $lastSegment = app('request')->segment(count(request()->segments()));
                header("Location: " . url($lastSegment));
                exit();
            }
        }
    }
}
if (!function_exists('clearHtml')) {


    function clearHtml($input)
    {

        //$input= strip_tags(trim($input));
        //$input = filter_var($input, FILTER_SANITIZE_STRING);
        //return $input;
        // echo $input;

        //echo "<br/>********************<br/>";
        // $input=preg_replace('/\s+/', ' ', $input);
        $input = strip_tags(trim($input));

        //$input=strip_tags(trim(preg_replace('/\s+/', ' ',$input)));
        // $input = str_replace("&nbsp;", '', $input);
        // echo $input;
        $input = str_replace("\r\n\r\n\r\n", "\r\n", $input);

        $input = str_replace("\r\n\r\n", "\r\n", $input);

        //$input = str_replace("\t", ' ', $input);

        // echo "<br/>********anjam shod********<br/>";
        $input = decode_entities_full($input, ENT_COMPAT, "utf-8");

        return $input;
    }
}
function decode_entities_full($string, $quotes = ENT_COMPAT, $charset = 'ISO-8859-1')
{
    return html_entity_decode(preg_replace_callback('/&([a-zA-Z][a-zA-Z0-9]+);/', 'convert_entity', $string), $quotes, $charset);
}

function convert_entity($matches, $destroy = true)
{
    static $table = array(
        'quot' => '&#34;', 'amp' => '&#38;', 'lt' => '&#60;', 'gt' => '&#62;', 'OElig' => '&#338;', 'oelig' => '&#339;', 'Scaron' => '&#352;', 'scaron' => '&#353;', 'Yuml' => '&#376;', 'circ' => '&#710;', 'tilde' => '&#732;', 'ensp' => '&#8194;', 'emsp' => '&#8195;', 'thinsp' => '&#8201;', 'zwnj' => '&#8204;', 'zwj' => '&#8205;', 'lrm' => '&#8206;', 'rlm' => '&#8207;', 'ndash' => '&#8211;', 'mdash' => '&#8212;', 'lsquo' => '&#8216;', 'rsquo' => '&#8217;', 'sbquo' => '&#8218;', 'ldquo' => '&#8220;', 'rdquo' => '&#8221;', 'bdquo' => '&#8222;', 'dagger' => '&#8224;', 'Dagger' => '&#8225;', 'permil' => '&#8240;', 'lsaquo' => '&#8249;', 'rsaquo' => '&#8250;', 'euro' => '&#8364;', 'fnof' => '&#402;', 'Alpha' => '&#913;', 'Beta' => '&#914;', 'Gamma' => '&#915;', 'Delta' => '&#916;', 'Epsilon' => '&#917;', 'Zeta' => '&#918;', 'Eta' => '&#919;', 'Theta' => '&#920;', 'Iota' => '&#921;', 'Kappa' => '&#922;', 'Lambda' => '&#923;', 'Mu' => '&#924;', 'Nu' => '&#925;', 'Xi' => '&#926;', 'Omicron' => '&#927;', 'Pi' => '&#928;', 'Rho' => '&#929;', 'Sigma' => '&#931;', 'Tau' => '&#932;', 'Upsilon' => '&#933;', 'Phi' => '&#934;', 'Chi' => '&#935;', 'Psi' => '&#936;', 'Omega' => '&#937;', 'alpha' => '&#945;', 'beta' => '&#946;', 'gamma' => '&#947;', 'delta' => '&#948;', 'epsilon' => '&#949;', 'zeta' => '&#950;', 'eta' => '&#951;', 'theta' => '&#952;', 'iota' => '&#953;', 'kappa' => '&#954;', 'lambda' => '&#955;', 'mu' => '&#956;', 'nu' => '&#957;', 'xi' => '&#958;', 'omicron' => '&#959;', 'pi' => '&#960;', 'rho' => '&#961;', 'sigmaf' => '&#962;', 'sigma' => '&#963;', 'tau' => '&#964;', 'upsilon' => '&#965;', 'phi' => '&#966;', 'chi' => '&#967;', 'psi' => '&#968;', 'omega' => '&#969;', 'thetasym' => '&#977;', 'upsih' => '&#978;', 'piv' => '&#982;', 'bull' => '&#8226;', 'hellip' => '&#8230;', 'prime' => '&#8242;', 'Prime' => '&#8243;', 'oline' => '&#8254;', 'frasl' => '&#8260;', 'weierp' => '&#8472;', 'image' => '&#8465;', 'real' => '&#8476;', 'trade' => '&#8482;', 'alefsym' => '&#8501;', 'larr' => '&#8592;', 'uarr' => '&#8593;', 'rarr' => '&#8594;', 'darr' => '&#8595;', 'harr' => '&#8596;', 'crarr' => '&#8629;', 'lArr' => '&#8656;', 'uArr' => '&#8657;', 'rArr' => '&#8658;', 'dArr' => '&#8659;', 'hArr' => '&#8660;', 'forall' => '&#8704;', 'part' => '&#8706;', 'exist' => '&#8707;', 'empty' => '&#8709;', 'nabla' => '&#8711;', 'isin' => '&#8712;', 'notin' => '&#8713;', 'ni' => '&#8715;', 'prod' => '&#8719;', 'sum' => '&#8721;', 'minus' => '&#8722;', 'lowast' => '&#8727;', 'radic' => '&#8730;', 'prop' => '&#8733;', 'infin' => '&#8734;', 'ang' => '&#8736;', 'and' => '&#8743;', 'or' => '&#8744;', 'cap' => '&#8745;', 'cup' => '&#8746;', 'int' => '&#8747;', 'there4' => '&#8756;', 'sim' => '&#8764;', 'cong' => '&#8773;', 'asymp' => '&#8776;', 'ne' => '&#8800;', 'equiv' => '&#8801;', 'le' => '&#8804;', 'ge' => '&#8805;', 'sub' => '&#8834;', 'sup' => '&#8835;', 'nsub' => '&#8836;', 'sube' => '&#8838;', 'supe' => '&#8839;', 'oplus' => '&#8853;', 'otimes' => '&#8855;', 'perp' => '&#8869;', 'sdot' => '&#8901;', 'lceil' => '&#8968;', 'rceil' => '&#8969;', 'lfloor' => '&#8970;', 'rfloor' => '&#8971;', 'lang' => '&#9001;', 'rang' => '&#9002;', 'loz' => '&#9674;', 'spades' => '&#9824;', 'clubs' => '&#9827;', 'hearts' => '&#9829;', 'diams' => '&#9830;', 'nbsp' => '&#160;', 'iexcl' => '&#161;', 'cent' => '&#162;', 'pound' => '&#163;', 'curren' => '&#164;', 'yen' => '&#165;', 'brvbar' => '&#166;', 'sect' => '&#167;', 'uml' => '&#168;', 'copy' => '&#169;', 'ordf' => '&#170;', 'laquo' => '&#171;', 'not' => '&#172;', 'shy' => '&#173;', 'reg' => '&#174;', 'macr' => '&#175;', 'deg' => '&#176;', 'plusmn' => '&#177;', 'sup2' => '&#178;', 'sup3' => '&#179;', 'acute' => '&#180;', 'micro' => '&#181;', 'para' => '&#182;', 'middot' => '&#183;', 'cedil' => '&#184;', 'sup1' => '&#185;', 'ordm' => '&#186;', 'raquo' => '&#187;', 'frac14' => '&#188;', 'frac12' => '&#189;', 'frac34' => '&#190;', 'iquest' => '&#191;', 'Agrave' => '&#192;', 'Aacute' => '&#193;', 'Acirc' => '&#194;', 'Atilde' => '&#195;', 'Auml' => '&#196;', 'Aring' => '&#197;', 'AElig' => '&#198;', 'Ccedil' => '&#199;', 'Egrave' => '&#200;', 'Eacute' => '&#201;', 'Ecirc' => '&#202;', 'Euml' => '&#203;', 'Igrave' => '&#204;', 'Iacute' => '&#205;', 'Icirc' => '&#206;', 'Iuml' => '&#207;', 'ETH' => '&#208;', 'Ntilde' => '&#209;', 'Ograve' => '&#210;', 'Oacute' => '&#211;', 'Ocirc' => '&#212;', 'Otilde' => '&#213;', 'Ouml' => '&#214;', 'times' => '&#215;', 'Oslash' => '&#216;', 'Ugrave' => '&#217;', 'Uacute' => '&#218;', 'Ucirc' => '&#219;', 'Uuml' => '&#220;', 'Yacute' => '&#221;', 'THORN' => '&#222;', 'szlig' => '&#223;', 'agrave' => '&#224;', 'aacute' => '&#225;', 'acirc' => '&#226;', 'atilde' => '&#227;', 'auml' => '&#228;', 'aring' => '&#229;', 'aelig' => '&#230;', 'ccedil' => '&#231;', 'egrave' => '&#232;', 'eacute' => '&#233;', 'ecirc' => '&#234;', 'euml' => '&#235;', 'igrave' => '&#236;', 'iacute' => '&#237;', 'icirc' => '&#238;', 'iuml' => '&#239;', 'eth' => '&#240;', 'ntilde' => '&#241;', 'ograve' => '&#242;', 'oacute' => '&#243;', 'ocirc' => '&#244;', 'otilde' => '&#245;', 'ouml' => '&#246;', 'divide' => '&#247;', 'oslash' => '&#248;', 'ugrave' => '&#249;', 'uacute' => '&#250;', 'ucirc' => '&#251;', 'uuml' => '&#252;', 'yacute' => '&#253;', 'thorn' => '&#254;', 'yuml' => '&#255;'
    );
    if (isset($table[$matches[1]])) return $table[$matches[1]];
    // else
    return $destroy ? '' : $matches[0];
}

function convertJToG($date)
{
    if (env('SITE_LANG') != 'fa') return $date;

    $convertFaToEn = CalendarUtils::convertNumbers($date, true); // 1395-02-19
    $convertDate = CalendarUtils::createCarbonFromFormat('Y/m/d', $convertFaToEn)->format('Y-m-d'); //2016-05-8
    return $convertDate;
}
function convertGToJ($date, $time = false, $format = '%A, %d %B %Y')
{

    if ($date == '') return '';
    if (env('SITE_LANG') != 'fa') return date('Y-m-d', strtotime($date));

    // $jalali = CalendarUtils::strftime('Y-m-d', strtotime($date)); // 1395-02-19
    // $convert = CalendarUtils::convertNumbers($jalali); // ۱۳۹۵-۰۲-۱۹

    return Jalalian::forge($date)->format($format) . ' ' . (($time == true) ? Jalalian::forge($date)->format('H:i:s') : ''); // پنجشنبه, 07 اسفند 1399
}


function convertNumToEn($string)
{
    $persinaDigits1 = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $persinaDigits2 = array('٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠');
    $allPersianDigits = array_merge($persinaDigits1, $persinaDigits2);
    $replaces = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    return str_replace($allPersianDigits, $replaces, $string);
}

function idToSlug($id)
{

    if ($id == '') {
        return '';
    }

    $content = Content::find($id);
    if (is_object($content)) {
        return $content->slug;
    }
    return '';
}

function filterUrl($filterItem, $filterOption)
{
    $url = url()->full();
    $url = urldecode($url);

    if (count($_GET)) {
        /*foreach ($_GET as $key =>$val)
        {
             $val;
        }*/
        $url = $url . '&';
    } else {
        $url = $url . '?';
    }
    return $url . "attribute[" . $filterItem['content_attribute_id'] . "][" . $filterOption['value'] . "]=" . $filterOption['value'];
}
function addFilterUrlGenerator($data, $attrId, $valueId)
{
    $url = url()->current() . '?';

    $data['attribute'][$attrId][$valueId] = $valueId;
    return urldecode($url . http_build_query($data));
}
function removeFilterUrlGenerator($data, $attrId, $valueId)
{

    unset($data['attribute'][$attrId][$valueId]);
    //dd($data);
    $url = url()->current() . '?';

    return urldecode($url . http_build_query($data));
}


function idToMenuLabel($id)
{

    if ($id == '') {
        return '';
    }

    $content = Menu::find($id);
    if (is_object($content)) {
        return $content->label;
    }
    return '';
}

function sendSms($numbers = array("09331181877"), $message = '', $i = 0)
{
    ini_set("soap.wsdl_cache_enabled", "0");
    $sms_client = new SoapClient('http://payamak-service.ir/SendService.svc?wsdl', array('encoding' => 'UTF-8'));
    $fromNumber = ['10009611', '5000249', 'SimCard', '50005708631983', '10002188', '5000249', '210002100000021', '30005920000015'];

    try {
        $parameters['userName'] = "mt.09331181877";
        $parameters['password'] = "kxx#389";
        $parameters['fromNumber'] = $fromNumber[$i]; // 50005708631983 , 210002100000021 , 10002188 , 30005920000015 , 5000249 , SimCard , News
        $parameters['toNumbers'] = $numbers;
        $parameters['messageContent'] = $message;
        $parameters['isFlash'] = false;
        // $recId = array();
        // $status = array();
        // $parameters['recId'] = &$recId;
        // $parameters['status'] = &$status;

        $res = $sms_client->SendSMS($parameters)->SendSMSResult;

        if ($res == 0)
            return $res;

        $res = sendSms($numbers, $message, ++$i);
        return $res;
    } catch (Exception $e) {
        return 'Caught exception: ' .  $e->getMessage() . "\n";
    }
}

if (!function_exists('uniqueSlug')) {
    function uniqueSlug($model = Content::class, $slugOrModel = '', string $slug = '', string|int $i = '')
    {

        // echo '<pre>';

        // $slug = 'کابل-رشته-ای شیلددار-22AWG';
        // echo $slug;
        // $slug = preg_replace('/\s+/', '-', $slug);
        $slug = str_replace(' ', '-', $slug);
        // $slug = str_replace(' ', '-', $slug);
        // $slug = str_replace(' ', '-', $slug);
        // echo $slug;
        $slug = str_replace('--', '-', $slug);
        $slug = str_replace('--', '-', $slug);
        $slug = str_replace('--', '-', $slug);
        $slug = trim($slug, ' ');
        $slug = trim($slug, '-');


        // dd($slug);
        // update model
        if ($slugOrModel instanceof Model) {
            if ($slugOrModel->getOriginal('slug') == $slug) {
                return $slugOrModel->getOriginal('slug');
            }
        } else {
            //new model
            $slug = $slugOrModel;
        }


        $slug = preg_replace('/\s+/', '-', $slug);
        $slug = str_replace('--', '-', $slug);
        $slug = str_replace('--', '-', $slug);
        $slug = str_replace('--', '-', $slug);
        $slug = trim($slug, ' ');

        // $oldSlug = $ownModel->slug;



        //check exist new slug
        $obj = $model::whereSlug($slug . $i)->exists();
        // dd($obj);

        if ($obj) {
            if ($i == '') {
                $i = 1;
            }

            return uniqueSlug($model, $slugOrModel, $slug, ++$i);
        }


        return $slug . $i;
    }
}

/// eden


function getGoldPrice($offline = 'offline')
{
    if ($offline == 'offline') {

        $goldPriceOld = WebsiteSetting::where('variable', '=', 'goldPrice')->first();
        if($goldPriceOld){
            $goldPriceOld = $goldPriceOld->value;

            $goldPriceOld = json_decode($goldPriceOld);
            return [
                'price' => (int) $goldPriceOld->price,
                'priceToman' => (int) $goldPriceOld->priceToman
            ];
        }
        else{
            return [
                'price' => 0,
                'priceToman' => 0
            ];
        }


    } else {

        try {
            $pageAddress = 'https://www.tgju.org/profile/geram18';
            $page = file_get_contents($pageAddress);

            @$doc = new DOMDocument();
            $doc->preserveWhiteSpace = false;
            @$doc->loadHTML($page);
            // dd($doc);
            $selector = new DOMXPath($doc);

            $price = $selector->query("//*[@data-col='info.last_trade.PDrCotVal']")->item(0);
            // $changePercent = $selector->query("//*[@data-col='info.last_trade.last_change_percentage']")->item(0);



            if (!is_null($price)) {
                WebsiteSetting::updateOrCreate(['variable' => 'goldPrice'], ['variable' => 'goldPrice', 'value' => json_encode([
                    'price' => $price->nodeValue,
                    'priceToman' => ((int) str_replace(',', '', $price->nodeValue)) / 10
                ])]);

                return [
                    'price' => $price->nodeValue,
                    'priceToman' => ((int) str_replace(',', '', $price->nodeValue)) / 10
                ];
            }

            return [
                'price' => 0,
                'priceToman' => 0
            ];
        } catch (ErrorException $e) {

            return [
                'price' => 0,
                'priceToman' => 0
            ];
        }
    }
}

function calcuteGoldPrice($weight = 0, $additionalPrice = 0, $goldPrice = 0)
{

    $str = (is_numeric($goldPrice) && $goldPrice > 0) ? $goldPrice : getGoldPrice();
    $weight = (float) $weight;
    $additionalPrice = (int) $additionalPrice;

    $goldPrice = (isset($str['priceToman'])) ? $str['priceToman'] : 0;

    return [
        'totalPrice' => (int) (($goldPrice * $weight) + ($goldPrice * $weight * 0.28) + $additionalPrice),
        'goldprice' => $goldPrice
    ];
}
