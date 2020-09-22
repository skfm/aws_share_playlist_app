<?php

namespace App\Policies;

use App\StockFolder;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StockFolderPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\StockFolder  $stockFolder
     * @return mixed
     */
    public function view(User $user, StockFolder $stockFolder)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\StockFolder  $stockFolder
     * @return mixed
     */
    public function update(User $user, StockFolder $stockFolder)
    {
        return $user->id === $stockFolder->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\StockFolder  $stockFolder
     * @return mixed
     */
    public function delete(User $user, StockFolder $stockFolder)
    {
        return $user->id === $stockFolder->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\StockFolder  $stockFolder
     * @return mixed
     */
    public function restore(User $user, StockFolder $stockFolder)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\StockFolder  $stockFolder
     * @return mixed
     */
    public function forceDelete(User $user, StockFolder $stockFolder)
    {
        //
    }
}
