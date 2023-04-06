<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;

class branchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $data = [
                [
                    'name' => 'branch 1',
                ],
                [
                    'name' => 'branch 2',
                ],
                [
                    'name' => 'branch 3',
                ],
                [
                    'name' => 'branch 4',
                ],
                [
                    'name' => 'branch 5',
                ],
                [
                    'name' => 'branch 6',
                ],
                [
                    'name' => 'branch 7',
                ],
                [
                    'name' => 'branch 8',
                ],
                [
                    'name' => 'branch 9',
                ],
                [
                    'name' => 'branch 10',
                ],
            ];
            Branch::insert($data);
    }
}
