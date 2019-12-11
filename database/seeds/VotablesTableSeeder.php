<?php

use App\Question;
use App\User;
use Illuminate\Database\Seeder;

class VotablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        App\User::all()->each(function (User $user) {
            $questions = Question::all()->random(
                rand(1, Question::all()->count())
            );

            $votes = [1, -1];

            foreach ($questions as $question) {
                $user->voteQuestion($question, $votes[array_rand($votes)]);
            }
        });
    }
}
