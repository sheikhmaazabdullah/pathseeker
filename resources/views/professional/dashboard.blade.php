@extends('layouts.app')

@section('title', 'Professional Dashboard - PathSeeker')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">Welcome, {{ $user->name }}</h2>
                <div class="row">
                    <div class="col-md-3 col-sm-6 grid-margin stretch-card">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h4 class="card-title">High-Demand Careers</h4>
                                <h2 class="text-white">{{ $careers->where('demand_level', 'high')->count() }}</h2>
                                <p>Explore top opportunities</p>
                                <a href="{{ route('career.index') }}" class="btn btn-light btn-sm">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 grid-margin stretch-card">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h4 class="card-title">Available Quizzes</h4>
                                <h2 class="text-white">{{ $quizzes->count() }}</h2>
                                <p>Professional-focused assessments</p>
                                <a href="{{ route('quiz.index') }}" class="btn btn-light btn-sm">Take Quiz</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 grid-margin stretch-card">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h4 class="card-title">Resources</h4>
                                <h2 class="text-white">{{ $multimedia->count() }}</h2>
                                <p>Downloadable content</p>
                                <a href="#" class="btn btn-light btn-sm">Browse</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 grid-margin stretch-card">
                        <div class="card bg-warning text-dark">
                            <div class="card-body">
                                <h4 class="card-title">Success Stories</h4>
                                <h2 class="text-dark">{{ $successStories->count() }}</h2>
                                <p>Inspiring journeys</p>
                                <a href="{{ route('professional.stories') }}" class="btn btn-light btn-sm">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recommended Careers -->
                <div class="row mt-4">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Recommended Careers (Based on Your Skills: {{ implode(', ', $userSkills) }})</h4>
                                <div class="row">
                                    @forelse($recommendedCareers as $career)
                                        <div class="col-md-4">
                                            <div class="card shadow-sm">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $career->title }}</h5>
                                                    <p class="card-text">Salary: ${{ number_format($career->salary) }} | Demand: {{ ucfirst($career->demand_level) }}</p>
                                                    @php
                                                        $reqJson = $career->requirements ?? '{}';
                                                        if (is_array($reqJson) || is_object($reqJson)) {
                                                            $reqArray = (array) $reqJson;
                                                        } else {
                                                            $reqArray = json_decode($reqJson, true) ?? [];
                                                        }
                                                        $skills = $reqArray['skills'] ?? [];
                                                        if (is_string($skills)) {
                                                            $skills = json_decode($skills, true) ?? [];
                                                        }
                                                    @endphp
                                                    <p class="card-text"><small>Skills Needed: {{ implode(', ', $skills) }}</small></p>
                                                    <a href="{{ route('career.show', $career->id) }}" class="btn btn-primary btn-sm">Explore</a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <p class="text-muted">No recommendations yet. Complete a quiz to get personalized suggestions!</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row mt-4">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Quick Actions</h4>
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{ route('professional.profile') }}" class="btn btn-outline-primary btn-block">Update Profile</a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('quiz.index') }}" class="btn btn-outline-success btn-block">Take a Quiz</a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="#" class="btn btn-outline-info btn-block">View Resources</a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('professional.feedback') }}" class="btn btn-outline-warning btn-block">Share Feedback</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection