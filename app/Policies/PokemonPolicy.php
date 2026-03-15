<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Pokemon;
use App\Models\User;

class PokemonPolicy
{
    /**
     * Administrators have full access to all actions, so we can use the 
     * `before` method to grant them permissions for everything. 
     * This way, we don't need to repeat the admin check in each individual method.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        return null; 
    }

    /**
     * All authenticated users can view the list and details.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * All authenticated users can view the list and details.
     */
    public function view(User $user, Pokemon $pokemon): bool
    {
        return true;
    }
    
    /**
     * Before method already grants Admins full access, so we only need to check for Editors here.
     */
    public function import(User $user): bool
    {
        return $user->role === UserRole::EDITOR;
    }

    /**
     * Before method already grants Admins full access, so we only need to check for Editors here.
     */
    public function delete(User $user, Pokemon $pokemon): bool
    {
        return false;
    }

    /**
     * Before method already grants Admins full access, so we only need to check for Editors here.
     */
    public function favorite(User $user, Pokemon $pokemon): bool
    {
        return $user->role === UserRole::EDITOR;
    }
}
