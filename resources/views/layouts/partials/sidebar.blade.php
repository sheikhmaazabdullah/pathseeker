<ul class="nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>
    @if (Auth::check() && Auth::user()->role === 'admin')
        <li class="nav-item nav-category">Admin Management</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#adminManagementDropdown" aria-expanded="false" aria-controls="adminManagementDropdown">
                <i class="menu-icon mdi mdi-account"></i>
                <span class="menu-title">User Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="adminManagementDropdown">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users') }}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.add-user') }}">Add User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.usersequests') }}">User Approval Requests</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Content Management</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#contentManagementDropdown" aria-expanded="false" aria-controls="contentManagementDropdown">
                <i class="menu-icon mdi mdi-briefcase"></i>
                <span class="menu-title">Content Options</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="contentManagementDropdown">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.careers') }}">Careers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.add-career') }}">Add Career</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.recommendations') }}">Recommendations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.quizzes') }}">Quizzes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.add-quiz') }}">Add Quiz</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.multimedia') }}">Multimedia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.upload-content') }}">Upload Content</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.success-stories') }}">Success Stories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.feedback') }}">Feedback</a>
                    </li>
                </ul>
            </div>
        </li>
    @else
        <li class="nav-item nav-category">User Options</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#userOptionsDropdown" aria-expanded="false" aria-controls="userOptionsDropdown">
                <i class="menu-icon mdi mdi-account-circle"></i>
                <span class="menu-title">My Account</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="userOptionsDropdown">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('careers') }}">Careers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('quizzes') }}">Quizzes</a>
                    </li>
                </ul>
            </div>
        </li>
    @endif
</ul>