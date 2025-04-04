@extends(config('app.theme'))

@section('content')
          <div class="mdc-layout-grid__inner" id="contact">
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-7"
                id="meeting-times">
              <h3>Nous rendre visite</h3>
              <p>Dimanche 9H45 - Formation biblique</p>
              <p>Dimanche 10H30 - Culte d'adoration</p>
              <p>Mardi 19H00 - Etude biblique et réunion de prière</p>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d653.112762641644!2d1.4774316999999892!3d49.09707109999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x24d87fa6b1ae5cba!2sEglise+Biblique+Baptiste!5e0!3m2!1sen!2s!4v1428444318261" width="100%" height="300" frameborder="0" style="border:0"></iframe>
            </div>
            <div class="mdc-layout-grid__cell
                        mdc-layout-grid__cell--span-5">
              <h3 id="telephone">Nous téléphoner <small>02.32.51.24.37</small></h3>
              <form accept-charset="utf-8" action="contact" id="contact-form" method="POST">
                @csrf

                <h3>Nous écrire</h3>
                <div class="mdc-text-field mdc-text-field--outlined">
                  <input aria-controls="email-validation-msg"
                        autocapitalize="none"
                        class="mdc-text-field__input"
                        id="email"
                        name="email"
                        required
                        type="email"
                        value="{{ old('email') }}">
                  <div class="mdc-notched-outline">
                    <div class="mdc-notched-outline__leading"></div>
                    <div class="mdc-notched-outline__notch">
                      <label class="mdc-floating-label" for="email">
                        E-mail
                      </label>
                    </div>
                    <div class="mdc-notched-outline__trailing"></div>
                  </div>
                </div>
                <p class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg"
                  id="email-validation-msg">
                  Obligatoire
                </p>
                <div class="mdc-text-field mdc-text-field--textarea">
                  <textarea class="mdc-text-field__input" id="body" name="body" required rows="5">{{ old('body') }}</textarea>
                  <div class="mdc-notched-outline">
                    <div class="mdc-notched-outline__leading"></div>
                    <div class="mdc-notched-outline__notch">
                      <label class="mdc-floating-label" for="body">
                        Question ou commentaire
                      </label>
                    </div>
                    <div class="mdc-notched-outline__trailing"></div>
                  </div>
                </div>
                <input id="username" name="username" value="{{ old('username') }}" />
                <button class="mdc-button mdc-button--raised"
                        type="submit"
                        value="@lang('forms.send_button')">
                  @lang('forms.send_button')
                </button>
              </form>
            </div>
          </div>
@endsection
