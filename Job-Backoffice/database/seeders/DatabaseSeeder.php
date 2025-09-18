<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobApplication;
use App\Models\JobVacany;
use App\Models\Resume;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\JobCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        //* seed the root Admin
        user::firstOrCreate([
            'email' => 'admin@admin.com',
        ],[
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin' ,
            'email_verified_at' => now(),
        ]);

        //* seed data to test with
        $jobData = json_decode(file_get_contents(database_path('Data/job_data.json')), true);
        $jobApplications = json_decode(file_get_contents(database_path('Data/job_applications.json')), true);
        //* create job categories
        foreach($jobData['jobCategories'] as $jobCategory) {
            JobCategory::firstOrCreate([
                'name' => $jobCategory
            ]);
        }

        //* create job categories
        foreach($jobData['companies'] as $company) {
            //* create company owner
            $companyOwner = User::firstOrCreate([
                'email' => fake()->unique()->safeEmail(),
            ],[
                'name' => fake()->name(),
                'password' => Hash::make('12345678'),
                'role'=> 'company-owner' ,
                'email_verified_at' => now(),
            ]);

            Company::firstOrCreate([
                'name' => $company['name'],
            ],[
                'address' => $company['address'],
                'industry' => $company['industry'],
                'website' => $company['website'],
                'ownerId' => $companyOwner->id
            ]);
        }

        //* create job vacancies
        foreach($jobData['jobVacancies'] as $jobVacancy) {
            //* get the related company
            $company = Company::where('name', $jobVacancy['company'])->firstOrFail();

            //* get the related job category
            $jobCategory = JobCategory::where('name', $jobVacancy['category'])->firstOrFail();

            JobVacany::firstOrCreate([
                'title' => $jobVacancy['title'],
                'companyId' => $company->id,
            ],[
                'description' => $jobVacancy['description'],
                'location' => $jobVacancy['location'],
                'type' => $jobVacancy['type'],
                'salary' => $jobVacancy['salary'],
                'categoryId' => $jobCategory->id,
            ]);
        }

        //* create job applications
        foreach($jobApplications['jobApplications'] as $jobApplication) {
            //* get random job vacancy
            $jobVacancy = JobVacany::inRandomOrder()->first();

            //* create job seeker
            $jobSeeker = User::firstOrCreate([
                'email' => fake()->unique()->safeEmail(),
            ],[
                'name' => fake()->name(),
                'password' => Hash::make('12345678'),
                'role'=> 'job-seeker' ,
                'email_verified_at' => now(),
            ]);
            //* create resume
            $resume = Resume::create([
                'userId' => $jobSeeker->id,
                'filename' => $jobApplication['resume']['filename'],
                'fileUri' => $jobApplication['resume']['fileUri'],
                'contactDetails' => $jobApplication['resume']['contactDetails'],
                'summary' => $jobApplication['resume']['summary'],
                'skills' => $jobApplication['resume']['skills'],
                'experience' => $jobApplication['resume']['experience'],
                'education' => $jobApplication['resume']['education'],
            ]);

            //* create job application
            JobApplication::create([
                'jobVacancyId' => $jobVacancy->id,
                'userId' => $jobSeeker->id,
                'resumeId' => $resume->id,
                'status' => $jobApplication['status'],
                'aiGeneratedScore' => $jobApplication['aiGeneratedScore'],
                'aiGeneratedFeedback' => $jobApplication['aiGeneratedFeedback'],
            ]);
        }

    }
}
