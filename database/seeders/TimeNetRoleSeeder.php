<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TimeNetRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

        if(!Role::where('name', '=', 'admin')->first()) {
             Role::create(['name' => 'admin']);
        }

        if(!Role::where('name', '=', 'moderator')->first()) {
            Role::create(['name' => 'moderator']);
        }

    }
}
