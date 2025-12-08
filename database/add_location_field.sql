-- Add location field to inquiries table
-- Run this after the main schema.sql

USE u112004868_gurus;

-- Add location field if it doesn't exist
ALTER TABLE inquiries 
ADD COLUMN IF NOT EXISTS location VARCHAR(100) AFTER phone;

-- Add father_name and father_mobile if they don't exist
ALTER TABLE inquiries 
ADD COLUMN IF NOT EXISTS father_name VARCHAR(100) AFTER phone;

ALTER TABLE inquiries 
ADD COLUMN IF NOT EXISTS father_mobile VARCHAR(20) AFTER father_name;
