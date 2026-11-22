@extends('layouts.app')
@section('title', 'Dashboard - PathSeeker')
@section('content')
<div class="dashboard-container">
    <h2>Dashboard</h2>
    <div class="welcome">
        @if (Auth::check())
            <p>Good Morning, {{ Auth::user()->name }}</p>
            <p>Your performance summary this week</p>
        @endif
    </div>

    <div class="category-selector">
        <h3>Select Category</h3>
        <select>
            <option value="">Select category</option>
            <option value="bootstrap">Bootstrap Bundle - This is a Bundle featuring 16 unique dashboards</option>
            <option value="angular">Angular Bundle - Everything you’ll ever need for your Angular projects</option>
            <option value="vue">VUE Bundle - Bundle of 6 Premium Vue Admin Dashboard</option>
            <option value="react">React Bundle - Bundle of 8 Premium React Admin Dashboard</option>
        </select>
    </div>

    <div class="notifications">
        <h3>You have 4 new notifications</h3>
        <a href="#">View all</a>
        <ul>
            <li>Application Error - Just now</li>
            <li>Settings - Private message</li>
            <li>New user registration - 2 days ago</li>
        </ul>
    </div>

    <div class="messages">
        <h3>You have 7 unread mails</h3>
        <a href="#">View all</a>
        <ul>
            <li>Marian Garner - The meeting is cancelled</li>
            <li>David Grey - The meeting is cancelled</li>
            <li>Travis Jenkins - The meeting is cancelled</li>
        </ul>
    </div>

    <div class="analytics">
        <h3>Analytics</h3>
        <div class="stats">
            <div>Bounce Rate: 32.53% (-0.5%)</div>
            <div>Page Views: 7,682 (+0.1%)</div>
            <div>New Sessions: 68.8 (68.8)</div>
            <div>Avg. Time on Site: 2m:35s (+0.8%)</div>
        </div>
        <div class="market-overview">
            <h4>Market Overview</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
            <div>This month</div>
            <div>Settings</div>
            <div class="dropdown">
                <a href="#">Action</a>
                <a href="#">Another action</a>
                <a href="#">Something else here</a>
                <a href="#">Separated link</a>
            </div>
            <div>$36,2531.00 USD (+1.37%)</div>
        </div>
    </div>

    <div class="pending-requests">
        <h3>Pending Requests</h3>
        <p>You have 50+ new requests</p>
        <button>Add new member</button>
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Company</th>
                    <th>Progress</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Brandon Washington</td>
                    <td>Company name 1</td>
                    <td>79% (85/162)</td>
                    <td>In progress</td>
                </tr>
                <tr>
                    <td>Laura Brooks</td>
                    <td>Company name 1</td>
                    <td>65% (85/162)</td>
                    <td>In progress</td>
                </tr>
                <tr>
                    <td>Wayne Murphy</td>
                    <td>Company name 1</td>
                    <td>65% (85/162)</td>
                    <td>In progress</td>
                </tr>
                <tr>
                    <td>Matthew Bailey</td>
                    <td>Company name 1</td>
                    <td>65% (85/162)</td>
                    <td>Pending</td>
                </tr>
                <tr>
                    <td>Katherine Butler</td>
                    <td>Company name 1</td>
                    <td>65% (85/162)</td>
                    <td>Completed</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="todo-list">
        <h3>Todo list</h3>
        <ul>
            <li>Lorem Ipsum is simply dummy text of the printing - 24 June 2020 (Due tomorrow)</li>
            <li>Lorem Ipsum is simply dummy text of the printing - 23 June 2020 (Done)</li>
            <li>Lorem Ipsum is simply dummy text of the printing - 24 June 2020 (Done)</li>
            <li>Lorem Ipsum is simply dummy text of the printing - 24 June 2020 (Expired)</li>
        </ul>
    </div>
</div>
@endsection