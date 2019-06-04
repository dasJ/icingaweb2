<?php
/* Icinga Web 2 | (c) 2019 Icinga GmbH | GPLv2+ */

namespace Icinga\Web\Helper;

use HTMLPurifier_Config;
use Parsedown;

class Markdown
{
    const BLOCK_ELEMENTS = 'h1,h2,h3,h4,h5,h6,pre,div,p,ol,ul,table,thead,tbody,tfoot,blockquote,hr,li,tr,td[colspan],
                            th[colspan],br,b,i,strong,em,a[href|target],code,sup,sub,dl,dt,dd,s,strike,abbr,small,span,
                            *[class|style]';

    const FLOW_ELEMENTS = 'br,b,i,strong,em,a[href|target],code,sup,sub,dl,dt,dd,s,strike,abbr,small,span
                           *[class|style]';

    public static function line($content)
    {
        require_once 'Parsedown/Parsedown.php';
        $html = Parsedown::instance()->line($content);
        return HtmlPurifier::process($html, function (HTMLPurifier_Config $config) {
            $config->set('HTML.Allowed', static::FLOW_ELEMENTS);
        });
    }

    public static function text($content)
    {
        require_once 'Parsedown/Parsedown.php';
        $html = Parsedown::instance()->text($content);
        return HtmlPurifier::process($html, function (HTMLPurifier_Config $config) {
            $config->set('HTML.Allowed', static::BLOCK_ELEMENTS);
        });
    }
}
