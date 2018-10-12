<?php

/**
 * Directory Controller
 *
 * @author Robert Doucette <rice8204@gmail.com>
 */

namespace App\Http\Controllers;

use App\Address;
use App\Email;
use App\Phone;
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
        return view('directory.index')->withMembers(User::with(['address',
            'emails' => function ($q) {
                $q->orderBy('type', 'asc');
            },
            'phones' => function ($q) {
                $q->orderBy('type', 'asc');
            }
        ])->whereHas('roles', function ($q) {
            $q->where('name', 'membre');
        })->orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get());
    }

    /**
     * Display the specified user.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('directory.show')->withUser($user->load('address', 'emails', 'phones', 'roles'));
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
        return view('directory.admin.index');
    }

    /**
     * Store the newly created resource in storage.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user_info = array_filter($request->user);

        $address_info = array_filter($request->address);

        if ($request->user['address_id'] === null and ! empty($address_info)) {
            $user_info['address_id'] = Address::create($address_info)->id;
        }

        if (isset($user_info['password'])) {
            $user_info['password'] = Hash::make($request->user['password']);
        }

        $user = User::create($user_info);

        Role::find($request->roles)->each->assignTo($user);

        foreach ($request->telephone as $phone) {
            if ($phone['id'] === null and $phone['number'] !== null) {
                $phoneIds[] = Phone::firstOrCreate([
                    'number' => $phone['number'],
                    'type'   => $phone['type']
                ])->id;
            } else {
                $phoneIds[] = $phone['id'];
            }
        }

        $user->assign('phone', array_filter($phoneIds));

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

        return redirect($user->path());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $m = $user->load(['address', 'emails' => function ($q) {
            $q->orderBy('type', 'asc');
        }, 'phones' => function ($q) {
            $q->orderBy('type', 'asc');
        }, 'roles']);

        return view('directory.admin.index')->with([
            'm'                 => $m,
            'route'             => route('directory.update', $m->id),
            'editButtonText'    => __('forms.edit_button')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param \Illuminate\Http\Request $request
     * @param \App\User $User
     * @return \Illuminate\Http\RedirctResponse
     */
    public function update(Request $request, User $user)
    {
        $user_info = array_filter($request->user);

        $address_info = array_filter($request->address);

        if ($request->user['address_id'] === null) {
            if ($user->address_id !== null and empty($address_info)) {
                $user_info['address_id'] = null;
            } elseif (! empty($address_info)) {
                $user_info['address_id'] = Address::firstOrCreate($address_info)->id;
            }
        } elseif ((int) $request->user['address_id'] === $user->address_id) {
            $user->address->update($address_info);
        }

        if (isset($user_info['password'])) {
            $user_info['password'] = Hash::make($request->user['password']);
        }

        $user->update($user_info);

        if ($request->roles !== null) {
            foreach ($request->roles as $role) {
                $roles[$role] = ['created_by' => auth()->id(), 'updated_by' => auth()->id()];
            }

            $user->roles()->sync($roles);
        }

        $user_phones = array_pluck($user->phones->toArray(), 'type', 'id');

        foreach ($request->telephone as $key => $phone) {
            $phoneId = array_search($phone['type'], $user_phones);

            if ($phone['id'] === null) {
                if ($phone['number'] !== null and $phoneId === false) {
                    $user->assign('phone', Phone::create($phone)->id);
                } else {
                    $user->phones()->detach($phoneId);
                }
            } elseif ((int) $phone['id'] === $phoneId) {
                Phone::find($phone['id'])->update($phone);
            } else {
                $user->phones()->detach($phoneId);
                $user->assign('phone', $phone['id']);
            }
        }

        $user_emails = array_pluck($user->emails->toArray(), 'pivot.type', 'id');

        foreach ($request->email as $key => $email) {
            if ($email['id'] === null) {
                if ($email['address'] !== null) {
                    $email_id = Email::firstOrCreate(['address' => $email['address']])->id;

                    if (array_key_exists($email_id, $user_emails)) {
                        $user->emails()->wherePivot('type', $email['type'])->detach($email_id);
                    } else {
                        $user->assign('email', $email_id, ['type' => $email['type']]);
                    }
                }
            } elseif ((int) $email['id'] === array_search($email['type'], $user_emails)) {
                Email::find($email['id'])->update(['address' => $email['address']]);
            } else {
                $user->emails()
                    ->wherePivot('type', $email['type'])
                    ->detach(current(array_keys($user_emails, $email['type'])));

                $user->assign('email', $email['id'], ['type' => $email['type']]);
            }
        }

        return redirect($user->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param \App\User $user
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
}
