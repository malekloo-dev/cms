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