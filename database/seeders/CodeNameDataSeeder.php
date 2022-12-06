<?php

namespace Database\Seeders;

use App\Models\CodeName;
use Illuminate\Database\Seeder;

class CodeNameDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        CodeName::truncate();

        $data = [
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
            ["name" => ""],
        ];

        collect($data)->each(function ($codeName) {
            CodeName::create($codeName);
        });
    }
}
