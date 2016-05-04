<?php defined('SYSPATH') or die('No direct script access.');

class Sitemap extends Kohana_Sitemap {


	/**
	 * Format a unix timestamp into W3C Datetime
	 *
	 * @access public
	 * @see http://www.w3.org/TR/NOTE-datetime
	 * @param string $unix Unixtimestamp
	 * @return string W3C Datetime
	 */
	public static function date_format($unix)
	{
		if (is_numeric($unix) AND $unix <= PHP_INT_MAX)
		{
			return date('Y-m-d', $unix);
		}
	
		throw new InvalidArgumentException('Must be a unix timestamp');
	}

}