<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        // Insert into careers table
        DB::table('careers')->insert([
            ['title' => 'Software Engineer', 'domain' => 'Technology', 'salary' => 85000, 'description' => 'Develop software applications.', 'requirements' => '{"skills": ["programming", "problem-solving"]}', 'demand_level' => 'high', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Data Analyst', 'domain' => 'Data Science', 'salary' => 70000, 'description' => 'Analyze data trends.', 'requirements' => '{"skills": ["data analysis", "statistics"]}', 'demand_level' => 'medium', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Network Administrator', 'domain' => 'IT', 'salary' => 65000, 'description' => 'Manage network infrastructure.', 'requirements' => '{"skills": ["networking", "security"]}', 'demand_level' => 'medium', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Graphic Designer', 'domain' => 'Design', 'salary' => 55000, 'description' => 'Create visual content.', 'requirements' => '{"skills": ["photoshop", "illustrator"]}', 'demand_level' => 'low', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Project Manager', 'domain' => 'Business', 'salary' => 90000, 'description' => 'Lead project teams.', 'requirements' => '{"skills": ["leadership", "planning"]}', 'demand_level' => 'high', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Cybersecurity Specialist', 'domain' => 'Security', 'salary' => 80000, 'description' => 'Protect systems from threats.', 'requirements' => '{"skills": ["ethical hacking", "encryption"]}', 'demand_level' => 'high', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Web Developer', 'domain' => 'Technology', 'salary' => 65000, 'description' => 'Build web applications.', 'requirements' => '{"skills": ["html", "javascript"]}', 'demand_level' => 'medium', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Machine Learning Engineer', 'domain' => 'AI', 'salary' => 95000, 'description' => 'Develop AI models.', 'requirements' => '{"skills": ["python", "tensorflow"]}', 'demand_level' => 'high', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Marketing Specialist', 'domain' => 'Business', 'salary' => 60000, 'description' => 'Manage marketing campaigns.', 'requirements' => '{"skills": ["seo", "content creation"]}', 'demand_level' => 'medium', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Database Administrator', 'domain' => 'IT', 'salary' => 75000, 'description' => 'Maintain databases.', 'requirements' => '{"skills": ["sql", "backup"]}', 'demand_level' => 'medium', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Cloud Architect', 'domain' => 'Technology', 'salary' => 100000, 'description' => 'Design cloud solutions.', 'requirements' => '{"skills": ["aws", "azure"]}', 'demand_level' => 'high', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'UX Designer', 'domain' => 'Design', 'salary' => 70000, 'description' => 'Improve user experience.', 'requirements' => '{"skills": ["wireframing", "research"]}', 'demand_level' => 'medium', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'DevOps Engineer', 'domain' => 'IT', 'salary' => 85000, 'description' => 'Automate deployments.', 'requirements' => '{"skills": ["docker", "kubernetes"]}', 'demand_level' => 'high', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Financial Analyst', 'domain' => 'Finance', 'salary' => 80000, 'description' => 'Analyze financial data.', 'requirements' => '{"skills": ["excel", "forecasting"]}', 'demand_level' => 'medium', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'HR Manager', 'domain' => 'Business', 'salary' => 75000, 'description' => 'Oversee HR operations.', 'requirements' => '{"skills": ["recruitment", "training"]}', 'demand_level' => 'low', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert into career_recommendations table
        DB::table('career_recommendations')->insert([
            ['career_id' => 1, 'quiz_category' => 'Technology', 'min_percentage' => 75, 'created_at' => now(), 'updated_at' => now()],
            ['career_id' => 2, 'quiz_category' => 'Data Science', 'min_percentage' => 70, 'created_at' => now(), 'updated_at' => now()],
            ['career_id' => 3, 'quiz_category' => 'IT', 'min_percentage' => 65, 'created_at' => now(), 'updated_at' => now()],
            ['career_id' => 4, 'quiz_category' => 'Design', 'min_percentage' => 60, 'created_at' => now(), 'updated_at' => now()],
            ['career_id' => 5, 'quiz_category' => 'Business', 'min_percentage' => 80, 'created_at' => now(), 'updated_at' => now()],
            ['career_id' => 6, 'quiz_category' => 'Security', 'min_percentage' => 75, 'created_at' => now(), 'updated_at' => now()],
            ['career_id' => 7, 'quiz_category' => 'Technology', 'min_percentage' => 65, 'created_at' => now(), 'updated_at' => now()],
            ['career_id' => 8, 'quiz_category' => 'AI', 'min_percentage' => 85, 'created_at' => now(), 'updated_at' => now()],
            ['career_id' => 9, 'quiz_category' => 'Business', 'min_percentage' => 65, 'created_at' => now(), 'updated_at' => now()],
            ['career_id' => 10, 'quiz_category' => 'IT', 'min_percentage' => 70, 'created_at' => now(), 'updated_at' => now()],
            ['career_id' => 11, 'quiz_category' => 'Technology', 'min_percentage' => 80, 'created_at' => now(), 'updated_at' => now()],
            ['career_id' => 12, 'quiz_category' => 'Design', 'min_percentage' => 70, 'created_at' => now(), 'updated_at' => now()],
            ['career_id' => 13, 'quiz_category' => 'IT', 'min_percentage' => 75, 'created_at' => now(), 'updated_at' => now()],
            ['career_id' => 14, 'quiz_category' => 'Finance', 'min_percentage' => 70, 'created_at' => now(), 'updated_at' => now()],
            ['career_id' => 15, 'quiz_category' => 'Business', 'min_percentage' => 65, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert into quizzes table
        DB::table('quizzes')->insert([
            ['title' => 'Programming Basics Quiz', 'category' => 'Technology', 'focus_user_type' => 'student', 'scoring_logic' => '{"correct": 10, "incorrect": -2}', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Web Design Fundamentals', 'category' => 'Design', 'focus_user_type' => 'student', 'scoring_logic' => '{"correct": 10, "incorrect": -2}', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Business Strategy Essentials', 'category' => 'Business', 'focus_user_type' => 'graduate', 'scoring_logic' => '{"correct": 10, "incorrect": -2}', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Network Security Basics', 'category' => 'Security', 'focus_user_type' => 'professional', 'scoring_logic' => '{"correct": 10, "incorrect": -2}', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Data Analysis Introduction', 'category' => 'Data Science', 'focus_user_type' => 'graduate', 'scoring_logic' => '{"correct": 10, "incorrect": -2}', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert into quiz_questions table
        DB::table('quiz_questions')->insert([
            // Quiz 1: Programming Basics Quiz (quiz_id = 1)
            ['quiz_id' => 1, 'text' => 'What is a variable in programming?', 'options' => '["A storage location for data", "A type of loop", "A function", "A database"]', 'answer' => 'A storage location for data', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 1, 'text' => 'Which keyword is used to declare a variable in JavaScript?', 'options' => '["var", "function", "class", "let"]', 'answer' => 'var', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 1, 'text' => 'What does the "if" statement do?', 'options' => '["Executes code based on a condition", "Creates a loop", "Defines a class", "Imports a library"]', 'answer' => 'Executes code based on a condition', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 1, 'text' => 'What is the purpose of a loop?', 'options' => '["To repeat code execution", "To define a variable", "To create a function", "To handle errors"]', 'answer' => 'To repeat code execution', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 1, 'text' => 'Which data type is used for text in Python?', 'options' => '["string", "integer", "boolean", "float"]', 'answer' => 'string', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            // Quiz 2: Web Design Fundamentals (quiz_id = 2)
            ['quiz_id' => 2, 'text' => 'What does CSS stand for?', 'options' => '["Cascading Style Sheets", "Creative Style System", "Computer Style Software", "Colorful Style Syntax"]', 'answer' => 'Cascading Style Sheets', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 2, 'text' => 'Which HTML tag is used for images?', 'options' => '["<img>", "<image>", "<pic>", "<figure>"]', 'answer' => '<img>', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 2, 'text' => 'What is the purpose of a responsive design?', 'options' => '["To adapt to different screen sizes", "To increase page load time", "To disable JavaScript", "To hide content"]', 'answer' => 'To adapt to different screen sizes', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 2, 'text' => 'Which property controls the text color in CSS?', 'options' => '["color", "font-color", "text-style", "background"]', 'answer' => 'color', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 2, 'text' => 'What does UX stand for in web design?', 'options' => '["User Experience", "User Extension", "Unified Execution", "Universal Extraction"]', 'answer' => 'User Experience', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            // Quiz 3: Business Strategy Essentials (quiz_id = 3)
            ['quiz_id' => 3, 'text' => 'What is a SWOT analysis used for?', 'options' => '["Evaluating Strengths, Weaknesses, Opportunities, Threats", "Calculating financial profits", "Designing product features", "Managing employee schedules"]', 'answer' => 'Evaluating Strengths, Weaknesses, Opportunities, Threats', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 3, 'text' => 'What does ROI stand for?', 'options' => '["Return on Investment", "Rate of Interest", "Revenue on Income", "Risk of Investment"]', 'answer' => 'Return on Investment', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 3, 'text' => 'Which strategy focuses on low cost to attract customers?', 'options' => '["Cost Leadership", "Differentiation", "Focus", "Diversification"]', 'answer' => 'Cost Leadership', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 3, 'text' => 'What is the purpose of a business plan?', 'options' => '["To outline goals and strategies", "To design a website", "To hire employees", "To calculate taxes"]', 'answer' => 'To outline goals and strategies', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 3, 'text' => 'What does CRM stand for?', 'options' => '["Customer Relationship Management", "Corporate Revenue Model", "Central Resource Management", "Customer Retention Method"]', 'answer' => 'Customer Relationship Management', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            // Quiz 4: Network Security Basics (quiz_id = 4)
            ['quiz_id' => 4, 'text' => 'What is phishing?', 'options' => '["A type of email scam", "A network protocol", "A hardware device", "A programming language"]', 'answer' => 'A type of email scam', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 4, 'text' => 'Which protocol is used for secure web communication?', 'options' => '["HTTPS", "HTTP", "FTP", "SMTP"]', 'answer' => 'HTTPS', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 4, 'text' => 'What does a firewall protect against?', 'options' => '["Unauthorized access", "Hardware failure", "Software bugs", "Network cables"]', 'answer' => 'Unauthorized access', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 4, 'text' => 'What is the purpose of encryption?', 'options' => '["To secure data", "To speed up networks", "To store files", "To design interfaces"]', 'answer' => 'To secure data', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 4, 'text' => 'Which port is commonly used for HTTP?', 'options' => '["80", "443", "21", "25"]', 'answer' => '80', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            // Quiz 5: Data Analysis Introduction (quiz_id = 5)
            ['quiz_id' => 5, 'text' => 'What is a pivot table used for?', 'options' => '["Summarizing data", "Creating charts", "Writing code", "Designing websites"]', 'answer' => 'Summarizing data', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 5, 'text' => 'Which tool is popular for data visualization?', 'options' => '["Power BI", "Notepad", "Word", "Excel"]', 'answer' => 'Power BI', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 5, 'text' => 'What does SQL stand for?', 'options' => '["Structured Query Language", "Simple Query Language", "System Query Logic", "Sequential Query Language"]', 'answer' => 'Structured Query Language', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 5, 'text' => 'What is the purpose of data cleaning?', 'options' => '["To remove errors and inconsistencies", "To increase file size", "To add random data", "To delete all data"]', 'answer' => 'To remove errors and inconsistencies', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 5, 'text' => 'Which metric measures central tendency?', 'options' => '["Mean", "Color", "Width", "Height"]', 'answer' => 'Mean', 'weight' => 10, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert into multimedia table
        DB::table('multimedia')->insert([
            ['title' => 'Intro to Programming', 'type' => 'video', 'file_path' => '/uploads/programming_intro.mp4', 'tags' => '{"tags": ["video", "programming"]}', 'category' => 'Technology', 'download_count' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Data Analysis Guide', 'type' => 'pdf', 'file_path' => '/uploads/data_analysis.pdf', 'tags' => '{"tags": ["pdf", "data"]}', 'category' => 'Data Science', 'download_count' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Network Basics', 'type' => 'video', 'file_path' => '/uploads/network_basics.mp4', 'tags' => '{"tags": ["video", "network"]}', 'category' => 'IT', 'download_count' => 40, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Design Tutorial', 'type' => 'image', 'file_path' => '/uploads/design_tutorial.jpg', 'tags' => '{"tags": ["image", "design"]}', 'category' => 'Design', 'download_count' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Project Management PDF', 'type' => 'pdf', 'file_path' => '/uploads/pm_guide.pdf', 'tags' => '{"tags": ["pdf", "pm"]}', 'category' => 'Business', 'download_count' => 25, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Cybersecurity Video', 'type' => 'video', 'file_path' => '/uploads/cyber_video.mp4', 'tags' => '{"tags": ["video", "security"]}', 'category' => 'Security', 'download_count' => 35, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Web Dev Basics', 'type' => 'video', 'file_path' => '/uploads/web_dev.mp4', 'tags' => '{"tags": ["video", "web"]}', 'category' => 'Technology', 'download_count' => 45, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'AI Overview', 'type' => 'pdf', 'file_path' => '/uploads/ai_overview.pdf', 'tags' => '{"tags": ["pdf", "ai"]}', 'category' => 'AI', 'download_count' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Marketing Guide', 'type' => 'image', 'file_path' => '/uploads/marketing.jpg', 'tags' => '{"tags": ["image", "marketing"]}', 'category' => 'Business', 'download_count' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'DB Tutorial', 'type' => 'video', 'file_path' => '/uploads/db_tutorial.mp4', 'tags' => '{"tags": ["video", "db"]}', 'category' => 'IT', 'download_count' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Cloud Intro', 'type' => 'pdf', 'file_path' => '/uploads/cloud_intro.pdf', 'tags' => '{"tags": ["pdf", "cloud"]}', 'category' => 'Technology', 'download_count' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'UX Guide', 'type' => 'image', 'file_path' => '/uploads/ux_guide.jpg', 'tags' => '{"tags": ["image", "ux"]}', 'category' => 'Design', 'download_count' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'DevOps Video', 'type' => 'video', 'file_path' => '/uploads/devops_video.mp4', 'tags' => '{"tags": ["video", "devops"]}', 'category' => 'IT', 'download_count' => 25, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Finance Basics', 'type' => 'pdf', 'file_path' => '/uploads/finance.pdf', 'tags' => '{"tags": ["pdf", "finance"]}', 'category' => 'Finance', 'download_count' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'HR Video', 'type' => 'video', 'file_path' => '/uploads/hr_video.mp4', 'tags' => '{"tags": ["video", "hr"]}', 'category' => 'Business', 'download_count' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert into success_stories table
        DB::table('success_stories')->insert([
            ['title' => 'From Student to Engineer', 'domain' => 'Technology', 'story_text' => 'Started with basic coding, now a software engineer.', 'timeline' => '{"years": ["2020", "2025"]}', 'user_id' => 2, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Data Career Journey', 'domain' => 'Data Science', 'story_text' => 'Learned data skills, now analyst.', 'timeline' => '{"years": ["2021", "2025"]}', 'user_id' => 3, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Networking Success', 'domain' => 'IT', 'story_text' => 'Built networks, now admin.', 'timeline' => '{"years": ["2022", "2025"]}', 'user_id' => 4, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Design Breakthrough', 'domain' => 'Design', 'story_text' => 'Mastered design tools, now designer.', 'timeline' => '{"years": ["2020", "2025"]}', 'user_id' => 1, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Project Management Rise', 'domain' => 'Business', 'story_text' => 'Led projects, now manager.', 'timeline' => '{"years": ["2021", "2025"]}', 'user_id' => 2, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Security Expert', 'domain' => 'Security', 'story_text' => 'Secured systems, now specialist.', 'timeline' => '{"years": ["2022", "2025"]}', 'user_id' => 3, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Web Dev Success', 'domain' => 'Technology', 'story_text' => 'Built websites, now developer.', 'timeline' => '{"years": ["2020", "2025"]}', 'user_id' => 4, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'AI Pioneer', 'domain' => 'AI', 'story_text' => 'Developed AI models, now engineer.', 'timeline' => '{"years": ["2021", "2025"]}', 'user_id' => 1, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Marketing Pro', 'domain' => 'Business', 'story_text' => 'Ran campaigns, now specialist.', 'timeline' => '{"years": ["2022", "2025"]}', 'user_id' => 2, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'DB Admin Journey', 'domain' => 'IT', 'story_text' => 'Managed databases, now admin.', 'timeline' => '{"years": ["2020", "2025"]}', 'user_id' => 3, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Cloud Career', 'domain' => 'Technology', 'story_text' => 'Designed clouds, now architect.', 'timeline' => '{"years": ["2021", "2025"]}', 'user_id' => 4, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'UX Success', 'domain' => 'Design', 'story_text' => 'Improved UX, now designer.', 'timeline' => '{"years": ["2022", "2025"]}', 'user_id' => 1, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'DevOps Rise', 'domain' => 'IT', 'story_text' => 'Automated systems, now engineer.', 'timeline' => '{"years": ["2020", "2025"]}', 'user_id' => 2, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Finance Expert', 'domain' => 'Finance', 'story_text' => 'Analyzed finances, now analyst.', 'timeline' => '{"years": ["2021", "2025"]}', 'user_id' => 3, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'HR Leader', 'domain' => 'Business', 'story_text' => 'Managed HR, now manager.', 'timeline' => '{"years": ["2022", "2025"]}', 'user_id' => 4, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert into feedback table
        DB::table('feedback')->insert([
            ['user_id' => 1, 'type' => 'bug', 'message' => 'UI not loading.', 'sentiment' => 'negative', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'type' => 'suggestion', 'message' => 'Add more quizzes.', 'sentiment' => 'positive', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'type' => 'query', 'message' => 'How to download content?', 'sentiment' => 'neutral', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'type' => 'bug', 'message' => 'Video not playing.', 'sentiment' => 'negative', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'type' => 'suggestion', 'message' => 'Improve analytics.', 'sentiment' => 'positive', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'type' => 'query', 'message' => 'Where is my resume?', 'sentiment' => 'neutral', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'type' => 'bug', 'message' => 'Page crashed.', 'sentiment' => 'negative', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'type' => 'suggestion', 'message' => 'Add chat support.', 'sentiment' => 'positive', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'type' => 'query', 'message' => 'What is demand level?', 'sentiment' => 'neutral', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'type' => 'bug', 'message' => 'Login issue.', 'sentiment' => 'negative', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'type' => 'suggestion', 'message' => 'More tutorials.', 'sentiment' => 'positive', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'type' => 'query', 'message' => 'How to edit profile?', 'sentiment' => 'neutral', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'type' => 'bug', 'message' => 'Slow loading.', 'sentiment' => 'negative', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'type' => 'suggestion', 'message' => 'Add mobile app.', 'sentiment' => 'positive', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'type' => 'query', 'message' => 'What is UX?', 'sentiment' => 'neutral', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}