<?php
/* function h_GetHash()
{
    return '%%1^^@@REWcmv21))--';
} */

function h_encrypt($string)
{
    $result = '89ah45o' . $string . 'py34';

    return ($result);
}

function h_decrypt($string)
{


    $result = substr(substr($string,7,4),0,-3);

    return $result;
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
        @$doc->loadHTML($content);

        /*echo '<pre/>';
        print_r($a);
        die();*/
        $tags = $doc->getElementsByTagName('figure');

        $count = -1;
        $images=array();
        foreach ($tags as $tag) {
            $count++;
            // echo '<pre/>';
            // print_r($tag);

            foreach ($tag->childNodes as $tag1) {
                //print_r($tag1);
                if ($tag1->tagName == 'img') {
                    foreach ($tag1->attributes as $tag3) {
                        $images[$count]['src'] = $tag3->value;
                        $images[$count]['alt']='';
                        break;
                    }
                }
                if ($tag1->tagName == 'figcaption') {
                    $images[$count]['alt'] = $tag1->nodeValue;
                }


            }
        }
        return $images;


    }


}
