<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->id = Uuid::uuid4()->toString();
        $user->first_name = 'Bambang Firman';
        $user->last_name = 'Fatoni';
        $user->username = '10122027';
        $user->password = Hash::make('rahasia');
        $user->email = 'bambang.10122027@mahasiswa.unikom.ac.id';
        $user->role = 'admin';
        $user->save();
    }
}
