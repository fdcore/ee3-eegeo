<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Ee_geo Class
 *
 * @package     ExpressionEngine
 * @category        Plugin
 * @author      Dmitriy Nyashkin
 * @copyright       Copyright (c) 2013-2016, FDCore Studio
 * @link        http://fdcore.com
 */


class Ee_geo {

 	public $return_data = "";
  public static $name         = 'EE Geo';
  public static $version      = '2.0.0';
  public static $author       = 'Dmitriy Nyashkin';
  public static $author_url   = 'http://fdcore.com/';
  public static $description  = 'Return geo tags';
  public static $typography   = FALSE;

	private $cache = array();

    public function __construct($str = NULL)
    {
  		$mod_path = PATH_THIRD."ee_geo/";

  		if(!class_exists('SxGeo'))
  		    include_once $mod_path."SxGeo.php";
    }

    public function city($str = NULL)
    {
  		$type = ee()->TMPL->fetch_param('type', 'FILE');  // FILE , BATCH&MEMORY, BATCH, MEMORY
  		$ip = ee()->TMPL->fetch_param('ip', ee()->session->userdata('ip_address'));

  		if(!isset($this->cache['city_'.$ip])){
  			$mod_file = PATH_THIRD."ee_geo/SxGeoCity.dat";

  			switch ($type) {
  				case 'FILE':
  					$SxGeo = new SxGeo($mod_file);
  					break;
  				case 'BATCH':
  					$SxGeo = new SxGeo($mod_file, SXGEO_BATCH);
  					break;
  				case 'MEMORY':
  					$SxGeo = new SxGeo($mod_file, MEMORY);
  					break;
  				case 'BATCH&MEMORY':
  					$SxGeo = new SxGeo($mod_file, SXGEO_BATCH | SXGEO_MEMORY);
  					break;
  				default:
  					$SxGeo = new SxGeo($mod_file);
  					break;
  			}

  			$city = $SxGeo->getCityFull($ip);

        foreach ($city['country'] as $key => $value)
          $city['country_'.$key] = $value;

        foreach ($city['city'] as $key => $value)
          $city['city_'.$key] = $value;

        foreach ($city['region'] as $key => $value)
          $city['region_'.$key] = $value;

        unset($city['country']);
        unset($city['city']);
        unset($city['region']);
        
  			$this->cache['city_'.$ip] = $city;

  		} else {
  				$city = $this->cache['city_'.$ip];

  		}

  		$city['ip'] = $ip;

  	  if (empty($str)) $str = ee()->TMPL->tagdata;

  		$output = ee()->TMPL->parse_variables($str, array($city));

  		unset($SxGeo);

  		return $this->return_data = $output;

    }

	function country(){

		$type = ee()->TMPL->fetch_param('type', 'FILE');  // FILE , BATCH&MEMORY, BATCH, MEMORY
		$ip = ee()->TMPL->fetch_param('ip', ee()->session->userdata('ip_address'));

		if(!isset($this->cache['country_'.$ip])){
			$mod_path = PATH_THIRD."ee_geo/";

			switch ($type) {
				case 'FILE':
					$SxGeo = new SxGeo($mod_path.'SxGeo.dat');
					break;
				case 'BATCH':
					$SxGeo = new SxGeo($mod_path.'SxGeo.dat', SXGEO_BATCH);
					break;
				case 'MEMORY':
					$SxGeo = new SxGeo($mod_path.'SxGeo.dat', MEMORY);
					break;
				case 'BATCH&MEMORY':
					$SxGeo = new SxGeo($mod_path.'SxGeo.dat', SXGEO_BATCH | SXGEO_MEMORY);
					break;
				default:
					$SxGeo = new SxGeo($mod_path.'SxGeo.dat');
					break;
			}

			$country = $SxGeo->getCountry($ip);
			$this->cache['country_'.$ip] = $country;
		} else {
			$country = $this->cache['country_'.$ip];

		}

		unset($SxGeo);
		return $country;

	}

}



/* End of file pi.ee_geo.php */
/* Location: ./system/expressionengine/third_party/ee_geo/pi.ee_geo.php */
