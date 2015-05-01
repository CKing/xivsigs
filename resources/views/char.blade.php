@extends("app")

@section("content")
	<style>
		.fc-icon {
			position: relative;
			height: 26px;
			display: inline-block;
		}

		.fc-icon img {
			position: absolute;
			left: 0;
			top: 0;
			height: 100%;
		}

		.fc-icon img:first-child {
			position: relative;
		}
	</style>

	<h1 class="page-header"><a href="http://de.finalfantasyxiv.com/lodestone/character/{{ $data->id }}/">{{ $data->name }}</a></h1>

	<div class="row">
		<div class="col-lg-3">
			<img src="{{ route("img", ["type" => "portrait", "id" => $data->id, "size" => "320x"]) }}" alt="Portrait von {{ $data->name }}" class="img-responsive">
		</div>

		<div class="col-lg-9">
			<dl class="dl-horizontal">
				<dt>Welt</dt>
				<dd>{{ $data->world }}</dd>

				<dt>Rasse</dt>
				<dd>{{ $data->race }} - {{ $data->clan }}</dd>

				<dt>Staatliche Gesellschaft</dt>
				@if (!empty($data->grandCompany))
					<dd>{{ $data->grandCompany }} - <img src="{{ route("img", ["type" => "grandCompanyIcon", "id" => $data->id, "size" => "x26"]) }}" style="height: 26px;"> {{ $data->grandCompanyRank }}</dd>
				@else
					<dd><i>Keine</i></dd>
				@endif

				<dt>Freie Gesellschaft</dt>
				@if (!empty($data->freeCompanyId))
					<dd><a href="http://de.finalfantasyxiv.com/lodestone/freecompany/{{ $data->freeCompanyId }}/">
						<img src="{{ route("img", ["type" => "freeCompanyIcon", "id" => $data->id, "size" => "x26"]) }}" alt="Logo von {{ $data->freeCompany }}">
						{{ $data->freeCompany }}
					</a></dd>
				@else
					<dd><i>Keine</i></dd>
				@endif

				<dt>Klassen</dt>
				<dd>
					<table class="table table-condensed">
						<tr>
							<td><img src="/images/gladiator.png"></td>
							<td><img src="/images/marauder.png"></td>
							<td><img src="/images/pugilist.png"></td>
							<td><img src="/images/lancer.png"></td>
							<td><img src="/images/archer.png"></td>
							<td><img src="/images/rouge.png"></td>
							<td><img src="/images/thaumaturge.png"></td>
							<td><img src="/images/arcanist.png"></td>
							<td><img src="/images/conjourer.png"></td>
						</tr>
						<tr>
							<td>{{ $data->classjobs["gladiator.level"] or 0 }}</td>
							<td>{{ $data->classjobs["marauder.level"] or 0 }}</td>
							<td>{{ $data->classjobs["pugilist.level"] or 0 }}</td>
							<td>{{ $data->classjobs["lancer.level"] or 0 }}</td>
							<td>{{ $data->classjobs["archer.level"] or 0 }}</td>
							<td>{{ $data->classjobs["rouge.level"] or 0 }}</td>
							<td>{{ $data->classjobs["thaumaturge.level"] or 0 }}</td>
							<td>{{ $data->classjobs["arcanist.level"] or 0 }}</td>
							<td>{{ $data->classjobs["conjurer.level"] or 0 }}</td>
						</tr>
						<tr>
							<td><img src="/images/carpenter.png"></td>
							<td><img src="/images/blacksmith.png"></td>
							<td><img src="/images/armorer.png"></td>
							<td><img src="/images/goldsmith.png"></td>
							<td><img src="/images/leatherworker.png"></td>
							<td><img src="/images/weaver.png"></td>
							<td><img src="/images/alchemist.png"></td>
							<td><img src="/images/culinarian.png"></td>
							<td rowspan="4">&nbsp;</td>
						</tr>
						<tr>
							<td>{{ $data->classjobs["carpenter.level"] or 0 }}</td>
							<td>{{ $data->classjobs["blacksmith.level"] or 0 }}</td>
							<td>{{ $data->classjobs["armorer.level"] or 0 }}</td>
							<td>{{ $data->classjobs["goldsmith.level"] or 0 }}</td>
							<td>{{ $data->classjobs["leatherworker.level"] or 0 }}</td>
							<td>{{ $data->classjobs["weaver.level"] or 0 }}</td>
							<td>{{ $data->classjobs["alchemist.level"] or 0 }}</td>
							<td>{{ $data->classjobs["culinarian.level"] or 0 }}</td>
						</tr>
						<tr>
							<td><img src="/images/miner.png"></td>
							<td><img src="/images/botanist.png"></td>
							<td><img src="/images/fisher.png"></td>
							<td colspan="4" rowspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td>{{ $data->classjobs["miner.level"] or 0 }}</td>
							<td>{{ $data->classjobs["botanist.level"] or 0 }}</td>
							<td>{{ $data->classjobs["fisher.level"] or 0 }}</td>
						</tr>
					</table>
				</dd>

				<dt>Signatur</dt>
				<dd><img src="{{ route("signature", [ "id" => $data->id, "name" => $data->slug ]) }}" alt="Signatur von {{ $data->name }}"></dd>

				<dt>BBCode</dt>
				<dd><input type="text" value="[URL={{ route("char", ["id" => $data->id, "slug" => $data->slug]) }}][IMG]{{ route("signature", ["id" => $data->id, "slug" => $data->slug]) }}[/IMG][/URL]" class="form-control"></dd>

				<dt>Markdown</dt>
				<dd><input type="text" value="[![Signatur von {{ $data->name }}]{{ route("signature", ["id" => $data->id, "slug" => $data->slug]) }}]({{ route("char", ["id" => $data->id, "slug" => $data->slug]) }})" class="form-control"></dd>


				<dt>HTML</dt>
				<dd><input type="text" value="<a href='{{ route("char", ["id" => $data->id, "slug" => $data->slug]) }}' target='_BLANK'><img src='{{ route("signature", ["id" => $data->id, "slug" => $data->slug]) }}' alt='Signatur von {{ $data->name }}'></a>'" class="form-control"></dd>
			</dl>
		</div>
	</div>
@endsection

@section("scripts")
@endsection
