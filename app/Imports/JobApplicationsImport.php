<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class JobApplicationsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        try {
            // Find job_id by job_title
            $jobTitle = $row['job_title'] ?? null;
            $job = DB::table('managejobs')->where('job_title', 'like', "%{$jobTitle}%")->first();
            
            $jobId = $job ? $job->id : null;

            if (!$jobId) {
                // If no matching job, we could skip or assign a default. We'll skip for now.
                Log::warning('Bulk Import: Skipped row due to missing or mismatched job title.', ['row' => $row]);
                return null;
            }

            // Create application
            DB::table('job_applications')->insert([
                'user_id' => null, // Optional if it's a guest or imported user
                'job_id' => $jobId,
                'full_name' => $row['applicant_name'] ?? 'Unknown',
                'email' => $row['email'] ?? null,
                'phone' => $row['phone'] ?? null,
                'location' => $row['location'] ?? null,
                'cover_letter' => $row['cover_letter'] ?? null,
                'status' => in_array(strtolower($row['status'] ?? ''), ['pending', 'reviewed', 'shortlisted', 'selected', 'rejected']) 
                                ? strtolower($row['status']) 
                                : 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        } catch (\Exception $e) {
            Log::error('Bulk Import Error: ' . $e->getMessage(), ['row' => $row]);
        }
        
        return null;
    }
}
