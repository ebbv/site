<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Address;
use App\Models\Phone;
use App\Models\Email;

class DirectoryController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('verifyrole:admin', ['only' => 'create']);
  }

  public function show()
  {
    return view('directory.main')->withMembers(Member::with(array('address', 'emails', 'phones' => function($q) {
      $q->orderBy('type', 'asc');
    }))->whereHas('roles', function($q) {
      $q->where('name', 'membre');
    })->orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get());
  }

  public function create()
  {
    return view('directory.create');
  }

  public function edit(Request $r, $id)
  {
    if($r->user()->id == $id OR Member::has('admin')->find($r->user()->id))
    {
      return view('directory.edit')->withM(Member::find($id));
    }
    return view('errors.no_admin');
  }

  public function store(Request $r)
  {
    switch($r->submit) {
      case 'Ajouter':
        $this->_add($r);
        break;
      case 'Modifier':
        $this->_update($r);
        break;
      case 'Supprimer':
        $this->_delete($r->id);
        break;
    }
    return redirect('annuaire');
  }

  private function _add($r)
  {
    $m = new Member;
    $m->first_name  = $r->first_name;
    $m->last_name   = $r->last_name;
    $m->username    = '';
    $m->password    = '';
    $m->created_by  = $r->user()->id;
    $m->updated_by  = $r->user()->id;
    $m->save();

    $m->roles()->attach(2, array(
      'created_by' => $r->user()->id,
      'updated_by' => $r->user()->id
    ));

    $m->address()->save(new Address(array(
      'street_number'     => $r->street_number,
      'street_type'       => $r->street_type,
      'street_name'       => $r->street_name,
      'street_complement' => $r->street_complement,
      'zip'               => $r->zip,
      'city'              => $r->city,
      'created_by'        => $r->user()->id,
      'updated_by'        => $r->user()->id
    )));

    foreach($r->telephone as $type => $number)
    {
      if($number != '')
      {
        $m->phones()->save(new Phone(array(
          'number'        => $number,
          'type'          => ucfirst($type),
          'created_by'    => $r->user()->id,
          'updated_by'    => $r->user()->id
        )));
      }
    }

    foreach($r->emails as $key => $address)
    {
      if($address != '')
      {
        $m->emails()->save(new Email(array(
          'address'       => $address,
          'type'          => $key,
          'created_by'    => $r->user()->id,
          'updated_by'    => $r->user()->id
        )));
      }
    }
  }

  private function _update($r)
  {
    $id = $r->id;
    $m = Member::find($id);
    $m->first_name  = $r->first_name;
    $m->last_name   = $r->last_name;
    $m->updated_by  = $r->user()->id;
    $m->save();

    Address::where('member_id', $id)->update(array(
      'street_number'     => $r->street_number,
      'street_type'       => $r->street_type,
      'street_name'       => $r->street_name,
      'street_complement' => $r->street_complement,
      'zip'               => $r->zip,
      'city'              => $r->city,
      'updated_by'        => $r->user()->id
    ));

    foreach($r->telephone as $type => $number)
    {
      $type = ucfirst($type);
      if($number != '')
      {
        if( ! Phone::where('member_id', $id)->where('type', $type)->update(array(
          'number'      => $number,
          'updated_by'  => $r->user()->id
        )))
        {
          $m->phones()->save(new Phone(array(
            'number'        => $number,
            'type'          => $type,
            'created_by'    => $r->user()->id,
            'updated_by'    => $r->user()->id
          )));
        }
      }
      elseif($number == '')
      {
        Phone::where('member_id', $id)->where('type', $type)->delete();
      }
    }

    foreach($r->emails as $key => $address)
    {
      if($address != '')
      {
        if( ! Email::where('member_id', $id)->where('type', $key)->update(array(
          'address'   => $address,
          'updated_by'=> $r->user()->id
        )))
        {
          $m->emails()->save(new Email(array(
            'address'   => $address,
            'type'      => $key,
            'created_by'=> $r->user()->id,
            'updated_by'=> $r->user()->id
          )));
        }
      }
      elseif($address == '')
      {
        Email::where('member_id', $id)->where('type', $key)->delete();
      }
    }
  }

  private function _delete($id)
  {
    if($id >= 4) /* Making sure none of the default users are deleted */
    {
      $m = Member::find($id);
      $m->address()->delete();
      $m->phones()->delete();
      $m->emails()->delete();
      $m->roles()->detach();
      $m->delete();
    }
  }
}
