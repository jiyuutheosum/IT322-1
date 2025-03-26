<div class="container mt-4">
    
    <!-- Display Alert Message -->
    <?php
    if(isset($_SESSION['message'])) {
        echo "<script>alert('" . $_SESSION['message'] . "');</script>";
        unset($_SESSION['message']); // Clear message after displaying
    }
    ?>

    <h2 class="mb-3">📊 Student Dashboard</h2>

    <div class="row">
        <!-- Enrolled Courses -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-book"></i> Enrolled Courses
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        
                    </ul>
                </div>
            </div>
        </div>

        <!-- Upcoming Class Schedule -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-calendar-alt"></i> Upcoming Classes
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications & Kaon (Meal Section) -->
    <div class="row">
        <!-- Notifications -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-warning text-dark">
                    <i class="fas fa-bell"></i> Notifications
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>

        <!-- Kaon (Meal Section) -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-utensils"></i> Kaon - Today's Meal
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>

</div>
