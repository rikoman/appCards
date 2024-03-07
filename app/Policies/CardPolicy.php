<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use App\Models\card;
use Illuminate\Auth\Access\Response;

class CardPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, card $card): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user,Project $project): bool
    {
        return $user->id ===  $project->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, card $card): bool
    {
        return $user->id === $card->category->project->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, card $card): bool
    {
        return $this->update($user,$card);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, card $card): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, card $card): bool
    {
        //
    }
}
