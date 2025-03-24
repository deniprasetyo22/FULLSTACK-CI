<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
Student Dashboard
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow rounded-lg h-full">
    <!-- Dashboard Content -->
    <h1 class="text-2xl font-bold text-gray-800">Welcome to Student Dashboard, <?= user()->username ?></h1>
    <p class="text-gray-600">Manage your site from this central dashboard.</p>
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Pie Chart: Credit distribution by grade -->
            <div class="bg-white shadow-lg rounded-lg p-4">
                <div class="chart-container">
                    <canvas id="gradeChart" height="200"></canvas>
                </div>
            </div>

            <!-- Bar Chart: Credits taken vs. credits required -->
            <div class="bg-white shadow-lg rounded-lg p-4">
                <div class="chart-container">
                    <canvas id="creditChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Line Chart: GPA per Semester -->
        <div class="mt-4">
            <div class="bg-white shadow-lg rounded-lg p-4">
                <div class="chart-container">
                    <canvas id="gpaChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
// Data dari controller
const creditsByGrade = <?= $creditsByGrade ?>;
const creditComparison = <?= $creditComparison ?>;
const gpaData = <?= $gpaData ?>;

/* Pie Chart */
const gradeChart = new Chart(
    document.getElementById('gradeChart'), {
        type: 'pie',
        data: creditsByGrade,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Credit Distribution by Grade'
                },
                legend: {
                    position: 'right'
                }
            }
        }
    }
);

/* Bar Chart */
const creditChart = new Chart(
    document.getElementById('creditChart'), {
        type: 'bar',
        data: creditComparison,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Credits'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Semester'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Credits Taken vs. Credits Required by Semester'
                }
            }
        }
    }
);

/* Line Chart */
const gpaChart = new Chart(
    document.getElementById('gpaChart'), {
        type: 'line',
        data: gpaData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    min: 0,
                    max: 4,
                    title: {
                        display: true,
                        text: 'GPA'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Semester'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Academic Progress (GPA per Semester)'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `GPA: ${context.raw}`;
                        }
                    }
                }
            }
        }
    }
);
</script>

<?= $this->endSection() ?>