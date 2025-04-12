<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Enums\OrganizationStatus;
use App\Models\Position\Position;
use Illuminate\Support\Facades\DB;
use App\Models\Organization\Organization;
use App\Models\OrganizationEmployee\OrganizationEmployee;
use App\Models\Permission\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organizations')->delete();
        DB::table('organization_employees')->delete();

        $faker = Factory::create();
        $positions = Position::all()->pluck('id', 'id');
        $permissions = Permission::all()->pluck('id', 'id');

        $organization =   Organization::create([
            'name' => $faker->name,
            'email' => $faker->safeEmail,
            'phone' => $faker->phoneNumber,
            'address' => $faker->countryCode,
            'status' => OrganizationStatus::ACTIVE->value
        ]);
        OrganizationEmployee::create([
            // 'position_id' => $positions ? $positions->random() : null,
            // 'permission_id' => $permissions ? $permissions->random() : null,
            'organization_id' => $organization->id,
            'name' => $faker->name,
            'email' => $faker->safeEmail,
            'password' => hashUserPassword('password'),
            'phone' => $faker->phoneNumber,
            'api_token' => hashApiToken(),
            'date_added' => now(),
        ]);
    }
}
