@extends(Config::get('app.theme'))

@section('content')
                <div id="content" class="medium-10 medium-centered columns">
                    <div class="row" id="add-message">
                        {{ Form::open(array('route' => 'message.store', 'class'=>'small-12 columns'))."\n" }}
                            <div class="row">
                                <div class="medium-8 columns">
                                    <label for="title">Titre :</label>
                                    <input autofocus id="title" name="title" type="text" value="">
                                </div>
                                <div class="medium-4 columns">
                                    <label for="speaker">Orateur :</label>
                                    <select id="speaker" name="speaker">
                                        <!-- <option></option> -->
@foreach($speakers as $speaker)
                                        <option value="{{ $speaker->id }}">{{ $speaker->last_name }}, {{ $speaker->first_name }}</option>
@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 columns">
                                    <label for="message-passage">Passage :</label>
                                    <input id="message-passage" name="message-passage" type="text" value="">
                                </div>
                                <div class="medium-3 columns">
                                    <label for="message-file">Fichier :</label>
                                    <select id="message-file" name="message-file">
@foreach($files as $file)
                                        <option value="{{ $file }}">{{ $file }}</option>
@endforeach
                                    </select>
                                </div>
                                <div class="medium-3 columns">
                                    <input class="button tiny right" type="submit" value="Ajouter">
                                </div>
                            </div>
                        {{ Form::close()."\n" }}
                    </div>
@stop