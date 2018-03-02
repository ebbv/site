@extends(config('app.theme'))

@section('content')
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12" id="content">
          <div class="mdc-layout-grid" id="directory-list">
            <div class="mdc-layout-grid__inner">
@foreach ($members as $m)
              <div class="mdc-layout-grid__cell">
                <div class="mdc-card">
                  <section class="mdc-card__primary">
                    <h1>
                      <span class="last-name">{{ $m->last_name }}</span><span>, {{ $m->first_name }}</span>
                    </h1>
                  </section>
                  <section class="mdc-card__secondary">
                    <div class="address">
                      <p class="street-address">
                        {{ ($m->address->street_number != 0) ? $m->address->street_number.',' : '' }}
                        {{ $m->address->street_type }}
                        {{ $m->address->street_name }}
                      </p>
                      <p>{{ $m->address->street_complement }}</p>
                      <p>
                        <span class="zip">{{ $m->address->zip }}</span>
                        <span class="locality">{{ $m->address->city }}</span>
                      </p>
                    </div>
                    <hr class="mdc-list-divider" role="separator">
                    <ul class="mdc-list mdc-list--dense mdc-list--non-interactive phones">
@foreach ($m->phones as $p)
                      <li class="mdc-list-item">
                        <i class="mdc-list-item__start-detail material-icons">{{ ($p->type == 'Fixe') ? 'phone' : 'smartphone'}}</i>
                        {{ $p->number }}
                      </li>
@endforeach
                    </ul>
@if (count($m->emails) > 0)
                    <hr class="mdc-list-divider" role="separator">
@endif
                    <ul class="mdc-list mdc-list--dense mdc-list--non-interactive emails">
@foreach ($m->emails as $key => $e)
                      <li class="mdc-list-item">
                        <i class="mdc-list-item__start-detail material-icons">email</i>
                        {{ $e->address }}
                      </li>
@endforeach
                    </ul>
                  </section>
@can ('update-member', $m->id)
                  <section class="mdc-card__actions">
                    <a href="{{ route('directory.edit', $m->id) }}">
                      <i class="material-icons mdc-card__action mdc-card__action-icon" role="button">edit</i>
                    </a>
                    <form method="POST" action="{{ route('directory.destroy', $m->id) }}" accept-charset="utf-8">
                      {{ method_field('DELETE') }}
                      {{ csrf_field() }}
                      <i class="cancel material-icons mdc-card__action mdc-card__action-icon" role="button">delete</i>
                    </form>
                  </section>
@endcan
                </div>
              </div>
@endforeach
            </div>
          </div>
@can ('update-member', $m->id)
          <a href="{{ route('directory.create') }}">
            <button class="mdc-fab material-icons" aria-label="Add">
              <span class="mdc-fab__icon">
                add
              </span>
            </button>
          </a>
@endcan
@endsection
