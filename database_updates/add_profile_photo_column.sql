-- Add profile_photo column to job_applications table
-- Run this SQL query in your database

ALTER TABLE `job_applications` 
ADD COLUMN `profile_photo` VARCHAR(255) NULL AFTER `job_id`;

-- Verify the column was added
DESCRIBE job_applications;
