<?php

namespace Database\Seeders;

use App\Models\Position\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Faker\Factory;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $data = [
            'title_ar' => [$faker->name()],
            'title_en' => [$faker->name()],
        ];
        DB::table('positions')->delete();
        for ($i = 0; $i < 10; $i++) {
            foreach ($data['title_ar'] as $index => $titleAr) {
                $serviceType = [];
                foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                    $serviceType[$localeCode] = [
                        'title' => $localeCode === 'ar' ? $titleAr : $data['title_en'][$index],
                    ];
                }
                Position::create($serviceType);
            }
        }
    }
}
