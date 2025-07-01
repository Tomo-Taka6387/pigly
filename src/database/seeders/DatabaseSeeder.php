<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'テストユーザー',
                'password' => Hash::make('password'),
            ]
        );
        for ($i = 0; $i < 35; $i++) {
            WeightLog::factory()->create([
                'user_id' => $user->id,
                'date' => Carbon::today()->subDays(34 - $i),
            ]);
        }

        WeightTarget::factory()->create([
            'user_id' => $user->id,
        ]);
    }
}
