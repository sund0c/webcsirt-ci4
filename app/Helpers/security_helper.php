<?php

// function clean_html($dirty)
// {
//     $config = \HTMLPurifier_Config::createDefault();

//     $config->set('HTML.Allowed', 'p,b,strong,i,em,a[href],ul,ol,li,br,img[src|alt]');
//     $config->set('AutoFormat.AutoParagraph', true);
//     $config->set('AutoFormat.RemoveEmpty', true);

//     $purifier = new \HTMLPurifier($config);

//     return $purifier->purify($dirty);
// }


function clean_html($dirty)
{
    $config = \HTMLPurifier_Config::createDefault();

    $config->set(
        'HTML.Allowed',
        'table,th,tr,td,thead,p,b,strong,i,s,blockquote,div,sup,sub,pre,code,em,ul,ol,li,br,a[href|target],h1,h2,h3,h4,img[src|alt|class]'
    );

    $config->set('AutoFormat.AutoParagraph', true);
    $config->set('AutoFormat.RemoveEmpty', true);

    // Batasi protokol link & img
    $config->set('URI.AllowedSchemes', [
        'http'  => true,
        'https' => true
    ]);

    // Aman untuk target="_blank"
    $config->set('HTML.TargetBlank', true);
    $config->set('Attr.AllowedFrameTargets', ['_blank']);

    $purifier = new \HTMLPurifier($config);

    return $purifier->purify($dirty);
}
