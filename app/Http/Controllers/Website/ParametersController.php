<?php namespace App\Http\Controllers\Website;

use App\Models\Parameters;

use App\User;

class ParametersController
{
	/**
	 * @param STRING $param (keywords,...)
	 * @return OBJECT value param
	 */
	public function getParams($param)
	{
		return Parameters::getAllList($param);
	}
}
