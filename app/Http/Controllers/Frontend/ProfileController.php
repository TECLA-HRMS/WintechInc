<?php
// app/Http/Controllers/Frontend/ProfileController.php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Education;
use App\Models\Experience;
use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ProfileController extends Controller
{
    private function updatePersonalInfo($user, $request)
    {
        $user->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'gender'     => $request->gender,
            'address'    => $request->address,
            'location'   => $request->location,
            'pincode'    => $request->pincode,
        ]);
        
        Log::info('Personal info updated for user: ' . $user->id);
    }

private function uploadProfilePicture($user, $file)
{
    try {

        // Inside public folder
        $destinationPath = public_path('profile_pictures');

        // Delete old file
        if ($user->profile_picture) {
            $oldPath = $destinationPath . '/' . $user->profile_picture;

            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        // Create folder if not exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Upload file
        $filename = 'profile_' . $user->id . '_' . time() . '.' .
                    $file->getClientOriginalExtension();

        $file->move($destinationPath, $filename);

        $user->update([
            'profile_picture' => $filename
        ]);

    } catch (\Exception $e) {
        Log::error($e->getMessage());
        throw $e;
    }
}

    private function updateExperience($user, $experienceData)
    {
        try {
            // Delete existing experience
            Experience::where('user_id', $user->id)->delete();
            Log::info('Deleted existing experience records for user: ' . $user->id);

            foreach ($experienceData as $index => $exp) {
                $currentlyWorking = isset($exp['currently_working']) && $exp['currently_working'] == 'on';
                
                $experience = Experience::create([
                    'user_id' => $user->id,
                    'job_title' => $exp['job_title'] ?? '',
                    'company' => $exp['company'] ?? '',
                    'employment_type' => $exp['employment_type'] ?? 'full_time',
                    'location' => $exp['location'] ?? '',
                    'currently_working' => $currentlyWorking,
                    'start_month' => $exp['start_month'] ?? 'january',
                    'start_year' => $exp['start_year'] ?? now()->year,
                    'end_month' => $currentlyWorking ? null : ($exp['end_month'] ?? null),
                    'end_year' => $currentlyWorking ? null : ($exp['end_year'] ?? null),
                ]);
                Log::info("Created experience record {$index} for user: " . $user->id, $experience->toArray());
            }
        } catch (\Exception $e) {
            Log::error('Experience update error: ' . $e->getMessage());
            throw $e;
        }
    }

    private function updateSkills($user, $skillsString)
    {
        try {
            Log::info('updateSkills called', ['user_id' => $user->id, 'skills_string' => $skillsString]);
            
            UserSkill::where('user_id', $user->id)->delete();
            Log::info('Deleted existing skills for user: ' . $user->id);

            if (!empty($skillsString)) {
                $skills = explode(',', $skillsString);
                Log::info('Skills array after explode', ['skills' => $skills]);
                
                foreach ($skills as $skill) {
                    $trimmedSkill = trim($skill);
                    if (!empty($trimmedSkill)) {
                        $created = UserSkill::create([
                            'user_id' => $user->id,
                            'skill_name' => $trimmedSkill
                        ]);
                        Log::info("Created skill", ['skill' => $trimmedSkill, 'user_id' => $user->id, 'id' => $created->id]);
                    }
                }
            } else {
                Log::info('Skills string is empty for user: ' . $user->id);
            }
        } catch (\Exception $e) {
            Log::error('Skills update error', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            throw $e;
        }
    }

    private function uploadResume($user, $file)
    {
        try {
            if (!$file) {
                throw new \Exception('No file provided');
            }

            // Delete old resume if exists
            if ($user->resume && file_exists(public_path('resume/' . $user->resume))) {
                unlink(public_path('resume/' . $user->resume));
            }

            $resumePath = $_SERVER['DOCUMENT_ROOT'] . '/resume/' . $user->resume;

if ($user->resume && file_exists($resumePath)) {
    unlink($resumePath);
}

            // Store new resume directly in public/resume
            $filename = 'resume_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
         $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/resume';

if (!file_exists($destinationPath)) {
    mkdir($destinationPath, 0777, true);
}

$file->move($destinationPath, $filename);
            $user->update(['resume' => $filename]);

            Log::info('Resume uploaded for user: ' . $user->id . ' - File: ' . $filename);
        } catch (\Exception $e) {
            Log::error('Resume upload error: ' . $e->getMessage());
            throw $e;
        }
    }

    private function calculateSectionProgress($user)
    {
        $progress = [
            'personal' => 0,
            'education' => 0,
            'experience' => 0,
            'skills' => 0
        ];

        try {
            // Personal Info Progress
            $personalFields = ['first_name', 'last_name', 'email', 'phone', 'gender', 'address', 'location', 'pincode'];
            $filledPersonal = 0;
            foreach ($personalFields as $field) {
                if (!empty($user->$field)) $filledPersonal++;
            }
            $progress['personal'] = ($filledPersonal / count($personalFields)) * 100;

            // Education Progress
            $progress['education'] = ($user->educations ? $user->educations->count() : 0) > 0 ? 100 : 0;

            // Experience Progress
            $progress['experience'] = ($user->experiences ? $user->experiences->count() : 0) > 0 ? 100 : 0;

            // Skills Progress
            $progress['skills'] = min((($user->skills ? $user->skills->count() : 0) / 3) * 100, 100);
        } catch (\Exception $e) {
            Log::error('Progress calculation error: ' . $e->getMessage());
        }

        return $progress;
    }

    private function calculateProfileCompletion($user)
    {
        $totalFields = 0;
        $completedFields = 0;

        try {
            // Personal Information (40%)
            $personalFields = ['first_name', 'last_name', 'email', 'phone', 'gender', 'address', 'location', 'pincode', 'resume'];
            foreach ($personalFields as $field) {
                $totalFields++;
                if (!empty($user->$field)) $completedFields++;
            }

            // Education (20%)
            $totalFields += 2;
            if (($user->educations ? $user->educations->count() : 0) > 0) $completedFields += 2;

            // Experience (20%)
            $totalFields += 2;
            if (($user->experiences ? $user->experiences->count() : 0) > 0) $completedFields += 2;

            // Skills (20%)
            $totalFields += 2;
            if (($user->skills ? $user->skills->count() : 0) >= 3) $completedFields += 2;
        } catch (\Exception $e) {
            // If relationships don't exist, use basic calculation
            $personalFields = ['first_name', 'last_name', 'email', 'phone'];
            foreach ($personalFields as $field) {
                $totalFields++;
                if (!empty($user->$field)) $completedFields++;
            }
        }

        return $totalFields > 0 ? ($completedFields / $totalFields) * 100 : 0;
    }

    public function deleteResume()
    {
        $user = Auth::user();
        
        if ($user->resume) {
            Storage::delete('public/resumes/' . $user->resume);
            $user->update(['resume' => null]);
            
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function removeProfilePicture()
    {
        try {
            $user = Auth::user();
            
            if ($user->profile_picture) {
                // Delete file from storage
                if (file_exists(public_path('profile_pictures/' . $user->profile_picture))) {
                    unlink(public_path('profile_pictures/' . $user->profile_picture));
                }
                
                // Update database
                $user->update(['profile_picture' => null]);
                
                Log::info('Profile picture removed for user: ' . $user->id);
                return response()->json(['success' => true]);
            }

            return response()->json(['success' => false, 'message' => 'No profile picture to remove']);
        } catch (\Exception $e) {
            Log::error('Profile picture removal error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function show()
    {
        try {
            $user = Auth::user();
            
            // Check if tables exist before loading relationships
            if (Schema::hasTable('educations')) {
                $user->load(['educations']);
            }
            if (Schema::hasTable('experiences')) {
                $user->load(['experiences']);
            }
            if (Schema::hasTable('user_skills')) {
                $user->load(['skills']);
            }
            
            // Calculate progress percentages for each section
            $progress = $this->calculateSectionProgress($user);

            return view('site.profile.index', compact('user', 'progress'));
            
        } catch (\Exception $e) {
            // If tables don't exist yet, use empty data
            $user = Auth::user();
            $progress = [
                'personal' => 0,
                'education' => 0,
                'experience' => 0,
                'skills' => 0
            ];
            
            return view('site.profile.index', compact('user', 'progress'));
        }
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        Log::info('Profile Update Request Data:', $request->all());

        try {
            // Personal Information - Always process if first_name is present
            if ($request->has('first_name')) {
                $this->updatePersonalInfo($user, $request);
            }

            // Education - Only process if table exists
            if ($request->has('education') && Schema::hasTable('educations')) {
                Log::info('Education Data:', $request->education);
                $this->updateEducation($user, $request->education);
            } else {
                Log::info('Education table not found or no education data');
            }

            // Experience - Only process if table exists
            if ($request->has('experience') && Schema::hasTable('experiences')) {
                Log::info('Experience Data:', $request->experience);
                $this->updateExperience($user, $request->experience);
            } else {
                Log::info('Experience table not found or no experience data');
            }

            Log::info('Skills save check:', [
                'exists_in_request' => $request->exists('skills'),
                'skills_value' => $request->input('skills'),
                'has_user_skills_table' => Schema::hasTable('user_skills')
            ]);

            // Skills - Only process if table exists and skills field is present in request
            if ($request->exists('skills') && Schema::hasTable('user_skills')) {
                $this->updateSkills($user, $request->input('skills', ''));
            } else {
                Log::warning('Skills not updated. Condition failed:', [
                    'exists_in_request' => $request->exists('skills'),
                    'has_user_skills_table' => Schema::hasTable('user_skills')
                ]);
            }

            // Profile Picture Upload
            if ($request->hasFile('profile_picture')) {
                $this->uploadProfilePicture($user, $request->file('profile_picture'));
            }

            // Resume Upload
            if ($request->hasFile('resume')) {
                $this->uploadResume($user, $request->file('resume'));
            }

            // Update profile completion and timestamp
            $user->profile_completion = $this->calculateProfileCompletion($user);
            $user->profile_updated_at = now();
            $user->save();

            Log::info('Profile updated successfully for user: ' . $user->id);

            return redirect()->back()->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating profile: ' . $e->getMessage());
        }
    }

    private function updateEducation($user, $educationData)
    {
        try {
            // Delete existing education
            Education::where('user_id', $user->id)->delete();
            Log::info('Deleted existing education records for user: ' . $user->id);

            foreach ($educationData as $index => $edu) {
                $education = Education::create([
                    'user_id' => $user->id,
                    'degree' => $edu['degree'] ?? '',
                    'institution' => $edu['institution'] ?? '',
                    'subject' => $edu['subject'] ?? '',
                    'gpa' => $edu['gpa'] ?? null,
                    'location' => $edu['location'] ?? '',
                    'year' => $edu['year'] ?? now()->year,
                ]);
                Log::info("Created education record {$index} for user: " . $user->id, $education->toArray());
            }
        } catch (\Exception $e) {
            Log::error('Education update error: ' . $e->getMessage());
            throw $e;
        }
    }
}