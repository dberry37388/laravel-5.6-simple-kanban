<?php

namespace App\Policies;

use App\User;
use App\Lane;
use Illuminate\Auth\Access\HandlesAuthorization;

class LanePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the lane.
     *
     * @param  \App\User  $user
     * @param  \App\Lane  $lane
     * @return mixed
     */
    public function view(User $user, Lane $lane)
    {
        //
    }

    /**
     * Determine whether the user can create lanes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the lane.
     *
     * @param  \App\User  $user
     * @param  \App\Lane  $lane
     * @return mixed
     */
    public function update(User $user, Lane $lane)
    {
        return $user->id == $lane->user_id;
    }

    /**
     * Determine whether the user can delete the lane.
     *
     * @param  \App\User  $user
     * @param  \App\Lane  $lane
     * @return mixed
     */
    public function delete(User $user, Lane $lane)
    {
        return $user->id == $lane->user_id;
    }
}
