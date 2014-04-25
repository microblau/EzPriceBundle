<?php
/**
 * Expiración del caché de feeds
 * 
 * @author carlos.revillo@tantacom.com
 * @version 1.0
 * @package efl
 *
 */
class eflFeedsCache
{
	/**
	 * Constructor. No nace nada en especial
	 * @return void
	 */
	function __construct()
	{
		
	}
	
	/**
	 * Borra todos los caches de rss
	 * @return void
	 */
	function clearCache()
	{
		$files = glob( eZSys::cacheDirectory() . "/feeds/feeds*");
		foreach( $files as $file )
		{
			unlink( $file );
		} 
	}
}
?>