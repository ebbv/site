                <fieldset>
                  <legend>Contact</legend>
@foreach (['fixe', 'portable'] as $type)
<?php if (isset($m->phones)) {
    foreach ($m->phones as $p) {
        if ($p->type == ucfirst(substr($type, 0, 4))) {
            $phone_number = $p->number;
            break;
        }
    }
}?>
                  <label>Téléphone {{ $type }} :
                    <input name="telephone[{{ substr($type, 0, 4) }}]" type="tel" value="{{ $phone_number or '' }}" />
                  </label>
@endforeach
@foreach (['principal', 'secondaire'] as $key => $type)
                  <label>Mail ({{ $type }}) :
                    <input name="emails[]" type="email" value="<?php if (isset($m->emails[$key])) echo $m->emails[$key]->address; ?>" />
                  </label>
@endforeach
                </fieldset>
