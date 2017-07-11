<?php
namespace App\Helpers;


/**
 * Trait ArrayHelper
 * @package App\Helpers
 */
trait RouteHelper
{

	/**
	 * @param string $user_agent
	 * @param $request
	 *
	 * @return string
	 */
	public function parseUserAgent( string $user_agent, $request )
	{
		if ($request->getHeader('User-Agent')){
			return $request->getHeader('User-Agent');
		} else {
			return 'Unknown';
		}
	}


}