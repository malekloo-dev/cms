<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

class OptimizeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function handle($request, Closure $next)
    {
       // $action_name = $this->router->getRoutes();
       /* if ($request->is('admin/*')) {
            // do something
        }*/

        $action_name = $this->router->getRoutes()->match($request)->getActionName();
        $response = $next($request);

        if($action_name!='App\Http\Controllers\CmsController@request' and $action_name!='App\Http\Controllers\CmsController@request')
        {
            return $response;

        }
        return $response;


        $buffer = $response->getContent();
        if(strpos($buffer,'<pre>') !== false)
        {
            $replace = array(
                '/<!--[^\[](.*?)[^\]]-->/s' => '',
                "/<\?php/"                  => '<?php ',
                "/\r/"                      => '',
                "/>\n</"                    => '><',
                "/>\s+\n</"                 => '><',
                "/>\n\s+</"                 => '><',
            );
        }
        else
        {
            $replace = array(
                '/<!--[^\[](.*?)[^\]]-->/s' => '',
                "/<\?php/"                  => '<?php ',
                "/\n([\S])/"                => '$1',
                "/\r/"                      => '',
                "/\n/"                      => '',
                "/\t/"                      => '',
                "/ +/"                      => ' ',
            );
        }
        $buffer = preg_replace(array_keys($replace), array_values($replace), $buffer);

        $response->setContent($buffer);
        ini_set('zlib.output_compression', 'On'); // If you like to enable GZip, too!
        return $response;
    }
}
class OptimizeMiddleware1
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($this->isResponseObject($response) && $this->isHtmlResponse($response)) {
            $replace = [
                '/\>[^\S ]+/s'                                                      => '>',
                '/[^\S ]+\</s'                                                      => '<',
                '/([\t ])+/s'                                                       => ' ',
                '/^([\t ])+/m'                                                      => '',
                '/([\t ])+$/m'                                                      => '',
                '~//[a-zA-Z0-9 ]+$~m'                                               => '',
                '/[\r\n]+([\t ]?[\r\n]+)+/s'                                        => "\n",
                '/\>[\r\n\t ]+\</s'                                                 => '><',
                '/}[\r\n\t ]+/s'                                                    => '}',
                '/}[\r\n\t ]+,[\r\n\t ]+/s'                                         => '},',
                '/\)[\r\n\t ]?{[\r\n\t ]+/s'                                        => '){',
                '/,[\r\n\t ]?{[\r\n\t ]+/s'                                         => ',{',
                '/\),[\r\n\t ]+/s'                                                  => '),',
                '~([\r\n\t ])?([a-zA-Z0-9]+)=\"([a-zA-Z0-9_\\-]+)\"([\r\n\t ])?~s'  => '$1$2=$3$4',
            ];

            $response->setContent(preg_replace(array_keys($replace), array_values($replace), $response->getContent()));
        }

        return $response;
    }

    protected function isResponseObject($response)
    {
        return is_object($response) && $response instanceof Response;
    }

    protected function isHtmlResponse(Response $response)
    {
        return strtolower(strtok($response->headers->get('Content-Type'), ';')) === 'text/html';
    }
}