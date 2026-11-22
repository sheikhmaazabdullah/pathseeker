INSERT INTO careers (title, domain, salary, description, requirements, demand_level, created_at, updated_at) VALUES
('Software Engineer', 'Technology', 85000, 'Develop software applications.', '{"skills": ["programming", "problem-solving"]}', 'high', GETDATE(), GETDATE()),
('Data Analyst', 'Data Science', 70000, 'Analyze data trends.', '{"skills": ["data analysis", "statistics"]}', 'medium', GETDATE(), GETDATE()),
('Network Administrator', 'IT', 65000, 'Manage network infrastructure.', '{"skills": ["networking", "security"]}', 'medium', GETDATE(), GETDATE()),
('Graphic Designer', 'Design', 55000, 'Create visual content.', '{"skills": ["photoshop", "illustrator"]}', 'low', GETDATE(), GETDATE()),
('Project Manager', 'Business', 90000, 'Lead project teams.', '{"skills": ["leadership", "planning"]}', 'high', GETDATE(), GETDATE()),
('Cybersecurity Specialist', 'Security', 80000, 'Protect systems from threats.', '{"skills": ["ethical hacking", "encryption"]}', 'high', GETDATE(), GETDATE()),
('Web Developer', 'Technology', 65000, 'Build web applications.', '{"skills": ["html", "javascript"]}', 'medium', GETDATE(), GETDATE()),
('Machine Learning Engineer', 'AI', 95000, 'Develop AI models.', '{"skills": ["python", "tensorflow"]}', 'high', GETDATE(), GETDATE()),
('Marketing Specialist', 'Business', 60000, 'Manage marketing campaigns.', '{"skills": ["seo", "content creation"]}', 'medium', GETDATE(), GETDATE()),
('Database Administrator', 'IT', 75000, 'Maintain databases.', '{"skills": ["sql", "backup"]}', 'medium', GETDATE(), GETDATE()),
('Cloud Architect', 'Technology', 100000, 'Design cloud solutions.', '{"skills": ["aws", "azure"]}', 'high', GETDATE(), GETDATE()),
('UX Designer', 'Design', 70000, 'Improve user experience.', '{"skills": ["wireframing", "research"]}', 'medium', GETDATE(), GETDATE()),
('DevOps Engineer', 'IT', 85000, 'Automate deployments.', '{"skills": ["docker", "kubernetes"]}', 'high', GETDATE(), GETDATE()),
('Financial Analyst', 'Finance', 80000, 'Analyze financial data.', '{"skills": ["excel", "forecasting"]}', 'medium', GETDATE(), GETDATE()),
('HR Manager', 'Business', 75000, 'Oversee HR operations.', '{"skills": ["recruitment", "training"]}', 'low', GETDATE(), GETDATE());

INSERT INTO career_recommendations (career_id, quiz_category, min_percentage, created_at, updated_at) VALUES
(1, 'Technology', 75, GETDATE(), GETDATE()), -- Software Engineer
(2, 'Data Science', 70, GETDATE(), GETDATE()), -- Data Analyst
(3, 'IT', 65, GETDATE(), GETDATE()), -- Network Administrator
(4, 'Design', 60, GETDATE(), GETDATE()), -- Graphic Designer
(5, 'Business', 80, GETDATE(), GETDATE()), -- Project Manager
(6, 'Security', 75, GETDATE(), GETDATE()), -- Cybersecurity Specialist
(7, 'Technology', 65, GETDATE(), GETDATE()), -- Web Developer
(8, 'AI', 85, GETDATE(), GETDATE()), -- Machine Learning Engineer
(9, 'Business', 65, GETDATE(), GETDATE()), -- Marketing Specialist
(10, 'IT', 70, GETDATE(), GETDATE()), -- Database Administrator
(11, 'Technology', 80, GETDATE(), GETDATE()), -- Cloud Architect
(12, 'Design', 70, GETDATE(), GETDATE()), -- UX Designer
(13, 'IT', 75, GETDATE(), GETDATE()), -- DevOps Engineer
(14, 'Finance', 70, GETDATE(), GETDATE()), -- Financial Analyst
(15, 'Business', 65, GETDATE(), GETDATE()); -- HR Manager

-- Insert into quizzes table
INSERT INTO quizzes (title, category, focus_user_type, scoring_logic, created_at, updated_at)
VALUES
    ('Programming Basics Quiz', 'Technology', 'student', '{"correct": 10, "incorrect": -2}', GETDATE(), GETDATE()),
    ('Web Design Fundamentals', 'Design', 'student', '{"correct": 10, "incorrect": -2}', GETDATE(), GETDATE()),
    ('Business Strategy Essentials', 'Business', 'graduate', '{"correct": 10, "incorrect": -2}', GETDATE(), GETDATE()),
    ('Network Security Basics', 'Security', 'professional', '{"correct": 10, "incorrect": -2}', GETDATE(), GETDATE()),
    ('Data Analysis Introduction', 'Data Science', 'graduate', '{"correct": 10, "incorrect": -2}', GETDATE(), GETDATE());

-- Insert into quiz_questions table (linked to quizzes by quiz_id)
-- Quiz 1: Programming Basics Quiz (quiz_id = 1)
INSERT INTO quiz_questions (quiz_id, text, options, answer, weight, created_at, updated_at)
VALUES
    (1, 'What is a variable in programming?', '["A storage location for data", "A type of loop", "A function", "A database"]', 'A storage location for data', 10, GETDATE(), GETDATE()),
    (1, 'Which keyword is used to declare a variable in JavaScript?', '["var", "function", "class", "let"]', 'var', 10, GETDATE(), GETDATE()),
    (1, 'What does the "if" statement do?', '["Executes code based on a condition", "Creates a loop", "Defines a class", "Imports a library"]', 'Executes code based on a condition', 10, GETDATE(), GETDATE()),
    (1, 'What is the purpose of a loop?', '["To repeat code execution", "To define a variable", "To create a function", "To handle errors"]', 'To repeat code execution', 10, GETDATE(), GETDATE()),
    (1, 'Which data type is used for text in Python?', '["string", "integer", "boolean", "float"]', 'string', 10, GETDATE(), GETDATE());

-- Quiz 2: Web Design Fundamentals (quiz_id = 2)
INSERT INTO quiz_questions (quiz_id, text, options, answer, weight, created_at, updated_at)
VALUES
    (2, 'What does CSS stand for?', '["Cascading Style Sheets", "Creative Style System", "Computer Style Software", "Colorful Style Syntax"]', 'Cascading Style Sheets', 10, GETDATE(), GETDATE()),
    (2, 'Which HTML tag is used for images?', '["<img>", "<image>", "<pic>", "<figure>"]', '<img>', 10, GETDATE(), GETDATE()),
    (2, 'What is the purpose of a responsive design?', '["To adapt to different screen sizes", "To increase page load time", "To disable JavaScript", "To hide content"]', 'To adapt to different screen sizes', 10, GETDATE(), GETDATE()),
    (2, 'Which property controls the text color in CSS?', '["color", "font-color", "text-style", "background"]', 'color', 10, GETDATE(), GETDATE()),
    (2, 'What does UX stand for in web design?', '["User Experience", "User Extension", "Unified Execution", "Universal Extraction"]', 'User Experience', 10, GETDATE(), GETDATE());

-- Quiz 3: Business Strategy Essentials (quiz_id = 3)
INSERT INTO quiz_questions (quiz_id, text, options, answer, weight, created_at, updated_at)
VALUES
    (3, 'What is a SWOT analysis used for?', '["Evaluating Strengths, Weaknesses, Opportunities, Threats", "Calculating financial profits", "Designing product features", "Managing employee schedules"]', 'Evaluating Strengths, Weaknesses, Opportunities, Threats', 10, GETDATE(), GETDATE()),
    (3, 'What does ROI stand for?', '["Return on Investment", "Rate of Interest", "Revenue on Income", "Risk of Investment"]', 'Return on Investment', 10, GETDATE(), GETDATE()),
    (3, 'Which strategy focuses on low cost to attract customers?', '["Cost Leadership", "Differentiation", "Focus", "Diversification"]', 'Cost Leadership', 10, GETDATE(), GETDATE()),
    (3, 'What is the purpose of a business plan?', '["To outline goals and strategies", "To design a website", "To hire employees", "To calculate taxes"]', 'To outline goals and strategies', 10, GETDATE(), GETDATE()),
    (3, 'What does CRM stand for?', '["Customer Relationship Management", "Corporate Revenue Model", "Central Resource Management", "Customer Retention Method"]', 'Customer Relationship Management', 10, GETDATE(), GETDATE());

-- Quiz 4: Network Security Basics (quiz_id = 4)
INSERT INTO quiz_questions (quiz_id, text, options, answer, weight, created_at, updated_at)
VALUES
    (4, 'What is phishing?', '["A type of email scam", "A network protocol", "A hardware device", "A programming language"]', 'A type of email scam', 10, GETDATE(), GETDATE()),
    (4, 'Which protocol is used for secure web communication?', '["HTTPS", "HTTP", "FTP", "SMTP"]', 'HTTPS', 10, GETDATE(), GETDATE()),
    (4, 'What does a firewall protect against?', '["Unauthorized access", "Hardware failure", "Software bugs", "Network cables"]', 'Unauthorized access', 10, GETDATE(), GETDATE()),
    (4, 'What is the purpose of encryption?', '["To secure data", "To speed up networks", "To store files", "To design interfaces"]', 'To secure data', 10, GETDATE(), GETDATE()),
    (4, 'Which port is commonly used for HTTP?', '["80", "443", "21", "25"]', '80', 10, GETDATE(), GETDATE());

-- Quiz 5: Data Analysis Introduction (quiz_id = 5)
INSERT INTO quiz_questions (quiz_id, text, options, answer, weight, created_at, updated_at)
VALUES
    (5, 'What is a pivot table used for?', '["Summarizing data", "Creating charts", "Writing code", "Designing websites"]', 'Summarizing data', 10, GETDATE(), GETDATE()),
    (5, 'Which tool is popular for data visualization?', '["Power BI", "Notepad", "Word", "Excel"]', 'Power BI', 10, GETDATE(), GETDATE()),
    (5, 'What does SQL stand for?', '["Structured Query Language", "Simple Query Language", "System Query Logic", "Sequential Query Language"]', 'Structured Query Language', 10, GETDATE(), GETDATE()),
    (5, 'What is the purpose of data cleaning?', '["To remove errors and inconsistencies", "To increase file size", "To add random data", "To delete all data"]', 'To remove errors and inconsistencies', 10, GETDATE(), GETDATE()),
    (5, 'Which metric measures central tendency?', '["Mean", "Color", "Width", "Height"]', 'Mean', 10, GETDATE(), GETDATE());

INSERT INTO multimedia (title, type, file_path, tags, category, download_count, created_at, updated_at) VALUES
('Intro to Programming', 'video', '/uploads/programming_intro.mp4', '{"tags": ["video", "programming"]}', 'Technology', 50, GETDATE(), GETDATE()),
('Data Analysis Guide', 'pdf', '/uploads/data_analysis.pdf', '{"tags": ["pdf", "data"]}', 'Data Science', 30, GETDATE(), GETDATE()),
('Network Basics', 'video', '/uploads/network_basics.mp4', '{"tags": ["video", "network"]}', 'IT', 40, GETDATE(), GETDATE()),
('Design Tutorial', 'image', '/uploads/design_tutorial.jpg', '{"tags": ["image", "design"]}', 'Design', 20, GETDATE(), GETDATE()),
('Project Management PDF', 'pdf', '/uploads/pm_guide.pdf', '{"tags": ["pdf", "pm"]}', 'Business', 25, GETDATE(), GETDATE()),
('Cybersecurity Video', 'video', '/uploads/cyber_video.mp4', '{"tags": ["video", "security"]}', 'Security', 35, GETDATE(), GETDATE()),
('Web Dev Basics', 'video', '/uploads/web_dev.mp4', '{"tags": ["video", "web"]}', 'Technology', 45, GETDATE(), GETDATE()),
('AI Overview', 'pdf', '/uploads/ai_overview.pdf', '{"tags": ["pdf", "ai"]}', 'AI', 15, GETDATE(), GETDATE()),
('Marketing Guide', 'image', '/uploads/marketing.jpg', '{"tags": ["image", "marketing"]}', 'Business', 10, GETDATE(), GETDATE()),
('DB Tutorial', 'video', '/uploads/db_tutorial.mp4', '{"tags": ["video", "db"]}', 'IT', 30, GETDATE(), GETDATE()),
('Cloud Intro', 'pdf', '/uploads/cloud_intro.pdf', '{"tags": ["pdf", "cloud"]}', 'Technology', 20, GETDATE(), GETDATE()),
('UX Guide', 'image', '/uploads/ux_guide.jpg', '{"tags": ["image", "ux"]}', 'Design', 15, GETDATE(), GETDATE()),
('DevOps Video', 'video', '/uploads/devops_video.mp4', '{"tags": ["video", "devops"]}', 'IT', 25, GETDATE(), GETDATE()),
('Finance Basics', 'pdf', '/uploads/finance.pdf', '{"tags": ["pdf", "finance"]}', 'Finance', 10, GETDATE(), GETDATE()),
('HR Video', 'video', '/uploads/hr_video.mp4', '{"tags": ["video", "hr"]}', 'Business', 5, GETDATE(), GETDATE());

INSERT INTO success_stories (title, domain, story_text, timeline, user_id, status, created_at, updated_at) VALUES
('From Student to Engineer', 'Technology', 'Started with basic coding, now a software engineer.', '{"years": ["2020", "2025"]}', 2, 'approved', GETDATE(), GETDATE()),
('Data Career Journey', 'Data Science', 'Learned data skills, now analyst.', '{"years": ["2021", "2025"]}', 3, 'approved', GETDATE(), GETDATE()),
('Networking Success', 'IT', 'Built networks, now admin.', '{"years": ["2022", "2025"]}', 4, 'approved', GETDATE(), GETDATE()),
('Design Breakthrough', 'Design', 'Mastered design tools, now designer.', '{"years": ["2020", "2025"]}', 1, 'approved', GETDATE(), GETDATE()),
('Project Management Rise', 'Business', 'Led projects, now manager.', '{"years": ["2021", "2025"]}', 2, 'approved', GETDATE(), GETDATE()),
('Security Expert', 'Security', 'Secured systems, now specialist.', '{"years": ["2022", "2025"]}', 3, 'approved', GETDATE(), GETDATE()),
('Web Dev Success', 'Technology', 'Built websites, now developer.', '{"years": ["2020", "2025"]}', 4, 'approved', GETDATE(), GETDATE()),
('AI Pioneer', 'AI', 'Developed AI models, now engineer.', '{"years": ["2021", "2025"]}', 1, 'approved', GETDATE(), GETDATE()),
('Marketing Pro', 'Business', 'Ran campaigns, now specialist.', '{"years": ["2022", "2025"]}', 2, 'approved', GETDATE(), GETDATE()),
('DB Admin Journey', 'IT', 'Managed databases, now admin.', '{"years": ["2020", "2025"]}', 3, 'approved', GETDATE(), GETDATE()),
('Cloud Career', 'Technology', 'Designed clouds, now architect.', '{"years": ["2021", "2025"]}', 4, 'approved', GETDATE(), GETDATE()),
('UX Success', 'Design', 'Improved UX, now designer.', '{"years": ["2022", "2025"]}', 1, 'approved', GETDATE(), GETDATE()),
('DevOps Rise', 'IT', 'Automated systems, now engineer.', '{"years": ["2020", "2025"]}', 2, 'approved', GETDATE(), GETDATE()),
('Finance Expert', 'Finance', 'Analyzed finances, now analyst.', '{"years": ["2021", "2025"]}', 3, 'approved', GETDATE(), GETDATE()),
('HR Leader', 'Business', 'Managed HR, now manager.', '{"years": ["2022", "2025"]}', 4, 'approved', GETDATE(), GETDATE());

INSERT INTO feedback (user_id, type, message, sentiment, created_at, updated_at) VALUES
(1, 'bug', 'UI not loading.', 'negative', GETDATE(), GETDATE()),
(2, 'suggestion', 'Add more quizzes.', 'positive', GETDATE(), GETDATE()),
(3, 'query', 'How to download content?', 'neutral', GETDATE(), GETDATE()),
(4, 'bug', 'Video not playing.', 'negative', GETDATE(), GETDATE()),
(1, 'suggestion', 'Improve analytics.', 'positive', GETDATE(), GETDATE()),
(2, 'query', 'Where is my resume?', 'neutral', GETDATE(), GETDATE()),
(3, 'bug', 'Page crashed.', 'negative', GETDATE(), GETDATE()),
(4, 'suggestion', 'Add chat support.', 'positive', GETDATE(), GETDATE()),
(1, 'query', 'What is demand level?', 'neutral', GETDATE(), GETDATE()),
(2, 'bug', 'Login issue.', 'negative', GETDATE(), GETDATE()),
(3, 'suggestion', 'More tutorials.', 'positive', GETDATE(), GETDATE()),
(4, 'query', 'How to edit profile?', 'neutral', GETDATE(), GETDATE()),
(1, 'bug', 'Slow loading.', 'negative', GETDATE(), GETDATE()),
(2, 'suggestion', 'Add mobile app.', 'positive', GETDATE(), GETDATE()),
(3, 'query', 'What is UX?', 'neutral', GETDATE(), GETDATE());

