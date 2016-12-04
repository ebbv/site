<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\Address;
use App\Models\Email;
use App\Models\Member;
use App\Models\Phone;
use App\Models\Role;

class DirectoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyrole:admin', ['only' => 'create']);
    }

    public function index()
    {
        return view('directory.main')->withMembers(Member::with(['address', 'emails', 'phones' => function ($q) {
            $q->orderBy('type', 'asc');
        }])->whereHas('roles', function ($q) {
            $q->where('name', 'membre');
        })->orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get());
    }

    public function create()
    {
        return view('directory.admin.main')->with([
            'emails'        => $this->getEmailInfo(),
            'phones'        => $this->getPhoneInfo(),
            'roles'         => $this->getRoles(),
            'street_type'   => $this->getAddressType()
        ]);
    }

    public function edit(Member $member)
    {
        $member = $member->load('address', 'emails', 'phones', 'roles');

        if (Auth::id() == $member->id or (Auth::user()->roles()->count() > 0 and Auth::user()->roles[0]->name == 'administrateur')) {
            return view('directory.admin.main')->with([
                'emails'            => $this->getEmailInfo($member),
                'm'                 => $member,
                'phones'            => $this->getPhoneInfo($member),
                'roles'             => $this->getRoles($member),
                'street_type'       => $this->getAddressType($member),
                'submitButtonText'  => trans('forms.edit_button')
            ]);
        }

        return view('errors.no_admin');
    }

    public function store(Request $r)
    {
        switch ($r->submit) {
            case trans('forms.add_button'):
                $this->add($r);
                break;
            case trans('forms.edit_button'):
                $this->update($r);
                break;
            case trans('forms.delete_button'):
                $this->delete($r->id);
                break;
        }

        return redirect(trans('nav.directory.url'));
    }

    private function add($r)
    {
        $m = new Member;
        $m->first_name  = $r->first_name;
        $m->last_name   = $r->last_name;
        $m->username    = '';
        $m->password    = '';
        $m->created_by  = $r->user()->id;
        $m->updated_by  = $r->user()->id;
        $m->save();

        foreach ($r->role as $value) {
            $m->roles()->attach($value, [
                'created_by' => $r->user()->id,
                'updated_by' => $r->user()->id
            ]);
        }

        $m->address()->save(new Address([
            'street_number'     => $r->street_number,
            'street_type'       => $r->street_type,
            'street_name'       => $r->street_name,
            'street_complement' => $r->street_complement,
            'zip'               => $r->zip,
            'city'              => $r->city,
            'created_by'        => $r->user()->id,
            'updated_by'        => $r->user()->id
        ]));

        foreach ($r->telephone as $type => $number) {
            if ($number != '') {
                $m->phones()->save(new Phone([
                    'number'    => $number,
                    'type'      => ucfirst($type),
                    'created_by'=> $r->user()->id,
                    'updated_by'=> $r->user()->id
                ]));
            }
        }

        foreach ($r->emails as $key => $address) {
            if ($address != '') {
                $m->emails()->save(new Email([
                    'address'   => $address,
                    'type'      => $key,
                    'created_by'=> $r->user()->id,
                    'updated_by'=> $r->user()->id
                ]));
            }
        }
    }

    private function update($r)
    {
        $id = $r->id;

        $m = Member::find($id);
        $m->first_name  = $r->first_name;
        $m->last_name   = $r->last_name;
        $m->updated_by  = $r->user()->id;
        $m->save();

        foreach ($m->roles as $role) {
            $oldid = $role->pivot->role_id;

            $oldids[] = $role->pivot->role_id;

            if (! in_array($oldid, $r->role)) {
                $m->roles()->detach($oldid);
            } else {
                $m->roles()->updateExistingPivot($oldid, ['updated_by' => $r->user()->id]);
            }
        }

        foreach ($r->role as $newid) {
            if (! in_array($newid, $oldids)) {
                $m->roles()->attach($newid, [
                    'created_by' => $r->user()->id,
                    'updated_by' => $r->user()->id
                ]);
            }
        }

        Address::where('member_id', $id)->update([
            'street_number'     => $r->street_number,
            'street_type'       => $r->street_type,
            'street_name'       => $r->street_name,
            'street_complement' => $r->street_complement,
            'zip'               => $r->zip,
            'city'              => $r->city,
            'updated_by'        => $r->user()->id
        ]);

        foreach ($r->telephone as $type => $number) {
            $type = ucfirst($type);

            if ($number != '') {
                if (! Phone::where('member_id', $id)->where('type', $type)->update([
                    'number'      => $number,
                    'updated_by'  => $r->user()->id
                ])) {
                    $m->phones()->save(new Phone([
                        'number'    => $number,
                        'type'      => $type,
                        'created_by'=> $r->user()->id,
                        'updated_by'=> $r->user()->id
                    ]));
                }
            } elseif ($number == '') {
                Phone::where('member_id', $id)->where('type', $type)->delete();
            }
        }

        foreach ($r->emails as $key => $address) {
            if ($address != '') {
                if (! Email::where('member_id', $id)->where('type', $key)->update([
                  'address'   => $address,
                  'updated_by'=> $r->user()->id
                ])) {
                    $m->emails()->save(new Email([
                        'address'   => $address,
                        'type'      => $key,
                        'created_by'=> $r->user()->id,
                        'updated_by'=> $r->user()->id
                    ]));
                }
            } elseif ($address == '') {
                Email::where('member_id', $id)->where('type', $key)->delete();
            }
        }
    }

    private function delete($id)
    {
        if ($id >= 4) { /* Making sure none of the default users are deleted */
            $m = Member::find($id);
            $m->address()->delete();
            $m->phones()->delete();
            $m->emails()->delete();
            $m->roles()->detach();
            $m->delete();
        }
    }

    private function getAddressType($member = null)
    {
        foreach (['rue', 'allée', 'boulevard', 'chemin', 'route'] as $key => $value) {
            $types[$key]['name']    = $value;
            $types[$key]['selected']= '';

            if ($member != null) {
                if ($value == $member->address->street_type) {
                    $types[$key]['selected'] = ' selected';
                }
            }
        }

        return $types;
    }

    private function getEmailInfo($member = null)
    {
        foreach (['principal', 'secondaire'] as $key => $value) {
            $info[$key]['type'] = $value;
            $info[$key]['val']  = '';

            if ($member != null) {
                if (isset($member->emails[$key])) {
                    $info[$key]['val'] = $member->emails[$key]->address;
                }
            }
        }

        return $info;
    }

    private function getPhoneInfo($member = null)
    {
        foreach (['fixe', 'portable'] as $key => $value) {
            $info[$key]['long']     = $value;
            $info[$key]['short']    = substr($value, 0, 4);
            $info[$key]['number']   = '';

            if ($member != null) {
                if (isset($member->phones[$key])) {
                    $info[$key]['number'] = $member->phones[$key]->number;
                }
            }
        }

        return $info;
    }

    private function getRoles($member = null)
    {
        $roles = Role::all()->map(function ($item) {
            $item['checked'] = '';
            return $item;
        });

        if ($member == null) {
            return $roles;
        }

        foreach ($roles as $role) {
            foreach ($member->roles as $mem_role) {
                if ($role->name == $mem_role->name) {
                    $role->checked = ' checked';
                }
            }
        }

        return $roles;
    }
}
