<?php
use App\Permission;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Role = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'User has access to all system functionality'
            ],
            [
                'name' => 'shop-keeper',
                'display_name' => 'Shop Keeper',
                'description' => 'User can create create data in the system'
            ]
        ];

        foreach ($Role as $key => $value) {
            Role::create($value);
        }
    }
}
