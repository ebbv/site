@extends(Config::get('app.theme'))

@section('content')
                    <div class="row">
                        <div class="small-12 columns" id="messages-table">
@foreach($messages as $message)
                            <div class="row message-info">
                                <div class="small-12 medium-5 columns full-name">
                                    <p>
                                        <span class="last-name">{{ $message->speaker->last_name }}</span>, {{ $message->speaker->first_name."\n" }}
                                    </p>
                                    <p class="message-date">
                                        {{ $message->date }}
                                    </p>
                                </div>
                                <div class="medium-7 columns">
                                    <p class="message-title">
                                        <a download="{{ $message->title }}" href="audio/{{ $message->url.'.mp3' }}">{{ $message->title }}</a>
                                    </p>
                                    <p class="message-passage">{{ $message->passage }}</p>
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

                    <div class="pagination-centered">
                        <ul class="pagination">
@if($curpage == 1)
                            <li class="unavailable"><a>&laquo;</a></li>
@else
                            <li><a href="{{ $curpage - 1 }}">&laquo;</a></li>
@endif
@for($i = 1; $i <= $pages; $i++)
@if($curpage == $i)
                            <li class="current"><a>{{ $i }}</a></li>
@else
                            <li><a href="{{ $i }}">{{ $i }}</a></li>
@endif
@endfor
@if($curpage == $pages)
                            <li class="unavailable"><a>&raquo;</a></li>
@else
                            <li><a href="{{ $curpage + 1 }}">&raquo;</a></li>
@endif
                        </ul>
                    </div>
@stop
