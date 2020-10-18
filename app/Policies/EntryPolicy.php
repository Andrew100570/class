<?php

namespace App\Policies;

use App\Entry;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user,Entry $entry){
            if($user->role === 1){
                    return true;
            }else{
                if($user->id == $entry->user_id){
                    return true;
                }
                return false;
            }
    }
}
