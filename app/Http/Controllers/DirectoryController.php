<?php

/**
 * Directory Controller
 *
 * @author Robert Doucette <rice8204@gmail.com>
 */

namespace App\Http\Controllers;

use App\Address;
use App\Email;
use App\EmailUser;
use App\Phone;
use App\PhoneUser;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DirectoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the users.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('directory.index')->withMembers(User::with([
            'address' => function ($q) {
                $q->select('id', 'street_info', 'street_complement', 'zip', 'city');
            },
            'emails' => function ($q) {
                $q->select('emails.id', 'address');
            },
            'phones' => function ($q) {
                $q->select('phones.id', 'number', 'type');
            }
        ])->whereHas('roles', function ($q) {
            $q->select('roles.id', 'name')->where('name', 'membre');
        })->orderBy('last_name')->orderBy('first_name')
        ->get(['users.id', 'first_name', 'last_name', 'address_id']));
    }

    /**
     * Display the specified user.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for creating a new user.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        return view('directory.admin.index')->with([
            'addresses' => Address::get(['id', 'street_info', 'street_complement', 'zip', 'city']),
            'emails'    => Email::get(['id', 'address']),
            'phones'    => $this->getPhonesArray(),
            'roles'     => Role::get(['id', 'name'])
        ]);
    }

    /**
     * Store the newly created resource in storage.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user_info = array_filter($request->user);

        $address_info = array_filter($request->address);

        if (isset($user_info['password'])) {
            $user_info['password'] = Hash::make($request->user['password']);
        }

        $user = User::create($user_info);

        if ($request->address['id'] === null and ! empty($address_info)) {
            $user->address_id = Address::create($address_info)->id;
        } else {
            $user->address_id = $request->address['id'];
        }

        $user->save();

        Role::find($request->roles)->each->assignTo($user->id);

        foreach ($request->telephone as $key =>$phone) {
            if ($phone['id'] === null and $phone['number'] !== null) {
                $phoneIds[] = Phone::firstOrCreate([
                    'number' => $phone['number'],
                    'type'   => $key
                ])->id;
            } else {
                $phoneIds[] = $phone['id'];
            }
        }

        $phoneIds = array_filter($phoneIds);

        if (! empty($phoneIds)) {
            $user->assign('phone', $phoneIds);
        }

        foreach ($request->email as $email) {
            if ($email['id'] === null and $email['address'] !== null) {
                $emailId = Email::create(['address' => $email['address']])->id;
            } else {
                $emailId = (int) $email['id'];
            }

            if ($emailId !== 0) {
                $user->assign('email', $emailId, ['type' => $email['type']]);
            }
        }

        return redirect()->route('directory.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $m = $user->load(['address' => function ($q) {
            $q->select('id', 'street_info', 'street_complement', 'zip', 'city');
        }, 'emails' => function ($q) {
            $q->select('emails.id', 'address', 'type');
        }, 'phones' => function ($q) {
            $q->select('phones.id', 'number', 'type');
        }, 'roles' => function ($q) {
            $q->select('roles.id', 'name');
        }]);

        return view('directory.admin.index')->with([
            'addresses'      => Address::get([
                'id', 'street_info', 'street_complement', 'zip', 'city'
            ]),
            'emails'        => Email::get(['id', 'address']),
            'm'             => $m,
            'phones'        => $this->getPhonesArray(),
            'roles'         => Role::get(['id', 'name']),
            'route'         => route('directory.update', $m->id),
            'editButtonText'=> __('forms.edit_button')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $User
     * @return \Illuminate\Http\RedirctResponse
     */
    public function update(Request $request, User $user)
    {
        $user_info = array_filter($request->user);

        $address_info = array_filter($request->address);

        if ($request->address['id'] === null) {
            if ($user->address_id !== null and empty($address_info)) {
                $user->address_id = null;
            } elseif (! empty($address_info)) {
                $user->address_id = Address::firstOrCreate($address_info)->id;
            }

            $user->save();
        } elseif ((int) $request->address['id'] === $user->address_id) {
            $user->address->update($address_info);
        } elseif ($request->address['id'] !== null) {
            $user->address_id = $request->address['id'];
            $user->save();
        }

        if (isset($user_info['password'])) {
            $user_info['password'] = Hash::make($request->user['password']);
        }

        $user->update($user_info);

        if ($request->roles !== null) {
            foreach ($request->roles as $role) {
                $user->assign('role', $role);
            }
        }

        $user_phones = array_pluck($user->phones->toArray(), 'type', 'id');

        foreach ($request->telephone as $key => $phone) {
            $oldPhoneId = array_search($key, $user_phones);

            if ($phone['id'] === null) {
                $newPhoneId = false;

                if ($phone['number'] !== null) {
                    $newPhoneId = Phone::firstOrCreate([
                        'number'=> $phone['number'],
                        'type'  => $key
                    ])->id;
                }

                if ($oldPhoneId === false and $newPhoneId !== false) {
                    $user->assign('phone', $newPhoneId);
                } elseif ($oldPhoneId === $newPhoneId) {
                    $user->phones()->detach($oldPhoneId);
                } elseif ($newPhoneId !== false) {
                    $temp = PhoneUser::where('user_id', $user->id)->where('phone_id', $oldPhoneId)->first();
                    $temp->phone_id = $newPhoneId;
                    $temp->save();
                }
            } elseif ((int) $phone['id'] === $oldPhoneId) {
                if ($phone['number'] !== null) {
                    Phone::find($phone['id'])->update($phone);
                }
            } else {
                if ($oldPhoneId === false) {
                    $user->assign('phone', $phone['id']);
                } else {
                    $temp = PhoneUser::where('user_id', $user->id)->where('phone_id', $oldPhoneId)->first();
                    $temp->phone_id = $phone['id'];
                    $temp->save();
                }
            }
        }

        $user_emails = array_pluck($user->emails->toArray(), 'pivot.type', 'id');

        foreach ($request->email as $email) {
            $temp = EmailUser::where('user_id', $user->id)->where('type', $email['type'])->first();

            if ($email['id'] === null) {
                if ($email['address'] !== null) {
                    $email_id = Email::firstOrCreate(['address' => $email['address']])->id;

                    if (array_key_exists($email_id, $user_emails)) {
                        $temp->delete();
                    } elseif (in_array($email['type'], $user_emails)) {
                        $temp->email_id = $email_id;
                        $temp->save();
                    } else {
                        $user->assign('email', $email_id, ['type' => $email['type']]);
                    }
                }
            } elseif ((int) $email['id'] === array_search($email['type'], $user_emails)) {
                Email::find($email['id'])->update(['address' => $email['address']]);
            } else {
                if (in_array($email['type'], $user_emails)) {
                    $temp->email_id = $email['id'];
                    $temp->save();
                } else {
                    $user->assign('email', $email['id'], ['type' => $email['type']]);
                }
            }
        }

        return redirect()->route('directory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        // if ($member->id >= 4 and Gate::allows('update-member', $member->id)) { /* Making sure none of the default users are deleted */
        //     $member->address()->delete();
        //     $member->phones()->delete();
        //     $member->emails()->delete();
        //     $member->roles()->detach();
        //     $member->delete();
        // }

        return redirect()->route('directory.index');
    }

    public function getPhonesArray()
    {
        $phones = ['fixe' => [], 'portable' => []];

        foreach (Phone::orderBy('number')->get(['id', 'number', 'type']) as $phone) {
            $phones[$phone->type][$phone->id] = $phone->number;
        }

        return $phones;
    }
}
