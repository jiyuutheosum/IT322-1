<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="container mt-4">
    <h2>📊 User Dashboard</h2>

    <!-- Enrolled Courses -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-book"></i> Enrolled Courses
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><strong>Mathematics 101</strong> (MATH101)</li>
                <li class="list-group-item"><strong>Computer Science 102</strong> (CS102)</li>
                <li class="list-group-item"><strong>Physics 103</strong> (PHYS103)</li>
            </ul>
        </div>
    </div>

    <!-- Upcoming Class Schedule -->
    <div class="card mb-3">
        <div class="card-header bg-success text-white">
            <i class="fas fa-calendar-alt"></i> Upcoming Classes
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><strong>Mathematics 101</strong> - March 15, 2025 - 10:00 AM</li>
                <li class="list-group-item"><strong>Computer Science 102</strong> - March 16, 2025 - 2:00 PM</li>
                <li class="list-group-item"><strong>Physics 103</strong> - March 17, 2025 - 8:00 AM</li>
            </ul>
        </div>
    </div>

    <!-- Notifications -->
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <i class="fas fa-bell"></i> Notifications
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">📢 Enrollment for Summer 2025 is now open!</li>
                <li class="list-group-item">📢 Your Mathematics 101 class has been rescheduled.</li>
                <li class="list-group-item">📢 Reminder: Physics 103 quiz on March 18, 2025.</li>
            </ul>
        </div>
    </div>
</div>



<?php
include("./includes/footer.php");
?>