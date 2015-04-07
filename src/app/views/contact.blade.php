@extends(Config::get('app.theme'))

@section('content')
                <div id="content" class="small-12 columns">
                    <div class="row" id="contact">
                        <div class="small-12 medium-7 columns">
                            <h3>Nous rendre visite</h3>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d653.112762641644!2d1.4774316999999892!3d49.09707109999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x24d87fa6b1ae5cba!2sEglise+Biblique+Baptiste!5e0!3m2!1sen!2s!4v1428444318261" width="100%" height="300" frameborder="0" style="border:0"></iframe>
                        </div>
                        <div class="medium-5 columns">
                            <h3 id="telephone">Nous téléphoner <small>02.32.51.24.37</small></h3>
                            <h3>Nous écrire</h3>
                            {{ Form::open(array('url' => 'contact.html', 'data-abide')) }}
                                <div id="email">
                                    <label>E-mail
                                        <input id="" name="email" type="email" placeholder="exemple@exemple.com" required />
                                    </label>
                                    <small class="error">Veuillez entrer une adresse email valide</small>
                                </div>
                                <div>
                                    <label>Question ou commentaire
                                        <textarea name="body" rows="5"></textarea>
                                    </label>
                                </div>
                                <input class="button small right" type="submit" value="Envoyer" />
                            {{ Form::close() }}
                        </div>
                    </div>
@stop
