@extends(Config::get('app.theme'))

@section('content')
                <div id="content" class="medium-5 medium-centered columns">
                    {{ Form::open(array('route' => 'members.store')) }}
                        <fieldset>
                            <legend>Membre</legend>
                            <label>Nom :
                                <input name="last_name" type="text" />
                            </label>
                            
                            <label>Prénom :
                                <input name="first_name" type="text" />
                            </label>
                        </fieldset>
                        <fieldset>
                            <legend>Adresse</legend>
                            <label>Numéro de la rue :
                                <input name="street_number" type="text" />
                            </label>
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
                            <label>Nom de la rue :
                                <input name="street_name" type="text" />
                            </label>
                            <label>Complément :
                                <input name="street_complement" type="text" />
                            </label>
                            <label>Code postal :
                                <input name="zip" type="text" />
                            </label>
                            <label>Ville :
                                <input name="city" type="text" />
                            </label>
                        </fieldset>
                        <fieldset>
                            <legend>Contact</legend>
                            <label>Téléphone fixe :
                                <input name="fixe" type="text" />
                            </label>
                            <label>Téléphone portable :
                                <input name="port" type="text" />
                            </label>
                            <label>Mail :
                                <input name="email" type="email" />
                            </label>
                        </fieldset>
                        <input class="button right" type="submit" value="Ajouter" />
                    {{ Form::close() }}
@stop
