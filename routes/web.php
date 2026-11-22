<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\GraduateController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Auth;

// Authentication Routes (disable default verify and reset routes)
Auth::routes(['verify' => false, 'reset' => false]);

// Custom Verification Routes (OTP-based)
Route::get('/verify', [VerificationController::class, 'show'])->name('verify')->middleware('auth');
Route::post('/verify', [VerificationController::class, 'verify'])->name('verify.otp')->middleware('auth');
Route::post('/verification/resend', [VerificationController::class, 'resend'])->name('verification.resend')->middleware('auth');

// Custom Password Reset OTP Routes
Route::get('/password/email', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.email');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/otp', [ResetPasswordController::class, 'showOtpForm'])->name('password.reset.otp');
Route::post('/password/reset/otp', [ResetPasswordController::class, 'resetWithOtp'])->name('password.update.otp');

// Website Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/destinations', [HomeController::class, 'destinations'])->name('destinations');
Route::get('/guide', [HomeController::class, 'guide'])->name('guide');
Route::get('/package', [HomeController::class, 'package'])->name('package');
Route::get('/service', [HomeController::class, 'service'])->name('service');
Route::get('/single', [HomeController::class, 'single'])->name('single');
Route::get('/testimonial', [HomeController::class, 'testimonial'])->name('testimonial');

// Admin Routes (Flat: No group/prefix to avoid blank page issues; individual middleware)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('admin')->name('admin.dashboard');

// User Management
Route::get('/admin/users', [AdminController::class, 'users'])->middleware('admin')->name('admin.users');
Route::get('/admin/add-user', [AdminController::class, 'addUser'])->middleware('admin')->name('admin.add-user');
Route::post('/admin/add-user', [AdminController::class, 'storeUser'])->middleware('admin')->name('admin.store-user');
Route::get('/admin/edit-user/{user}', [AdminController::class, 'editUser'])->middleware('admin')->name('admin.edit-user');
Route::put('/admin/update-user/{user}', [AdminController::class, 'updateUser'])->middleware('admin')->name('admin.update-user');
Route::delete('/admin/delete-user/{user}', [AdminController::class, 'deleteUser'])->middleware('admin')->name('admin.delete-user');
Route::get('/admin/view-user/{user}', [AdminController::class, 'viewUser'])->middleware('admin')->name('admin.view-user');

// User Approval Requests
Route::get('/admin/approve-users', [AdminController::class, 'usersequests'])->middleware('admin')->name('admin.usersequests');
Route::patch('/admin/approve/{user}', [AdminController::class, 'approveUser'])->middleware('admin')->name('admin.approve.user');
Route::patch('/admin/reject/{user}', [AdminController::class, 'rejectUser'])->middleware('admin')->name('admin.reject.user');

// Career Management
Route::get('/admin/careers', [AdminController::class, 'careers'])->middleware('admin')->name('admin.careers');
Route::get('/admin/add-career', [AdminController::class, 'addCareer'])->middleware('admin')->name('admin.add-career');
Route::post('/admin/add-career', [AdminController::class, 'storeCareer'])->middleware('admin')->name('admin.store-career');
Route::get('/admin/edit-career/{career}', [AdminController::class, 'editCareer'])->middleware('admin')->name('admin.edit-career');
Route::put('/admin/update-career/{career}', [AdminController::class, 'updateCareer'])->middleware('admin')->name('admin.update-career');
Route::delete('/admin/delete-career/{career}', [AdminController::class, 'deleteCareer'])->middleware('admin')->name('admin.delete-career');
Route::get('/admin/view-career/{career}', [AdminController::class, 'viewCareer'])->middleware('admin')->name('admin.view-career');

// Career Recommendation Management
Route::get('/admin/recommendations', [AdminController::class, 'manageRecommendations'])->middleware('admin')->name('admin.recommendations');
Route::post('/admin/recommendations', [AdminController::class, 'addRecommendation'])->middleware('admin')->name('admin.add-recommendation');
Route::get('/admin/edit-recommendation/{recommendation}', [AdminController::class, 'editRecommendation'])->middleware('admin')->name('admin.edit-recommendation');
Route::put('/admin/update-recommendation/{recommendation}', [AdminController::class, 'updateRecommendation'])->middleware('admin')->name('admin.update-recommendation');
Route::delete('/admin/delete-recommendation/{recommendation}', [AdminController::class, 'deleteRecommendation'])->middleware('admin')->name('admin.delete-recommendation');

// Quiz Management
Route::get('/admin/quizzes', [AdminController::class, 'quizzes'])->middleware('admin')->name('admin.quizzes');
Route::get('/admin/add-quiz', [AdminController::class, 'addQuiz'])->middleware('admin')->name('admin.add-quiz');
Route::post('/admin/add-quiz', [AdminController::class, 'storeQuiz'])->middleware('admin')->name('admin.store-quiz');
Route::get('/admin/edit-quiz/{quiz}', [AdminController::class, 'editQuiz'])->middleware('admin')->name('admin.edit-quiz');
Route::put('/admin/update-quiz/{quiz}', [AdminController::class, 'updateQuiz'])->middleware('admin')->name('admin.update-quiz');
Route::delete('/admin/delete-quiz/{quiz}', [AdminController::class, 'deleteQuiz'])->middleware('admin')->name('admin.delete-quiz');
Route::get('/admin/view-quiz/{quiz}', [AdminController::class, 'viewQuiz'])->middleware('admin')->name('admin.view-quiz');

// Multimedia Management
Route::get('/admin/multimedia', [AdminController::class, 'multimedia'])->middleware('admin')->name('admin.multimedia');
Route::get('/admin/upload-content', [AdminController::class, 'uploadContent'])->middleware('admin')->name('admin.upload-content');
Route::post('/admin/upload-content', [AdminController::class, 'storeContent'])->middleware('admin')->name('admin.store-content');
Route::get('/admin/edit-multimedia/{multimedia}', [AdminController::class, 'editMultimedia'])->middleware('admin')->name('admin.edit-multimedia');
Route::put('/admin/update-multimedia/{multimedia}', [AdminController::class, 'updateMultimedia'])->middleware('admin')->name('admin.update-multimedia');
Route::delete('/admin/delete-multimedia/{multimedia}', [AdminController::class, 'deleteMultimedia'])->middleware('admin')->name('admin.delete-multimedia');
Route::get('/admin/view-multimedia/{multimedia}', [AdminController::class, 'viewMultimedia'])->middleware('admin')->name('admin.view-multimedia');

// Success Stories Management
Route::get('/admin/success-stories', [AdminController::class, 'successStories'])->middleware('admin')->name('admin.success-stories');
Route::get('/admin/add-success-story', [AdminController::class, 'addSuccessStory'])->middleware('admin')->name('admin.add-success-story');
Route::post('/admin/add-success-story', [AdminController::class, 'storeSuccessStory'])->middleware('admin')->name('admin.store-success-story');
Route::get('/admin/edit-success-story/{story}', [AdminController::class, 'editSuccessStory'])->middleware('admin')->name('admin.edit-success-story');
Route::put('/admin/update-success-story/{story}', [AdminController::class, 'updateSuccessStory'])->middleware('admin')->name('admin.update-success-story');
Route::delete('/admin/delete-success-story/{story}', [AdminController::class, 'deleteSuccessStory'])->middleware('admin')->name('admin.delete-success-story');
Route::get('/admin/view-success-story/{story}', [AdminController::class, 'viewSuccessStory'])->middleware('admin')->name('admin.view-success-story');

// Feedback Management
Route::get('/admin/feedback', [AdminController::class, 'feedback'])->middleware('admin')->name('admin.feedback');
Route::get('/admin/add-feedback', [AdminController::class, 'addFeedback'])->middleware('admin')->name('admin.add-feedback');
Route::post('/admin/add-feedback', [AdminController::class, 'storeFeedback'])->middleware('admin')->name('admin.store-feedback');
Route::get('/admin/edit-feedback/{feedback}', [AdminController::class, 'editFeedback'])->middleware('admin')->name('admin.edit-feedback');
Route::put('/admin/update-feedback/{feedback}', [AdminController::class, 'updateFeedback'])->middleware('admin')->name('admin.update-feedback');
Route::delete('/admin/delete-feedback/{feedback}', [AdminController::class, 'deleteFeedback'])->middleware('admin')->name('admin.delete-feedback');
Route::get('/admin/view-feedback/{feedback}', [AdminController::class, 'viewFeedback'])->middleware('admin')->name('admin.view-feedback');

// Professional Routes
Route::middleware(['auth'])->prefix('professional')->name('professional.')->group(function () {
    Route::get('/dashboard', [ProfessionalController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfessionalController::class, 'profile'])->name('profile');
    Route::get('/update-profile', [ProfessionalController::class, 'showUpdateProfile'])->name('showUpdateProfile');
    Route::post('/update-profile', [ProfessionalController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/stories', [ProfessionalController::class, 'viewStories'])->name('stories');
    Route::post('/submit-feedback', [ProfessionalController::class, 'submitFeedback'])->name('submit-feedback');
    Route::get('/feedback', [ProfessionalController::class, 'feedback'])->name('feedback');
});

// Graduate Routes
Route::middleware(['auth'])->prefix('graduate')->name('graduate.')->group(function () {
    Route::get('/dashboard', [GraduateController::class, 'dashboard'])->name('dashboard');
    Route::get('/careers', [GraduateController::class, 'viewCareers'])->name('careers');
    Route::get('/career-search-suggestions', [GraduateController::class, 'careerSearchSuggestions'])->name('career-search-suggestions');
    Route::get('/quizzes', [GraduateController::class, 'showQuizList'])->name('quizzes');
    Route::get('/take-quiz/{id}', [GraduateController::class, 'takeQuiz'])->name('take-quiz');
    Route::post('/submit-quiz/{id}', [GraduateController::class, 'submitQuiz'])->name('submit-quiz');
    Route::get('/multimedia', [GraduateController::class, 'viewMultimedia'])->name('multimedia');
    Route::post('/rate-multimedia/{id}', [GraduateController::class, 'rateMultimedia'])->name('rate-multimedia');
    Route::get('/stories', [GraduateController::class, 'viewStories'])->name('stories');
    Route::post('/submit-story', [GraduateController::class, 'submitStory'])->name('submit-story');
    Route::get('/resources', [GraduateController::class, 'viewResources'])->name('resources');
    Route::get('/download-resource/{id}', [GraduateController::class, 'downloadResource'])->name('download-resource');
    Route::get('/feedback', [GraduateController::class, 'feedback'])->name('feedback');
    Route::post('/submit-feedback', [GraduateController::class, 'submitFeedback'])->name('submit-feedback');
    Route::post('/bookmarks/save', [GraduateController::class, 'saveBookmark'])->name('bookmarks.save');
    Route::get('/bookmarks', [GraduateController::class, 'bookmarks'])->name('bookmarks');
    Route::get('/profile', [GraduateController::class, 'editProfile'])->name('profile');
    Route::post('/updateProfile', [GraduateController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/related/{type}/{id}', [GraduateController::class, 'getRelated'])->name('related');
});

// Quiz Routes
Route::middleware(['auth'])->prefix('quiz')->name('quiz.')->group(function () {
    Route::get('/', [QuizController::class, 'index'])->name('index');
    Route::get('/{id}', [QuizController::class, 'show'])->name('show');
    Route::post('/{id}/submit', [QuizController::class, 'submit'])->name('submit');
    Route::get('/result/{attemptId}', [QuizController::class, 'result'])->name('result');
});

// Career Routes
Route::middleware(['auth'])->prefix('career')->name('career.')->group(function () {
    Route::get('/', [CareerController::class, 'index'])->name('index');
    Route::get('/{id}', [CareerController::class, 'show'])->name('show');
    Route::get('/search-suggestions', [CareerController::class, 'searchSuggestions'])->name('search-suggestions');
    Route::post('/save-preferences', [CareerController::class, 'savePreferences'])->name('save-preferences');
    Route::post('/bookmarks/save', [CareerController::class, 'saveBookmark'])->name('bookmarks.save');
});