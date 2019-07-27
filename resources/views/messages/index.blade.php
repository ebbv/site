@extends(config('app.theme'))

@section('aside')
        <aside class="mdc-layout-grid__cell
                      mdc-layout-grid__cell--span-3-tablet
                      mdc-layout-grid__cell--span-4-desktop"
                id="sidebar">
          <p>
            @lang('main.welcome') 
          </p>
        </aside>
@endsection

@section('content-wrapper')
        <div class="mdc-layout-grid__cell
                    mdc-layout-grid__cell--span-5-tablet
                    mdc-layout-grid__cell--span-8-desktop
                    message-cards"
             id="content">
@endsection

@section('content')
@foreach ($messages as $message)
          @include('messages.card', ['type' => 'list'])
@endforeach

{{ $messages->onEachSide(2)->links() }}

@can ('create', App\Message::class)
          <a href="{{ route('messages.create') }}">
            <button aria-label="Add" class="material-icons mdc-fab">
              <span class="mdc-fab__icon">
                add
              </span>
            </button>
          </a>
@endcan
@endsection
