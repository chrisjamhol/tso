<?php
    /*
    * Plugin Name: Handball4All - TSO
    * Description: TSO Plugin für Spielergebnisse
    * Version: 1.0
    * Author: Christopher Holden
    * Author URI: https://github.com/chrisjamhol
    * Api Page: http://www.handball4all.de/index.php?tacoma=webpart.pages.Handball4allPage&navid=1263&coid=1263&cid=4&h4all=gfoi2i5k5nl7icfg5v4u8druo7 -- JSON Mannschaftsspielpläne: Übersicht der IDs und Links aktuelle Saison
    */
    /**
     * @param $attributes
     * @return string|void
     */
    function handball4all_table($attributes) {
        $parameters = shortcode_atts(getDefaultOptions(), $attributes);
        //todo validate parameters
        $teamData = getTeamTable($parameters);
        parseTeamData($teamData);
    }

    function handball4all_games($attributes) {
        $parameters = shortcode_atts(getDefaultOptions(), $attributes);
        //todo validate parameters
        $teamData = getTeamGames($parameters);
        parseTeamGames($teamData);
    }

    function handball4all_club($attributes) {

         $parameters = shortcode_atts(getDefaultOptions(), $attributes);
        //todo validate parameters
        $teamData = getClubGames($parameters);
        parseClubGames($teamData);
    }

    /**
     * @param $teamData
     */
    function parseTeamGames($teamData) {
        include_once('partials/teamgames.php');
    }

    /**
     * @param $teamData
     */
    function parseTeamData($teamData) {
        include_once('partials/teamtable.php');
    }

    /**
     * @param $teamData
     */
    function parseClubGames($teamData) {
        include_once('partials/clubgames.php');
    }

    /**
     * @return array
     */
    function getDefaultOptions() {
        $defaultOptions = array(
            'baseurl' => 'http://www.handball4all.de/m/php/spo-proxy_public.php?cmd=data&',
            'manschaftsid' => 0,
            'quote' => 'quote',
            'attribution' => 'Author',
            'vereinsid' => 596
        );

        return $defaultOptions;
    }

    /**
     * @param $parameters
     * @return array|mixed|object
     */
    function getTeamGames($parameters) {
        $cachefilename = plugin_dir_path(__FILE__) . 'cache/teamgames-' . $parameters['manschaftsid'] . '.json';
        $cacheIsOutdated = getIsCacheOutdated($cachefilename);
        if ($cacheIsOutdated)
            createTeamGamesCache($cachefilename, $parameters);

        $teamData = getCacheFromFile($cachefilename);

        return $teamData;
    }

    function getTeamTable($parameters) {
        $cachefilename = plugin_dir_path(__FILE__) . 'cache/teamtable-' . $parameters['manschaftsid'] . '.json';
        $cacheIsOutdated = getIsCacheOutdated($cachefilename);
        if ($cacheIsOutdated)
            createTeamTableCache($cachefilename, $parameters);

        $teamData = getCacheFromFile($cachefilename);

        return $teamData;
    }

    function getClubGames($parameters) {
        $cachefilename = plugin_dir_path(__FILE__) . 'cache/clubgames-' . $parameters['vereinsid'] . '.json';
        $cacheIsOutdated = getIsCacheOutdated($cachefilename);
        if ($cacheIsOutdated)
            createClubGamesCache($cachefilename, $parameters);

        $teamData = getCacheFromFile($cachefilename);

        return $teamData;
    }

    /**
     * @param string $url
     * @return array|mixed|object
     */
    function getDataAsJson($url) {
        $response = file_get_contents($url);
        $teamData = json_decode($response, true);

        return $teamData;
    }

    /**
     * @param $cachefilename
     * @return array|mixed|object
     */
    function getCacheFromFile($cachefilename) {
        $cacheData = array();

        if (is_file($cachefilename)) {
            $fileContent = file_get_contents($cachefilename);
            $cacheData = json_decode($fileContent);
        }

        return $cacheData;
    }

    /**
     * @param $cachefilename
     * @param $parameters
     */
    function createTeamGamesCache($cachefilename, $parameters) {
        $url = $parameters['baseurl'] . '&lvTypeNext=team&lvIDNext=' . $parameters['manschaftsid'];
        $teamGamesJson = getDataAsJson($url);
        writeCacheFile($cachefilename, $teamGamesJson);
    }

    function createClubGamesCache($cachefilename, $parameters) {
        $url = $parameters['baseurl'] . '&lvTypeNext=club&lvIDNext=' . $parameters['vereinsid'];
        echo $url;
        $teamTableJson = getDataAsJson($url);
        writeCacheFile($cachefilename, $teamTableJson);
    }

    function createTeamTableCache($cachefilename, $parameters) {
        $url = $parameters['baseurl'] . '&lvTypeNext=teamList&lvIDNext=' . $parameters['manschaftsid'];
        $teamTableJson = getDataAsJson($url);
        writeCacheFile($cachefilename, $teamTableJson);
    }

    /**
     * @param $cachefilename
     * @param $jsonData
     */
    function writeCacheFile($cachefilename, $jsonData) {
        if (is_writable($cachefilename)) {
            $fp = fopen($cachefilename, 'w');
            fwrite($fp, json_encode($jsonData));
            fclose($fp);
        } else {
            echo $cachefilename . ' not wirtable!';
        }
    }

    /**
     * @param $cachefilename
     * @return bool
     */
    function getIsCacheOutdated($cachefilename) {
        $cacheIsOutdated = false;

        if (is_file($cachefilename)) {
            $cacheThreshold = 10 * 60; // 10 minutes
            $currentTime = time();
            $filetime = filemtime($cachefilename);
            $fileage = $currentTime - $filetime;

            if ($fileage > $cacheThreshold)
                $cacheIsOutdated = true;
        } else {
            $cacheIsOutdated = true;
        }

        return $cacheIsOutdated = true;
    }

    /**
     *
     */
    function addResoureces() {
        wp_register_script('tso_script', plugins_url('javascript/tso.js', __FILE__), array('jquery'), '1.0', true);
        wp_enqueue_script('tso_script');

        wp_register_style('tso_stylesheet', plugins_url('css/tso.css', __FILE__));
        wp_enqueue_style('tso_stylesheet');
    }

    add_shortcode('handball4all-table', 'handball4all_table');
    add_shortcode('handball4all-spiele', 'handball4all_games');
    add_shortcode('handball4all-aktuelle-spiele', 'handball4all_club');
    add_action('wp_enqueue_scripts', 'addResoureces');

?>