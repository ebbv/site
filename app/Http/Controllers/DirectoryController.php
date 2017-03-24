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
        $this->middleware('verifyrole:admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('directory.main')->withMembers(Member::with(['address', 'emails' => function ($q) {
            $q->orderBy('type', 'asc');
        }, 'phones' => function ($q) {
            $q->orderBy('type', 'asc');
        }])->whereHas('roles', function ($q) {
            $q->where('name', 'membre');
        })->orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return $member;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('directory.admin.main')->with([
            'emails'        => $this->getEmailInfo(),
            'phones'        => $this->getPhoneInfo(),
            'roles'         => $this->getRoles(),
            'route'         => route('directory.store'),
            'street_type'   => $this->getAddressType()
        ]);
    }

    /**
     * Store the newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $r
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
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
            if ($number != null) {
                $m->phones()->save(new Phone([
                    'number'    => $number,
                    'type'      => ucfirst($type),
                    'created_by'=> $r->user()->id,
                    'updated_by'=> $r->user()->id
                ]));
            }
        }

        foreach ($r->email as $key => $address) {
            if ($address != null) {
                $m->emails()->save(new Email([
                    'address'   => $address,
                    'type'      => $key,
                    'created_by'=> $r->user()->id,
                    'updated_by'=> $r->user()->id
                ]));
            }
        }

        return redirect()->route('directory.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $member = $member->load(['address', 'emails' => function ($q) {
            $q->orderBy('type', 'asc');
        }, 'phones' => function ($q) {
            $q->orderBy('type', 'asc');
        }, 'roles']);

        if (Auth::id() == $member->id or (Auth::user()->roles()->count() > 0 and Auth::user()->roles[0]->name == 'administrateur')) {
            return view('directory.admin.main')->with([
                'emails'            => $this->getEmailInfo($member),
                'm'                 => $member,
                'phones'            => $this->getPhoneInfo($member),
                'roles'             => $this->getRoles($member),
                'route'             => route('directory.update', $member->id),
                'street_type'       => $this->getAddressType($member),
                'submitButtonText'  => __('forms.edit_button')
            ]);
        }

        return redirect('error');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $r
     * @param App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, Member $member)
    {
        $m = $member;
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

        Address::where('member_id', $m->id)->update([
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

            if ($number != null) {
                if (! Phone::where('member_id', $m->id)->where('type', $type)->update([
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
            } else {
                Phone::where('member_id', $m->id)->where('type', $type)->delete();
            }
        }

        foreach ($r->email as $type => $address) {
            if ($address != null) {
                if (! Email::where('member_id', $m->id)->where('type', $type)->update([
                  'address'   => $address,
                  'type'      => $type,
                  'updated_by'=> $r->user()->id
                ])) {
                    $m->emails()->save(new Email([
                        'address'   => $address,
                        'type'      => $type,
                        'created_by'=> $r->user()->id,
                        'updated_by'=> $r->user()->id
                    ]));
                }
            } else {
                Email::where('member_id', $m->id)->where('type', $key)->delete();
            }
        }

        return redirect()->route('directory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        if ($member->id >= 4) { /* Making sure none of the default users are deleted */
            $member->address()->delete();
            $member->phones()->delete();
            $member->emails()->delete();
            $member->roles()->detach();
            $member->delete();
        }

        return redirect()->route('directory.index');
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
        }

        if ($member == null) {
            return $info;
        }

        foreach ($info as $key => $i) {
            foreach ($member->emails as $email) {
                if ($i['type'] == $email->type) {
                    $info[$key]['val'] = $email->address;
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
        }

        if ($member == null) {
            return $info;
        }

        foreach ($info as $key => $i) {
            foreach ($member->phones as $phone) {
                if (ucfirst($i['short']) == $phone->type) {
                    $info[$key]['number'] = $phone->number;
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
