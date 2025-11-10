<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Only allow the user who created this client to update it.
     */
    public function update(User $authUser, User $client): bool
    {
        // Allow if the logged-in user created this client
        return $authUser->id === $client->created_by;
    }

    /**
     * Optional: allow delete as well.
     */
    public function delete(User $authUser, User $client): bool
    {
        return $authUser->id === $client->created_by;
    }
}
