<div class="container-fluid px-4">

    <!-- Display alert message -->
    <?php
    if(isset($_SESSION['message'])) {
        echo "<script>alert('" . $_SESSION['message'] . "');</script>";
        unset($_SESSION['message']); // Remove message after showing
    }
    ?>

    <h1 class="mt-4">Admin Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Overview of Enrollment System</li>
    </ol>

    <!-- Dashboard Summary Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Students</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Pending Enrollments</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Active Courses</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Unpaid Balances</div>
            </div>
        </div>
    </div>

    <!-- Enrollment Statistics Graph -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-chart-line me-1"></i> Enrollment Trends</div>
                <div class="card-body">
                    <canvas id="enrollmentChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-history me-1"></i> Recent Activities</div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('enrollmentChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Enrolled Students',
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderWidth: 2
            }]
        }
    });
</script>
