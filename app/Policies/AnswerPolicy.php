<?php

namespace App\Policies;

use App\Answer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can update the answer.
     *
     * @param User $user
     * @param Answer $answer
     * @return mixed
     */
    public function update(User $user, Answer $answer)
    {
        return $user->id === (int)$answer->user_id;
    }

    /**
     * Determine whether the user can delete the answer.
     *
     * @param User $user
     * @param Answer $answer
     * @return mixed
     */
    public function delete(User $user, Answer $answer)
    {
        return $user->id === (int)$answer->user_id;
    }
}
