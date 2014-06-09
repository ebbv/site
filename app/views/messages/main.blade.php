@extends(Config::get('app.theme'))

@section('content')
                    <div class="row">
                        <p class="small-12 columns">
                            Ici nous vous proposons l'écoute des messages de notre église. Il vous
                            suffit de cliquer sur le titre du message pour démarrer la lecture. Notre
                            désir est d'édifier l'Eglise de Christ, et ce par un enseignement fidèle
                            à Dieu et sa Parole. Si vous rencontrez des problèmes, n'hésitez pas à
                            {{ link_to('contact.html', 'nous contacter.')."\n" }}
                        </p>
                    </div>
                    <div class="row">
                        <div class="small-12 columns" id="messages-table">
@foreach($messages as $message)
                            <div class="row">
                                <div class="small-4 columns full-name">
                                    <p>
                                        <span class="last-name">{{ $message->speaker->last_name }}</span>,
                                        {{ $message->speaker->first_name."\n" }}
                                    </p>
                                </div>
                                <div class="small-4 columns message-date">
                                    <p>{{ $message->date }}</p>
                                </div>
                                <div class="small-4 columns message-title">
                                    <p>{{ $message->title }}</p>
                                </div>
                            </div>
                            <div class="row player">
                                <div class="small-1 medium-1 large-1 columns">
                                    <span class="playtoggle"></span>
                                </div>
                                <div class="small-6 medium-7 large-8 columns">
                                    <span class="gutter">
                                        <span class="loading"></span>
                                        <span class="handle ui-slider-handle"></span>
                                    </span>
                                </div>
                                <div class="small-5 medium-4 large-3 columns text-center">
                                    <span class="timeleft"></span>
                                    <audio preload="metadata" buffered>
                                        <source src="audio/{{ $message->url.'.ogg' }}" type="audio/ogg">
                                        <source src="audio/{{ $message->url.'.mp3' }}" type="audio/mpeg">
                                        <source src="audio/{{ $message->url.'.wav' }}" type="audio/x-wav">
                                    </audio>
                                </div>
                            </div>
@endforeach
                        </div>
                    </div>
@stop