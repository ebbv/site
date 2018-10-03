@extends(config('app.theme'))

@section('content')
          <div class="mdc-layout-grid__inner" id="directory-list">
@foreach ($members as $member)
            <div class="mdc-layout-grid__cell">
              <div class="mdc-card">
                <section class="mdc-card__primary">
                  <h3>
                    <a href="{{ $member->path() }}">
                      <span class="last-name">{{ $member->last_name }}</span>, {{ $member->first_name }}
                    </a>
                  </h3>
                </section>
                <section class="mdc-card__secondary">
@isset ($member->address)
                  <div class="address">
                    <p>{{ $member->address->streetAddress }}</p>
                    <p>{{ $member->address->zip }} {{ $member->address->city }}</p>
                  </div>
@endisset
                  <hr class="mdc-list-divider" role="separator">
                  <ul class="mdc-list mdc-list--dense mdc-list--non-interactive phones">
@foreach ($member->phones as $p)
                    <li class="mdc-list-item">
                      <i class="material-icons mdc-list-item__start-detail">
                        {{ ($p->type == 'fixe') ? 'phone' : 'smartphone'}}
                      </i>
                      {{ $p->number }}
                    </li>
@endforeach
                  </ul>
@isset ($member->emails)
                  <hr class="mdc-list-divider" role="separator">
                  <ul class="emails mdc-list mdc-list--dense mdc-list--non-interactive">
@foreach ($member->emails as $e)
                    <li class="mdc-list-item">
                      <i class="material-icons mdc-list-item__start-detail">email</i>
                      {{ $e->address }}
                    </li>
@endforeach
@endisset
                  </ul>
                </section>
              </div>
            </div>
@endforeach
          </div>
@can ('create', App\User::class)
          <a href="{{ route('directory.create') }}">
            <button aria-label="Add" class="material-icons mdc-fab">
              <span class="mdc-fab__icon">
                add
              </span>
            </button>
          </a>
@endcan
@endsection
