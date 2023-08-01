<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic Plan',
                'slug' => Str::slug('Basic Plan'),
                'stripe_plane' => 'price_1NYwrBCMzwK43ih2bfYTrFBP',
                'amount' => 100,
                'description' => 'Community Access Per Task',
            ],
            [
                'name' => 'Professional Plan',
                'slug' => Str::slug('Professional Plan'),
                'stripe_plane' => 'price_1NYx1bCMzwK43ih2C4K8jpvg',
                'amount' => 1000,
                'description' => 'Community Access with many times',
            ]
            ];

            foreach ($plans as $key => $plan) {
                Plan::create($plan);
            }
    }
}
