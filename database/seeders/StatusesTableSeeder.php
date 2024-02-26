<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    public function run(): void
    {
        Status::create([
            'name' => 'implement'
        ]);
    }
}
