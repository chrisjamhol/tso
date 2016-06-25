<?php
	/*
	* Plugin Name: Handball4All - TSO
	* Description: TSO Plugin für Spielergebnisse
	* Version: 1.0
	* Author: Christopher Holden
	* Author URI: https://github.com/chrisjamhol
	* Api Page: http://www.handball4all.de/index.php?tacoma=webpart.pages.Handball4allPage&navid=1263&coid=1263&cid=4&h4all=gfoi2i5k5nl7icfg5v4u8druo7 -- JSON Mannschaftsspielpläne: Übersicht der IDs und Links aktuelle Saison
	*/

	// Example 1 : WP Shortcode to display form on any page or post.
	function handball4all_table($attributes){
		$html = '';

		$parameters = shortcode_atts(getDefaultOptions(), $attributes );
		//todo validate parameters
		$teamData = getTeamData($parameters);		
		$html = parseTeamData($teamData);

		return $html;
	}

	function getDefaultOptions() {
		$defaultOptions = array(			
	        'baseurl' => 'http://www.handball4all.de/m/php/spo-proxy_public.php?cmd=data&',
	        'manschaftsid' => 0,
	        'quote' => 'quote',
	        'attribution' => 'Author',
		);

		return $defaultOptions;
	}

	function getTeamData($parameters) {
		$cachefilename = plugin_dir_path(__FILE__).'cache/teamdata-'.$parameters['manschaftsid'].'.json';
		$cacheIsOutdated = getIsCacheOutdated($cachefilename);
		if($cacheIsOutdated)
			createTeamDataCache($cachefilename, $parameters);
		
		$teamData = getCacheFromFile($cachefilename);	

		return $teamData;
	}

	function getTeamDataJson($parameters) {
		$url = $parameters['baseurl'].'&lvTypeNext=team&lvIDNext='.$parameters['manschaftsid'];
		$response = file_get_contents($url);
		$teamData = json_decode($response, true);

		return $teamData;
	}

	function parseTeamData($teamData) {		
		include_once('partials/teamtable.php');
	}

	function getCacheFromFile($cachefilename) {
		$cacheData = array();

		if(is_file($cachefilename)){
			$fileContent = file_get_contents($cachefilename);
			$cacheData = json_decode($fileContent);
		}
		
		return $cacheData;
	}

	function createTeamDataCache($cachefilename, $parameters) {
		$teamDataJson = getTeamDataJson($parameters);
		writeCacheFile($cachefilename, $teamDataJson);
	}

	function writeCacheFile($cachefilename, $jsonData) {	
		if(is_writable($cachefilename)) {
			$fp = fopen($cachefilename, 'w');
			fwrite($fp, json_encode($jsonData));
			fclose($fp);
		} else {
			echo $cachefilename.' not wirtable!';
		}		
	}	

	function getIsCacheOutdated($cachefilename) {
		$cacheIsOutdated = false;

		if(is_file($cachefilename)) {
			$cacheThreshold = 10 * 60; // 10 minutes
			$currentTime = time();
			$filetime = filemtime ($cachefilename);
			$fileage = $currentTime - $filetime;

			if($fileage > $cacheThreshold)
				$cacheIsOutdated = true;
		} else {			
			$cacheIsOutdated = true;
		}

		return $cacheIsOutdated = true;
	}

	function addResoureces() { 
		wp_register_script('tso_script', plugins_url('javascript/tso.js', __FILE__), array('jquery'),'1.0', true);
		wp_enqueue_script('tso_script');

		wp_register_script('tso_stylesheet', plugins_url('css/tso.css', __FILE__));
		wp_enqueue_script('tso_stylesheet');
	}

	add_shortcode('handball4all-table', 'handball4all_table');
	add_action( 'wp_enqueue_scripts', 'addResoureces' );

?>