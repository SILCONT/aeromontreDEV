<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Plane;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_plane');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Plane $plane): bool
    {
        return $user->can('view_plane');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_plane');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Plane $plane): bool
    {
        return $user->can('update_plane');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Plane $plane): bool
    {
        return $user->can('delete_plane');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_plane');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Plane $plane): bool
    {
        return $user->can('force_delete_plane');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_plane');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Plane $plane): bool
    {
        return $user->can('restore_plane');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_plane');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Plane $plane): bool
    {
        return $user->can('replicate_plane');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_plane');
    }
}
