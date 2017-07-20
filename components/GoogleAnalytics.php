<?php

namespace App\Components;

use System\BaseComponent;

/**
 * Class GoogleAnalytics
 * Send uri and responses to google analytics
 *
 * @package     App\Components
 * @subpackage  Controllers
 * @since       v0.1.0
 *
 * @see https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide#event
 * @see https://developers.google.com/analytics/devguides/collection/protocol/v1/parameters
 *
 */

/**
 * Class GoogleAnalytics
 * @package App\Components
 */
abstract class GoogleAnalytics extends BaseComponent
{

    private const TRACKING_ID = 'UA-98023612-1';

    private const GA_END_POINT = 'https://www.google-analytics.com/collect';

    /**
     * Generate UUID
     * @return string
     */
    public static function gen_uuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    /**
     * Send Data to Google Analytics
     *
     * @param $url
     * @param $user_agent
     * @return mixed
     * @internal param $data
     *
     */
    public static function gaSendData($url, $user_agent)
    {
        try {
            $data = array(
                'v' => 1,
                'tid' => self::TRACKING_ID,
                'cid' => self::gen_uuid(),
                't' => 'pageview'
            );

            $data['dl'] = $url;
            $data['ev'] = "34";
            $data['uip'] = $_SERVER['REMOTE_ADDR'];
            $data['ua'] = $user_agent;

            $content = http_build_query($data);
            $content = utf8_encode($content);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
            curl_setopt($ch, CURLOPT_URL, self::GA_END_POINT);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded'));
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            if (curl_exec($ch) === false) {
                $msg = curl_error($ch);
                throw new \Throwable($msg);
            }
            curl_close($ch);
        } catch (\Throwable $e) {
            parent::logError($e->getMessage());
        }
    }

    /**
     * Send Pageview Function for Server-Side Google Analytics
     *
     * @param null $hostname
     * @param null $page
     * @param null $title
     */
    public static function gaSendPageview($hostname = null, $page = null, $title = null)
    {
        $data = array(
            'v' => 1,
            'tid' => 'UA-000000-1', //@TODO: Change this to your Google Analytics Tracking ID.
            'cid' => gaParseCookie(),
            't' => 'pageview',
            'dh' => $hostname, //Document Hostname "gearside.com"
            'dp' => $page, //Page "/something"
            'dt' => $title //Title
        );
        self::gaSendData($data);
    }

    /**
     * Send Event Function for Server-Side Google Analytics
     *
     * @param null $category
     * @param null $action
     * @param null $label
     */
    public static function gaSendEvent($category = null, $action = null, $label = null)
    {
        $data = array(
            'v' => 1,
            'tid' => 'UA-000000-1', //@TODO: Change this to your Google Analytics Tracking ID.
            'cid' => gaParseCookie(),
            't' => 'event',
            'ec' => $category, //Category (Required)
            'ea' => $action, //Action (Required)
            'el' => $label //Label
        );
        self::gaSendData($data);
    }
}