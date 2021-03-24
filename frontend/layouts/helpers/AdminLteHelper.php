<?php

namespace frontend\layouts\helpers;

use yii\helpers\Url;

/**
 * AdminLte helper
 */
class AdminLteHelper
{
    /**
     *
     * Sidebar navigation item
     *
     * @param string $url
     * @param string $currentUrl
     * @param string $icon
     * @param string $name
     * @return string
     */
    public static function sidebarItem($url, $currentUrl, $icon, $name)
    {
        $html = '<li ' . self::sidebarDefineActiveItem($url, $currentUrl) . '>
                    <a href="' . Url::to($url) . '"><i class="' . $icon . '"></i> ' . $name . '</a>
                </li>';
        return $html;
    }

    /**
     * Sidebar treeview navigation item
     *
     * @param string $icon
     * @param string $name
     * @return string
     */
    public static function sidebarTreeviewItem($icon, $name)
    {
        $html = '   <a href="#">
                        <i class="' . $icon . '"></i>
                        <span>' . $name . '</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>';
        return $html;
    }

    /**
     * Define active item
     *
     * @param string $url
     * @param string $currentUrl
     * @return string
     */
    public static function sidebarDefineActiveItem($url, $currentUrl)
    {
        $url= str_replace('/', '\/', $url);
        return preg_match("/^" . $url . "/i", $currentUrl) ? 'class="active"' : '';
    }

    /**
     * Define active treeview item
     *
     * @param array $possibleUrls
     * @param string $currentUrl
     * @return string
     */
    public static function sidebarDefineActiveTreeviewItem($possibleUrls, $currentUrl)
    {
        $urls = '(';
        foreach ($possibleUrls as $item) {
            $item= str_replace('/', '\/', $item);
            $urls .= '^' . $item . '|';
        }
        $urls = substr($urls, 0, -1);
        $urls .= ')';
        return preg_match("/" . $urls . "/i", $currentUrl) ? ' menu-open active' : '';
    }


}
