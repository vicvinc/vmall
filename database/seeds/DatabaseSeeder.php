<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Category;

class DatabaseSeeder extends Seeder {

    public function run() {
        $this->call('UserSeeder');
        $this->call('CategorySeeder');

        $this->command->info('user category seeded!');
    }

}

class UserSeeder extends Seeder {

    public function run() {
        User::create([
            'uid' => Uuid::generate(),
            'name' => 'mallAdmin',
            'email' => 'admin@vmall.com',
            'password' => '',
            'remember_token' => 'YP5et7FvH0GQCu81wOAAjpAbt2NhjxiGNtmWrApTR3KcZBI8wsLnpbGkOV1R',
        ]);
    }

}

class CategorySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Category::create([
            'uid' => Uuid::generate(),
            'title' => '全部',
            'thumbnail' => '/uploads/category/default.png',
            'sequence' => 0,
            'type' => 'first_cate',
            'parent_uid' => 0,
        ]);
    }
}
