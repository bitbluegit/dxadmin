<?php

namespace Framework;

class Link {
    //--------------------- builds absolute links --------------------------
    public static function build($link = '', $type = 'http') {
        $base = (( $type == 'http' || USE_SSL == 'no' ) ? 'http://' : 'https://') . getenv('SERVER_NAME');

        // if HTTP_SERVER_PORT is defined and different than default
        if(defined('ENV_HTTP_PORT') && ENV_HTTP_PORT != '80' && strpos($base, 'https') === false) {
            $base .= ':' . HTTP_SERVER_PORT;
        }
        $link = $base . APP_BASE_DIR . $link;
        
        return htmlspecialchars($link, ENT_QUOTES, 'UTF-8');
    }

    //---------------- redirect to url or error pages-----------------------
    public static function sendTo($url='', $type='http') {
        die(header('Location: ' . self::build($url, $type)));
    }
}