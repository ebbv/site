@extends(config('app.theme'))

@section('content')
          <div class="mdc-layout-grid__inner" id="directory-list">
@foreach ($members as $member)
            <div class="mdc-layout-grid__cell">
              <div class="mdc-card">
                <section class="mdc-card__primary">
                  <h3>
                    <span class="last-name">{{ $member->last_name }}</span>, {{ $member->first_name }}
                  </h3>
                </section>
                <section class="mdc-card__secondary">
@foreach ($member->addresses as $address)
                  <div class="address">
                    <p>{{ $address->streetAddress }}</p>
                    <p>{{ $address->zip }} {{ $address->city }}</p>
                  </div>
@endforeach
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
@endsection
