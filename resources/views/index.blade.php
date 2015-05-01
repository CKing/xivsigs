@extends("app")

@section("content")
	<h1 class="page-header">XIV Sigs</h1>

	<p>
		Erstelle deine eigene Final Fantasy XIV Signatur!<br>
		Einfach Formular ausfüllen und dann den Code kopieren.
	</p>

	{!! Form::horizontal(["id" => "search-form"]) !!}
		{!! ControlGroup::generate(Form::label("world", "Welt"), Form::select("world", $servers), null, 2) !!}
		{!! ControlGroup::generate(Form::label("name", "Charakter"), Form::text("name"), null, 2) !!}
		<div class="col-sm-10 col-sm-offset-2">{!! Button::primary("Suchen")->submit() !!}</div>
	{!! Form::close() !!}

	<div id="char-results" style="display: none" data-template='
		<div class="col-xs-3 char">
			<div class="thumbnail">
				<img src="@{{ avatar }}" alt="Avatar von @{{ name }}">
				<div class="caption">
					<h3>@{{ name }}</h3>
					<p><button class="btn select-char" data-id="@{{ id }}" data-name="@{{ name }}">Auswählen</button></p>
				</div>
			</div>
		</div>
	'></div>
@endsection

@section("scripts")
	<script type="text/javascript">
		var route = "{{ route("char", [ "id" => "%ID%", "name" => "%SLUG%" ]) }}";
		var $f = $('#search-form');
		var $world = $('#world');
		var $name = $('#name');
		var $button = $f.find("button");
		var $r = $('#char-results');

		// precompile template
		$r.data("template", Handlebars.compile($r.data("template")));

		$f.submit(function () {
			$button.prop("disabled", true);
			$world.prop("disabled", true);
			$name.prop("disabled", true);

			$r.slideUp().find(".char").remove();
			$.get("{{ route("ajax.lodestone") }}", { world: $world.val(), name: $name.val() }, function (results) {
				if (Array.isArray(results)) {
					results.forEach(function (result) {
						$r.append($r.data("template")(result))
					})
				} else {
					$r.append($r.data("template")(results));
				}

				$r.slideDown();
				$button.prop("disabled", false);
				$world.prop("disabled", false);
				$name.prop("disabled", false);
			})

			return false;
		})

		$r.on("click", ".select-char", function () {
			var url = route
				.replace("%ID%", this.dataset.id)
				.replace("%SLUG%", this.dataset.name.toLowerCase()
					.replace(" ", "-")
					.replace(/[^-a-z]/g, "")
				)
			;
			window.location.href = url;
		})
	</script>
@endsection
