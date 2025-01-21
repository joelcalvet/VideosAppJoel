<?php

namespace App\Helpers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserHelper
{
    public static function createDefaultUser()
    {
        if (!User::where('email', config('users.default.email'))->exists()) {
            $user = User::create([
                'name' => config('users.default.name'),
                'email' => config('users.default.email'),
                'password' => Hash::make(config('users.default.password')),
            ]);

            $team = Team::forceCreate([
                'name' => $user->name.' Team',
                'user_id' => $user->id,
                'personal_team' => true,
            ]);

            $user->current_team_id = $team->id;
            $user->save();

            return $user;
        }
    }

    public static function createDefaultTeacher()
    {
        if (!User::where('email', config('users.teacher.email'))->exists()) {
            $teacher = User::create([
                'name' => config('users.teacher.name'),
                'email' => config('users.teacher.email'),
                'password' => Hash::make(config('users.teacher.password')),
            ]);

            $team = Team::forceCreate([
                'name' => $teacher->name.' Team',
                'user_id' => $teacher->id,
                'personal_team' => true,
            ]);

            $teacher->current_team_id = $team->id;
            $teacher->save();

            return $teacher;
        }
    }
}
