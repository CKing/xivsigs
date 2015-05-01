<?php namespace App\Http\Controllers;

use Viion\Lodestone\LodestoneAPI;
use Image;

class PagesController extends Controller {

	private function getChar($id) {
		return \Cache::remember("char:" . $id, 60 * 2, function() use($id) {
			$ls = new LodestoneAPI();
			$char = $ls->Search->character($id);

			$namedjobs = array();
			foreach ($char->classjobs as $job) {
				$namedjobs[strtolower($job["name"])] = $job;
			}
			$char->classjobs += $namedjobs;
			$char->classjobs += array_dot($namedjobs);

			return $char;
		});
	}

	public function index()
	{
		$servers = \Cache::remember('servers', 60 * 24 * 90, function() {
			$ls = new LodestoneAPI();
			return array_map(function ($i) {
				$a = array_map(function ($i) {
					return $i["server"];
				}, $i);

				return array_combine($a, $a);
			}, $ls->Search->worldstatus());

		});

		return view('index', compact("servers"));
	}

	public function char($id, $name = null) {
		$data = $this->getChar($id);

		if (!$data) {
			throw new Exception("character not found!");
		}

		$slug = preg_replace("#[^-a-z]#", "", str_replace(" ", "-", strtolower($data->name)));
		if ($slug != $name) {
			return redirect(route("char", [ "id" => $id, "name" => $slug ]));
		}

		$data->slug = $slug;

		return view("char", compact("data"));
	}

	public function image($type, $id, $size) {
		$data = $this->getChar($id);
		$size = explode("x", $size);
		$img = Image::cache(function ($img) use($data, $type, $size){
			$src = $data->{$type};
			if (!is_array($src)) {
				$img->make($src);
			} else {
				$img->make(array_shift($src));
				foreach($src as $url) {
					$img->insert($url);
				}
			}

			$img->resize($size[0], $size[1], function ($c) {
				$c->aspectRatio();
			});
		}, 60 * 2, true);
		return $img->response("png");
	}

	public function signature($id, $name = null) {
		$data = $this->getChar($id);
		$coords = [
			"gladiator" => [212, 88],
			"marauder" => [240, 88],
			"pugilist" => [268, 88],
			"rogue" => [296, 88],
			"lancer" => [324, 88],
			"archer" => [354, 88],
			"thaumaturge" => [386, 88],
			"arcanist" => [414, 88],
			"conjurer" => [446, 88],

			"carpenter" => [156, 130],
			"blacksmith" => [184, 130],
			"armorer" => [212, 130],
			"goldsmith" => [240, 130],
			"leatherworker" => [268, 130],
			"weaver" => [296, 130],
			"alchemist" => [324, 130],
			"culinarian" => [352, 130],
			"miner" => [382, 130],
			"botanist" => [410, 130],
			"fisher" => [438, 130],
		];

		$img = Image::cache(function ($img) use($data, $coords) {
			$avatar = Image::make($data->avatar)->resize(128, 128);
			$city = Image::make($data->cityIcon)->resize(48, 48);
			$img->make(base_path("resources/banner/template.png"))
			//$img = Image::make(base_path("resources/banner/template.png"))
				->insert($avatar, "left", 7, 0)
				->insert($city, null, 150, 42)
				->text($data->name . (!empty($data->freeCompany)? " - " . $data->freeCompany: ""), 154, 32, function ($c) {
					$c->file(base_path("resources/banner/noto-b.ttf"));
					$c->size(16);
				})
				->text($data->race . "\n" . $data->clan, 500, 53, function ($c) {
					$c->file(base_path("resources/banner/noto.ttf"));
					$c->size(12);
				})
				->text($data->grandCompany . "\n" . $data->grandCompanyRank, 500, 90, function ($c) {
					$c->file(base_path("resources/banner/noto.ttf"));
					$c->size(12);
				})
				->text($data->world, 500, 130, function ($c) {
					$c->file(base_path("resources/banner/noto.ttf"));
					$c->size(12);
				})
			;

			foreach($coords as $class => $pos) {
				$level = 0;
				if (isset($data->classjobs[$class])) {
					$level = $data->classjobs[$class]["level"];
				}
				$img->text($level, $pos[0], $pos[1], function ($c) {
					$c->file(base_path("resources/banner/noto.ttf"));
					$c->size(10);
				});
			}
		}, 60 * 20, true);


		return $img->response("png");
	}

}
