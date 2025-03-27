<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow h-full w-full">
    <h2 class="text-xl font-bold mb-4 text-center">Dashboard</h2>

    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Pie Chart: Product Distribution -->
            <div class="bg-white shadow-lg rounded-lg p-4">
                <div class="chart-container">
                    <canvas id="productDistributionChart" height="200"></canvas>
                </div>
            </div>

            <!-- Bar Chart: Top Categories -->
            <div class="bg-white shadow-lg rounded-lg p-4">
                <div class="chart-container">
                    <canvas id="topCategoriesChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Line Chart: Product Growth -->
        <div class="mt-4">
            <div class="bg-white shadow-lg rounded-lg p-4">
                <div class="chart-container">
                    <canvas id="productGrowthChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
// Data dari controller
const productDistributionData = <?= $productCategoryDistribution ?>;
const productGrowthData = <?= $productGrowth ?>;
const topCategoriesData = <?= $topCategories ?>;

/* Pie Chart */
const productDistributionChart = new Chart(
    document.getElementById('productDistributionChart'), {
        type: 'pie',
        data: productDistributionData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Product Distribution by Category'
                },
                legend: {
                    position: 'right'
                },
            }
        }
    }
);

/* Bar Chart */
const topCategoriesChart = new Chart(
    document.getElementById('topCategoriesChart'), {
        type: 'bar',
        data: topCategoriesData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Product Total'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Category Name'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Top 5 Categories'
                },
                legend: {
                    display: false
                }
            },
        }
    }
);

/* Line Chart */
const productGrowthChart = new Chart(
    document.getElementById('productGrowthChart'), {
        type: 'line',
        data: productGrowthData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Product Count'
                    }
                },
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Product Growth (Last 12 Months)'
                }
            }
        }
    }
);
</script>
<?= $this->endSection() ?>