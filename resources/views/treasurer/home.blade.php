<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Church Treasurer Dashboard</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%2322577A'/%3E%3Cpath d='M30 40 L50 25 L70 40 L50 55 Z' fill='%2357CC99'/%3E%3Cpath d='M35 50 L65 50 L65 75 L35 75 Z' fill='%2380ED99'/%3E%3Ctext x='50' y='82' text-anchor='middle' fill='white' font-family='sans-serif' font-size='12' font-weight='bold'%3EA%3C/text%3E%3C/svg%3E">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #22577A 0%, #38A3A5 100%);
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        @media (min-width: 768px) {
            .dashboard-container {
                flex-direction: row;
            }
        }

        .sidebar {
            width: 100%;
            max-width: 280px;
            background: linear-gradient(180deg, #22577A 0%, #38A3A5 100%);
            color: white;
            padding: 2rem 0;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .logo {
            text-align: center;
            padding: 0 2rem 2rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 2rem;
        }

        .logo h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .logo p {
            color: #C7F9CC;
            font-size: 0.9rem;
        }

        .nav-menu {
            list-style: none;
            padding: 0 1rem;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: #80ED99;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
            cursor: pointer;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }

        .nav-link i {
            margin-right: 1rem;
            font-size: 1.1rem;
            width: 20px;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-x: auto;
        }

        @media (max-width: 767px) {
            .main-content {
                padding: 1rem;
            }
        }

        .header {
            background: white;
            padding: 1.5rem 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .header h2 {
            color: #22577A;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .date-time {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .profile-button {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #22577A;
            font-size: 2rem;
            background-color: #ffffff;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: background 0.3s ease;
        }

        .profile-button:hover {
            background-color: #f3f4f6;
        }

        .user-dropdown {
            position: absolute;
            top: 60px;
            right: 0;
            background-color: white;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            width: 180px;
            padding: 0.5rem 0;
            z-index: 1000;
            display: none;
            transition: all 0.3s ease;
        }

        .user-dropdown.show {
            display: block;
        }

        .user-dropdown .dropdown-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #374151;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.2s ease;
        }

        .user-dropdown .dropdown-item i {
            margin-right: 0.5rem;
            font-size: 1rem;
        }

        .user-dropdown .dropdown-item:hover {
            background-color: #f9fafb;
            color: #1f2937;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border-left: 4px solid #38A3A5;
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, rgba(56, 163, 165, 0.1), rgba(87, 204, 153, 0.1));
            border-radius: 50%;
            transform: translate(30px, -30px);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card.income {
            border-left-color: #10b981;
        }

        .stat-card.expense {
            border-left-color: #ef4444;
        }

        .stat-card.savings {
            border-left-color: #3b82f6;
        }

        .stat-card.pledge {
            border-left-color: #8b5cf6;
        }

        .stat-card h3 {
            color: #6b7280;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stat-card .number {
            color: #22577A;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-card .change {
            color: #10b981;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .change.negative {
            color: #ef4444;
        }

        .charts-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 1024px) {
            .charts-section {
                grid-template-columns: 1fr;
            }
        }

        .chart-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: auto;
        }

        .chart-container canvas {
            width: 100% !important;
            height: auto !important;
            max-height: 160px;
        }

        .chart-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .chart-header h3 {
            color: #22577A;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .time-filter {
            display: flex;
            gap: 0.5rem;
        }

        .time-btn {
            padding: 0.5rem 1rem;
            border: 1px solid #e5e7eb;
            background: white;
            color: #6b7280;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.85rem;
        }

        .time-btn.active, .time-btn:hover {
            background: #38A3A5;
            color: white;
            border-color: #38A3A5;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .action-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            text-align: center;
            transition: transform 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .action-card:hover {
            transform: translateY(-3px);
            border-color: #38A3A5;
        }

        .action-card i {
            font-size: 2rem;
            color: #38A3A5;
            margin-bottom: 1rem;
        }

        .action-card h4 {
            color: #22577A;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .action-card p {
            color: #6b7280;
            font-size: 0.85rem;
        }

        .recent-activity {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .activity-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .activity-header h3 {
            color: #22577A;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .view-all {
            color: #38A3A5;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 0.9rem;
        }

        .activity-icon.income {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .activity-icon.expense {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .activity-icon.project {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .activity-details {
            flex: 1;
        }

        .activity-title {
            color: #22577A;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .activity-subtitle {
            color: #6b7280;
            font-size: 0.8rem;
        }

        .activity-amount {
            color: #22577A;
            font-weight: 600;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="logo">
                <h1><i class="fas fa-church"></i> Argent</h1>
                <p>Treasurer Dashboard</p>
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="{{ route('treasurer.home') }}" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.cshflw') }}" class="nav-link"><i class="fas fa-coins"></i> Cash Flow Management</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.reports') }}" class="nav-link"><i class="fas fa-chart-bar"></i> Financial Reports</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.projects') }}" class="nav-link"><i class="fas fa-hammer"></i> Church Projects</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.savings') }}" class="nav-link"><i class="fas fa-piggy-bank"></i> Church Savings</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.pledges') }}" class="nav-link"><i class="fas fa-handshake"></i> Pledges</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.audit') }}" class="nav-link"><i class="fas fa-clipboard-list"></i> Audit Trail</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.donate') }}" class="nav-link"><i class="fas fa-donate"></i> Donation Logs</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <div class="header">
                <div>
                    <h2>Welcome, Treasurer {{ Auth::user()->name }}!</h2>
                    <div class="date-time" id="current-date"></div>
                </div>
                <div class="profile-button" onclick="toggleDropdown()">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="user-dropdown" id="user-dropdown">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>

            <!-- Financial Overview Cards -->
            <div class="stats-grid">
                <div class="stat-card income">
                    <h3><i class="fas fa-arrow-up"></i> Total Income</h3>
                    <div class="number" id="dashboardIncome">₱{{ number_format($totalIncome ?? 0, 2) }}</div>
                </div>
                <div class="stat-card expense">
                    <h3><i class="fas fa-arrow-down"></i> Total Expenses</h3>
                    <div class="number" id="dashboardExpenses">₱{{ number_format($totalExpense ?? 0, 2) }}</div>
                </div>
                <div class="stat-card savings">
                    <h3><i class="fas fa-piggy-bank"></i> Church Savings</h3>
                    <div class="number" id="dashboardSavings">₱{{ number_format($totalSavings ?? 0, 2) }}</div>
                </div>
                <div class="stat-card pledge">
                    <h3><i class="fas fa-handshake"></i> Pending Pledges</h3>
                    <div class="number" id="dashboardPledges">₱{{ number_format($pendingPledges ?? 0, 2) }}</div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-section">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Weekly Income Tracker</h3>
                        <div class="time-filter">
                            <button class="time-btn active" onclick="updateChart('week')">Week</button>
                            <button class="time-btn" onclick="updateChart('month')">Month</button>
                            <button class="time-btn" onclick="updateChart('quarter')">Quarter</button>
                        </div>
                    </div>
                    <canvas id="incomeChart" style="height: 200px !important;"></canvas>
                </div>

                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Expense Categories</h3>
                    </div>
                    <canvas id="expenseChart" width="150px" height="200px"></canvas>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <div class="action-card" onclick="window.location.href='{{ route('treasurer.cshflw') }}';">
                    <i class="fas fa-plus-circle"></i>
                    <h4>New Cash Flow Record</h4>
                    <p>Record income and expenses</p>
                </div>
                <div class="action-card" onclick="window.location.href='{{ route('treasurer.reports') }}';">
                    <i class="fas fa-file-alt"></i>
                    <h4>Generate Report</h4>
                    <p>Create financial summary</p>
                </div>
                <div class="action-card" onclick="window.location.href='{{ route('treasurer.projects') }}';">
                    <i class="fas fa-plus-circle"></i>
                    <h4>Add New Project</h4>
                    <p>Create new project</p>
                </div>
                <div class="action-card" onclick="window.location.href='{{ route('treasurer.pledges') }}';">
                    <i class="fas fa-calendar-plus"></i>
                    <h4>New Pledge</h4>
                    <p>Record pledge commitment</p>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="recent-activity">
                <div class="activity-header">
                    <h3>Recent Financial Activity</h3>
                    <a href="#" class="view-all">View All</a>
                </div>
                <ul class="activity-list">
                    <li class="activity-item">
                        <div class="activity-icon income">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                        <div class="activity-details">
                            <div class="activity-title">Sunday Collection</div>
                            <div class="activity-subtitle">Today, 10:30 AM</div>
                        </div>
                        <div class="activity-amount">+₱12,450</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon expense">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                        <div class="activity-details">
                            <div class="activity-title">Utility Bills Payment</div>
                            <div class="activity-subtitle">Yesterday, 2:15 PM</div>
                        </div>
                        <div class="activity-amount">-₱5,230</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon income">
                            <i class="fas fa-gift"></i>
                        </div>
                        <div class="activity-details">
                            <div class="activity-title">Special Donation</div>
                            <div class="activity-subtitle">June 20, 4:45 PM</div>
                        </div>
                        <div class="activity-amount">+₱25,000</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon project">
                            <i class="fas fa-hammer"></i>
                        </div>
                        <div class="activity-details">
                            <div class="activity-title">Building Renovation Fund</div>
                            <div class="activity-subtitle">June 19, 9:00 AM</div>
                        </div>
                        <div class="activity-amount">-₱15,000</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon income">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <div class="activity-details">
                            <div class="activity-title">Pledge Payment Received</div>
                            <div class="activity-subtitle">June 18, 11:20 AM</div>
                        </div>
                        <div class="activity-amount">+₱8,500</div>
                    </li>
                </ul>
            </div>
        </main>
    </div>
    <script>
        // Format numbers as PHP currency
        function formatCurrency(amount) {
            return new Intl.NumberFormat('en-PH', {
                style: 'currency',
                currency: 'PHP'
            }).format(amount);
        }

        // Update current date and time
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            document.getElementById('current-date').textContent = now.toLocaleDateString('en-US', options);
        }

        function toggleDropdown() {
            const dropdown = document.getElementById('user-dropdown');
            dropdown.classList.toggle('show');
        }

        // Weekly income chart
        let incomeChart;

        async function loadWeeklyIncomeChart() {
            try {
                const response = await fetch("{{ route('treasurer.cashflow.weekly') }}");
                
                if (!response.ok) {
                    throw new Error('Failed to fetch weekly income chart data');
                }

                const chartData = await response.json();

                console.log("Weekly Chart Data Received:", chartData);

                // Validate data
                if (!chartData.labels || !chartData.data || !Array.isArray(chartData.labels) || !Array.isArray(chartData.data)) {
                    console.error("Chart data is invalid:", chartData);
                    return;
                }

                const ctx = document.getElementById('incomeChart');

                if (!ctx) {
                    console.error("Canvas element with ID 'incomeChart' not found.");
                    return;
                }

                const incomeCtx = ctx.getContext('2d');

                incomeChart = new Chart(incomeCtx, {
                    type: 'bar',
                    data: {
                        labels: chartData.labels,
                        datasets: [{
                            label: 'Weekly Income',
                            data: chartData.data,
                            backgroundColor: '#38A3A5',
                            borderRadius: 5,
                            barThickness: 25
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: value => '₱' + value
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: context => `₱${context.parsed.y.toLocaleString()}`
                                }
                            },
                            legend: { display: false }
                        }
                    }
                });

            } catch (error) {
                console.error("Error loading weekly income chart:", error);
            }
        }

        // Load the current church savings and display on dashboard
        async function loadDashboardSavings() {
            try {
                const res = await fetch('{{ route("treasurer.savings.api") }}');
                if (!res.ok) throw new Error('Network response was not ok');
                const data = await res.json();
                const bal = data.balance ?? 0;
                document.getElementById('dashboardSavings').textContent = formatCurrency(bal);
            } catch (err) {
                console.error('Error loading savings:', err);
            }
        }

        // Load the latest cashflow income and expenses
        async function loadCashflowSummary() {
            try {
                const res = await fetch('{{ route("treasurer.cashflow.summary") }}');
                const data = await res.json();

                document.querySelector(".stat-card.income .number").textContent = formatCurrency(data.total_income || 0);
                document.querySelector(".stat-card.expense .number").textContent = formatCurrency(data.total_expenses || 0);
            } catch (err) {
                console.error("Failed to fetch cash flow summary:", err);
            }
        }

        // Main page load
        document.addEventListener('DOMContentLoaded', function () {
            updateDateTime();
            setInterval(updateDateTime, 60000);

            loadCashflowSummary();
            loadDashboardSavings();
            loadWeeklyIncomeChart();
        });

        function openModal(type) {
            alert(`Opening ${type} modal - This would open a form to add new ${type} record`);
        }

        function generateReport() {
            alert('Generating financial report - This would create a comprehensive financial summary');
        }

        // Navigation functionality
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function (e) {
                const href = this.getAttribute('href');

                if (!href || href === '#' || href.startsWith('javascript:')) {
                    e.preventDefault();
                    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                    const section = this.dataset.section;
                    console.log(`Navigating to ${section} section`);
                    return;
                }

                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>