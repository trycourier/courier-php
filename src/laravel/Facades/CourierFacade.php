<?php

namespace Courier\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class CourierFacade extends Facade {

	protected static function getFacadeAccessor()
	{
		return 'courier';
	}

}
