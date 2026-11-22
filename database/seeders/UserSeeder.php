<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Delete existing to avoid duplicates (or use updateOrCreate)
        User::where('email', 'pathseekershere@gmail.com')->delete();

        // Admin (already exists, but recreate)
        User::create([
            'email' => 'pathseekershere@gmail.com',
            'password' => Hash::make('Admin@123'),  // Password: Admin@123
            'name' => 'Admin',
            'role' => 'admin',
            'status' => 'approved',
            'education' => 'High School Diploma',
            'skills' => json_encode(['communication', 'teamwork']),
            'interests' => json_encode(['technology', 'design']),
        ]);

        // Student
        User::create([
            'email' => 'abdullahmaaz128@gmail.com',
            'password' => Hash::make('Student@123'),  // Password: Student@123
            'name' => 'John Student',
            'role' => 'student',
            'status' => 'pending',  // Needs approval
            'education' => 'High School',
            'skills' => json_encode(['math', 'science']),
            'interests' => json_encode(['engineering']),
        ]);

        // Graduate
        User::create([
            'email' => 'awarenessindeed@gmail.com',
            'password' => Hash::make('Graduate@123'),  // Password: Graduate@123
            'name' => 'Jane Graduate',
            'role' => 'graduate',
            'status' => 'approved',
            'education' => "Bachelor's Degree",
            'skills' => json_encode(['programming', 'project management']),
            'interests' => json_encode(['software development']),
            'work_experience' => 'Internship at Tech Co.',
        ]);

        // Professional
        User::create([
            'email' => 'collabwithmaaz@gmail.com',
            'password' => Hash::make('Pro@123'),  // Password: Pro@123
            'name' => 'Mike Professional',
            'role' => 'professional',
            'status' => 'approved',
            'education' => "Master's Degree",
            'skills' => json_encode(['leadership', 'data analysis']),
            'interests' => json_encode(['business consulting']),
            'work_experience' => '5 years in IT Management',
        ]);
    }
}