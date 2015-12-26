<?php

namespace App\Http\Controllers;

use Auth;
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
    $this->middleware('verifyrole:admin', ['except' => 'index']);
  }

  public function index()
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

  public function store(Request $request)
  {
    if($request->submit == 'Ajouter')
    {
      $m = new Member;
      $m->first_name  = $request->first_name;
      $m->last_name   = $request->last_name;
      $m->username    = '';
      $m->password    = '';
      $m->created_by  = Auth::id();
      $m->updated_by  = Auth::id();
      $m->save();

      $m->roles()->attach(2, array(
        'created_by' => Auth::id(),
        'updated_by' => Auth::id()
      ));

      $m->address()->save(new Address(array(
        'street_number'     => $request->street_number,
        'street_type'       => $request->street_type,
        'street_name'       => $request->street_name,
        'street_complement' => $request->street_complement,
        'zip'               => $request->zip,
        'city'              => $request->city,
        'created_by'        => Auth::id(),
        'updated_by'        => Auth::id()
      )));

      foreach($request->telephone as $type => $number)
      {
        if($number != '')
        {
          $m->phones()->save(new Phone(array(
            'number'        => $number,
            'type'          => ucfirst($type),
            'created_by'    => Auth::id(),
            'updated_by'    => Auth::id()
          )));
        }
      }

      foreach($request->emails as $key => $address)
      {
        if($address != '')
        {
          $m->emails()->save(new Email(array(
            'address'       => $address,
            'type'          => $key,
            'created_by'    => Auth::id(),
            'updated_by'    => Auth::id()
          )));
        }
      }
    }
    else {
      $id = $request->id;
      $m = Member::find($id);
      $m->first_name  = $request->first_name;
      $m->last_name   = $request->last_name;
      $m->updated_by  = Auth::id();
      $m->save();

      Address::where('member_id', $id)->update(array(
        'street_number'     => $request->street_number,
        'street_type'       => $request->street_type,
        'street_name'       => $request->street_name,
        'street_complement' => $request->street_complement,
        'zip'               => $request->zip,
        'city'              => $request->city,
        'updated_by'        => Auth::id()
      ));

      foreach($request->telephone as $type => $number)
      {
        $type = ucfirst($type);
        if($number != '')
        {
          if( ! Phone::where('member_id', $id)->where('type', $type)->update(array(
            'number'      => $number,
            'updated_by'  => Auth::id()
          )))
          {
            $m->phones()->save(new Phone(array(
              'number'        => $number,
              'type'          => $type,
              'created_by'    => Auth::id(),
              'updated_by'    => Auth::id()
            )));
          }
        }
        elseif($number == '')
        {
          Phone::where('member_id', $id)->where('type', $type)->delete();
        }
      }

      foreach($request->emails as $key => $address)
      {
        if($address != '')
        {
          if( ! Email::where('member_id', $id)->where('type', $key)->update(array(
            'address'   => $address,
            'updated_by'=> Auth::id()
          )))
          {
            $m->emails()->save(new Email(array(
              'address'   => $address,
              'type'      => $key,
              'created_by'=> Auth::id(),
              'updated_by'=> Auth::id()
            )));
          }
        }
        elseif($address == '')
        {
          Email::where('member_id', $id)->where('type', $key)->delete();
        }
      }
    }

    return $this->create();
  }

  public function edit(Request $request, $id)
  {
    if(Auth::id() == $id OR Member::has('admin')->find(Auth::id()))
    {
      return view('directory.edit')->withM(Member::find($id));
    }
    else {
      return view('errors.no_admin');
    }
  }
}
