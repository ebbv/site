@extends(Config::get('app.theme'))

@section('content')
                <div id="content" class="small-12 columns">
                    {{ Form::open(array('route' => 'members.store')) }}
                        <div class="row">
                            <div class="medium-3 columns">
                                <fieldset>
                                    <legend>Identification</legend>
                                    <label>Nom :
                                        <input name="last_name" type="text" />
                                    </label>
                                    
                                    <label>Prénom :
                                        <input name="first_name" type="text" />
                                    </label>
                                </fieldset>
                            </div>
                            <div class="medium-6 columns">
                                <fieldset>
                                    <legend>Adresse</legend>
                                    <div class="row">
                                        <div class="small-6 medium-4 columns">
                                            <label>Numéro de rue :
                                                <input name="street_number" type="text" />
                                            </label>
                                        </div>
                                        <div class=" small-6 medium-8 columns">
                                            <label>Type de rue :
                                                <select name="street_type">
                                                    <option></option>
                                                    <option>rue</option>
                                                    <option>allée</option>
                                                    <option>boulevard</option>
                                                    <option>chemin</option>
                                                    <option>route</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <label>Nom de la rue :
                                        <input name="street_name" type="text" />
                                    </label>
                                    <label>Complément :
                                        <input name="street_complement" type="text" />
                                    </label>
                                    <div class="row">
                                        <div class="small-5 medium-4 columns">
                                            <label>Code postal :
                                                <input name="zip" type="text" />
                                            </label>
                                        </div>
                                        <div class="small-7 medium-8 columns">
                                            <label>Ville :
                                                <input name="city" type="text" />
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="medium-3 columns">
                                <fieldset>
                                    <legend>Contact</legend>
                                    <label>Téléphone fixe :
                                        <input name="fixe" type="text" />
                                    </label>
                                    <label>Téléphone portable :
                                        <input name="port" type="text" />
                                    </label>
                                    <label>Mail (principal) :
                                        <input name="email[]" type="email" />
                                    </label>
                                    <label>Mail (secondaire) :
                                        <input name="email[]" type="email" />
                                    </label>
                                </fieldset>
                            </div>
                        </div>
                        <input class="button right" type="submit" value="Ajouter" />
                    {{ Form::close() }}
@stop
