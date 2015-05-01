<?php namespace App\Http\Controllers;

use Viion\Lodestone\LodestoneAPI;

class AjaxController extends Controller {
	public function char()
	{
		$ls = new LodestoneAPI();
		if (!\Request::has("name") || !\Request::has("world")) {
			throw new \Exception("name or world not defined");
		}

		$req = \Request::only(["name", "world"]);
		$chars = $ls->Search->Character($req["name"], $req["world"]);
		return \Response::json($chars);
	}
}
