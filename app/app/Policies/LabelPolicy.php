<?php

namespace App\Policies;

use App\Label;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class LabelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Label  $label
     * @return mixed
     */
    public function view(User $user, Label $label)
    {
        return $user->id === $label->user_id ? Response::allow() : Response::deny('Access denied');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Label  $label
     * @return mixed
     */
    public function update(User $user, Label $label)
    {
        return $user->id === $label->user_id ? Response::allow() : Response::deny('Access denied');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Label  $label
     * @return mixed
     */
    public function delete(User $user, Label $label)
    {
        return $user->id === $label->user_id ? Response::allow() : Response::deny('Access denied');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Label  $label
     * @return mixed
     */
    public function restore(User $user, Label $label)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Label  $label
     * @return mixed
     */
    public function forceDelete(User $user, Label $label)
    {
        //
    }
}
