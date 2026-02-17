<?php

function clean_html($dirty)
{
    $config = \HTMLPurifier_Config::createDefault();

    $config->set('HTML.Allowed', 'p,b,strong,i,em,a[href],ul,ol,li,br,img[src|alt]');
    $config->set('AutoFormat.AutoParagraph', true);
    $config->set('AutoFormat.RemoveEmpty', true);

    $purifier = new \HTMLPurifier($config);

    return $purifier->purify($dirty);
}
