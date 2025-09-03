<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Argent Admin Dashboard</title>
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%2322577A'/%3E%3Cpath d='M30 40 L50 25 L70 40 L50 55 Z' fill='%2357CC99'/%3E%3Cpath d='M35 50 L65 50 L65 75 L35 75 Z' fill='%2380ED99'/%3E%3Ctext x='50' y='82' text-anchor='middle' fill='white' font-family='sans-serif' font-size='12' font-weight='bold'%3EA%3C/text%3E%3C/svg%3E">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

            .user-info {
                display: flex;
                align-items: center;
                gap: 1rem;
                position: relative;
            }

            .user-avatar {
                width: 40px;
                height: 40px;
                background: linear-gradient(45deg, #57CC99, #38A3A5);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: 600;
                cursor: pointer;
            }

            .user-dropdown {
                position: absolute;
                top: 100%;
                right: 0;
                background: white;
                border-radius: 8px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.15);
                min-width: 200px;
                z-index: 1000;
                display: none;
                overflow: hidden;
            }

            .user-dropdown.show {
                display: block;
            }

            .dropdown-item {
                display: block;
                padding: 0.75rem 1rem;
                color: #374151;
                text-decoration: none;
                transition: background-color 0.2s;
                border-bottom: 1px solid #f3f4f6;
            }

            .dropdown-item:hover {
                background-color: #f9fafb;
            }

            .dropdown-item:last-child {
                border-bottom: none;
            }

            .dropdown-item i {
                margin-right: 0.5rem;
                width: 16px;
            }

            .stat-card {
                background: white;
                padding: 2rem;
                border-radius: 16px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.08);
                border-left: 4px solid #38A3A5;
                transition: transform 0.3s ease;
                margin-bottom: 1rem;
            }

            .stat-card:hover {
                transform: translateY(-5px);
            }

            .stat-card h3 {
                color: #6b7280;
                font-size: 0.9rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 0.5rem;
            }

            .stat-card .number {
                color: #22577A;
                font-size: 2rem;
                font-weight: 700;
                margin-bottom: 0.5rem;
            }

            .stat-card .change {
                color: #38A3A5;
                font-size: 0.9rem;
                font-weight: 500;
            }

            .btn {
                padding: 0.75rem 1.5rem;
                background: linear-gradient(45deg, #38A3A5, #57CC99);
                color: white;
                border: none;
                border-radius: 8px;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            }

            .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(56, 163, 165, 0.3);
            }

            .btn-small {
                padding: 0.5rem 0.75rem;
                font-size: 0.8rem;
            }

            .btn-danger {
                background: linear-gradient(45deg, #ef4444, #dc2626);
            }

            .btn-danger:hover {
                box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
            }

            .search-input:focus,
            .form-group input:focus,
            .form-group select:focus {
                outline: none;
                border-color: #38A3A5;
            }

            .modal-header h3,
            .form-group label,
            .table-header h3 {
                color: #22577A;
            }

            .status-active {
                background: #C7F9CC;
                color: #22577A;
                padding: 0.25rem 0.75rem;
                border-radius: 1rem;
                font-size: 0.85rem;
            }

            .status-inactive {
                background: #fee2e2;
                color: #dc2626;
                padding: 0.25rem 0.75rem;
                border-radius: 1rem;
                font-size: 0.85rem;
            }

            .status-login {
                background: #e0f7f7;
                color: #38A3A5;
                padding: 0.25rem 0.75rem;
                border-radius: 1rem;
                font-size: 0.85rem;
            }

            .status-logout {
                background: #fef3c7;
                color: #d97706;
                padding: 0.25rem 0.75rem;
                border-radius: 1rem;
                font-size: 0.85rem;
            }

            .data-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 1rem;
                background: white;
                border-radius: 12px;
                overflow: hidden;
            }

            .data-table th, .data-table td {
                padding: 1rem;
                text-align: left;
            }

            .data-table th {
                background: #f8fafc;
                color: #22577A;
                font-size: 0.9rem;
            }

            .table-header h2 {
                color: rgb(248, 248, 248);
                font-size: 1.5rem;
            }

            .data-table td {
                border-top: 1px solid #f0f0f0;
                font-size: 0.9rem;
            }

            .data-table-container {
                margin-top: 2rem;
            }

            .table-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .search-box {
                display: flex;
                gap: 0.5rem;
                flex-wrap: wrap;
            }

            .search-input {
                padding: 0.5rem 1rem;
                border-radius: 8px;
                border: 1px solid #ccc;
                font-size: 0.9rem;
            }

            .form-group {
                margin-bottom: 1rem;
            }

            .form-group label {
                display: block;
                margin-bottom: 0.5rem;
            }

            .form-group input,
            .form-group select {
                width: 100%;
                padding: 0.5rem;
                border: 1px solid #ccc;
                border-radius: 8px;
            }

            .modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.4);
                justify-content: center;
                align-items: center;
                z-index: 1000;
            }

            .modal-content {
                background: white;
                padding: 2rem;
                border-radius: 12px;
                width: 100%;
                max-width: 500px;
                box-shadow: 0 8px 20px rgba(0,0,0,0.2);
                position: relative;
            }

            .modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1rem;
            }

            .modal-header .close {
                cursor: pointer;
                font-size: 1.5rem;
                color: #999;
            }

            .action-buttons button {
                margin-right: 0.5rem;
            }

            .content-section {
                display: none;
            }

            .content-section.active {
                display: block;
            }

            .stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 1rem;
            }
        </style>
    </head>
    <body>
        <div class="dashboard-container">
            <!-- Sidebar -->
            <nav class="sidebar">
            <div class="logo">
                <h1><i class="fas fa-church"></i> Argent</h1>
                <p>Admin Dashboard</p>
            </div>                
            <ul class="nav-menu">
                    <li class="nav-item"><a href="{{ route('admin.home') }}" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="nav-item"><a href="{{ route('admin.useraccess') }}" class="nav-link"><i class="fas fa-users"></i> User Accesss Control</a></li>
                    <li class="nav-item"><a href="{{ route('admin.userlogs') }}" class="nav-link"><i class="fas fa-history"></i> User Logs</a></li>
            </ul>
            </nav>

            <!-- Main Content -->
            <main class="main-content">
                <div class="header">
                    <div>
                        <h2>User Logs</h2>
                        <div class="date-time" id="current-date"></div>
                    </div>
                </div>

            </main>
        </div>
        <script>
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
            
            // Initialize date/time and update every minute
            updateDateTime();
            setInterval(updateDateTime, 60000);
            
            // Navigation
            function showSection(sectionId) {
                // Hide all sections
                document.querySelectorAll('.content-section').forEach(section => {
                    section.classList.remove('active');
                });
                
                // Show selected section
                document.getElementById(sectionId).classList.add('active');
                
                // Update nav links
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.classList.remove('active');
                });
                event.target.closest('.nav-link').classList.add('active');
                
                // Update page title
                const titles = {
                    'user-access': 'Admin Dashboard - User Access Management',
                    'user-logs': 'Admin Dashboard - User Activity Logs'
                };
                document.getElementById('page-title').textContent = titles[sectionId];
            }

            // User dropdown functionality
            function toggleUserDropdown() {
                const dropdown = document.getElementById('user-dropdown');
                dropdown.classList.toggle('show');
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                const userInfo = document.querySelector('.user-info');
                const dropdown = document.getElementById('user-dropdown');
                
                if (!userInfo.contains(event.target)) {
                    dropdown.classList.remove('show');
                }
            });

            // Logout functionality
            function logout() {
                if (confirm('Are you sure you want to logout?')) {
                    alert('Logging out...');
                    window.location.href = '/login';
                }
            }
        </script>
    </body>
    </html>