@extends(config('app.theme'))

@section('content')
<div>
  <form accept-charset="utf-8" method="GET">
    <label>
      Numéro
      <input autofocus name="num" type="number" value="{{ request()->query('num') }}">
    </label>
    dans
    <select name="recueil">
@foreach (\App\Songbook::all() as $book)
      <option value="{{ $book->id }}">{{ $book->title }}</option>
@endforeach
    </select>
    <button type="submit">Rechercher</button>
  </form>
@forelse ($songs as $song)
  <div>
    <p>
      {{ $song->songbooks->first()->pivot->number }} : {{ $song->title }}</p>
    <p>Ce chant a été chanté <strong>{{ $song->dates_count }}</strong> fois</p>
    <ul>
@foreach ($song->dates->pluck('date') as $date)
      <li>Le {{ strftime("%A %e %B, %Y", strtotime($date)) }}</li>
@endforeach
    </ul>
  </div>
@empty
@if (request()->filled('num'))
  <p>Ce chant n'a pas encore été chanté</p>
@endif
@endforelse
</div>
@endsection
