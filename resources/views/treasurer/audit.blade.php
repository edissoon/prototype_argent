<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treasurer Audit Trail System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%2322577A'/%3E%3Cpath d='M30 40 L50 25 L70 40 L50 55 Z' fill='%2357CC99'/%3E%3Cpath d='M35 50 L65 50 L65 75 L35 75 Z' fill='%2380ED99'/%3E%3Ctext x='50' y='82' text-anchor='middle' fill='white' font-family='sans-serif' font-size='12' font-weight='bold'%3EA%3C/text%3E%3C/svg%3E">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        /* Sidebar styles */
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

        /* Main content */
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

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, #38A3A5, #57CC99);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(56, 163, 165, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
        }

        /* Status Cards */
        .status-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .status-card {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            text-align: center;
        }

        .status-card i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .status-card h3 {
            color: #22577A;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .status-card p {
            color: #6b7280;
            font-weight: 500;
        }

        .card-online {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .card-online i, .card-online h3, .card-online p {
            color: white;
        }

        /* Audit Trail Table */
        .audit-section {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .section-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .section-title {
            color: #22577A;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .filter-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-select {
            padding: 0.5rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .table-container {
            overflow-x: auto;
        }

        .audit-table {
            width: 100%;
            border-collapse: collapse;
        }

        .audit-table th {
            background: #f8fafc;
            color: #22577A;
            font-weight: 600;
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .audit-table td {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .audit-table tr:hover {
            background: #f8fafc;
        }

        .activity-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .activity-login {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .activity-logout {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .activity-page {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .activity-action {
            background: rgba(168, 85, 247, 0.1);
            color: #a855f7;
        }

        .timestamp {
            color: #6b7280;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .session-info {
            color: #6b7280;
            font-size: 0.8rem;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: #22577A;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .status-cards {
                grid-template-columns: 1fr;
            }
            
            .filter-controls {
                width: 100%;
                justify-content: center;
            }

            .audit-table th,
            .audit-table td {
                padding: 0.75rem 0.5rem;
                font-size: 0.8rem;
            }
        }

        .user-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #10b981;
            font-weight: 500;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="logo">
                <h1><i class="fas fa-church"></i> Church Finance</h1>
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
                    <h2 id="page-title">Audit Trail Dashboard</h2>
                </div>
                <div class="header-actions">
                    <button class="btn-primary" onclick="exportAuditLog()">
                        <i class="fas fa-download"></i>
                        Export Log
                    </button>
                </div>
            </div>

            <!-- Audit Trail Section -->
            <div class="audit-section">
                <div class="section-header">
                    <h3 class="section-title">Activity Log</h3>
                    <div class="filter-controls">
                        <select class="filter-select" id="dateFilter" onchange="filterAuditLog()">
                            <option value="today">Today</option>
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                            <option value="all">All Time</option>
                        </select>
                        <select class="filter-select" id="activityFilter" onchange="filterAuditLog()">
                            <option value="all">All Activities</option>
                            <option value="login">Login/Logout</option>
                            <option value="page">Page Visits</option>
                            <option value="action">Actions</option>
                        </select>
                    </div>
                </div>
                <div class="table-container">
                    <table class="audit-table">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Activity Type</th>
                                <th>Description</th>
                                <th>Page/Section</th>
                                <th>Session ID</th>
                                <th>IP Address</th>
                            </tr>
                        </thead>
                        <tbody id="audit-table-body">
                            <!-- Audit entries will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        let auditDatabase = [];
        let currentSession = {
            sessionId: generateSessionId(),
            userId: 'treasurer_001',
            userName: 'Juan Dela Cruz',
            loginTime: new Date(),
            ipAddress: '192.168.1.100',
            userAgent: navigator.userAgent
        };

        // Get CSRF token for Laravel
        function getCSRFToken() {
            return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                document.querySelector('input[name="_token"]')?.value;
        }

        // Initialize the system
        document.addEventListener('DOMContentLoaded', function() {
            // Record login activity
            logActivity('LOGIN', 'User logged in to the system', 'Login Page');
            
            // Load initial audit data
            loadAuditData();
            
            // Set up navigation tracking
            setupNavigationTracking();
            
            // Set up real-time updates every 5 seconds
            setInterval(loadAuditData, 5000);
            
            // Set up periodic activity logging every 30 seconds
            setInterval(logPeriodicActivity, 30000);
        });

        // Generate unique session ID
        function generateSessionId() {
            return 'SES_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
        }

        // Log activity to database
        function logActivity(type, description, page, additionalData = {}) {
            const activity = {
                session_id: currentSession.sessionId,
                user_id: currentSession.userId,
                user_name: currentSession.userName,
                activity_type: type,
                description: description,
                page: page,
                ip_address: currentSession.ipAddress,
                user_agent: currentSession.userAgent,
                ...additionalData
            };

            fetch('/api/audit-logs', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCSRFToken()
                },
                body: JSON.stringify(activity)
            })
            .then(response => response.json())
            .then(data => {
                console.log('Activity logged:', data);
                // Refresh data after logging
                setTimeout(loadAuditData, 500);
            })
            .catch(error => {
                console.error('Error saving audit log:', error);
            });
        }

        // Load audit data from server
        function loadAuditData() {
            fetch('/api/audit-logs')
                .then(response => response.json())
                .then(data => {
                    auditDatabase = data;
                    updateAuditTable();
                    updateStats();
                })
                .catch(error => {
                    console.error('Error loading audit logs:', error);
                });
        }

        // Update audit table
        function updateAuditTable() {
            const tbody = document.getElementById('audit-table-body');
            const dateFilter = document.getElementById('dateFilter').value;
            const activityFilter = document.getElementById('activityFilter').value;
            
            let filteredData = auditDatabase.slice();
            
            // Apply date filter
            const now = new Date();
            switch(dateFilter) {
                case 'today':
                    filteredData = filteredData.filter(item => {
                        const itemDate = new Date(item.timestamp);
                        return itemDate.toDateString() === now.toDateString();
                    });
                    break;
                case 'week':
                    const weekAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
                    filteredData = filteredData.filter(item => new Date(item.timestamp) >= weekAgo);
                    break;
                case 'month':
                    const monthAgo = new Date(now.getTime() - 30 * 24 * 60 * 60 * 1000);
                    filteredData = filteredData.filter(item => new Date(item.timestamp) >= monthAgo);
                    break;
            }
            
            // Apply activity filter
            if (activityFilter !== 'all') {
                switch(activityFilter) {
                    case 'login':
                        filteredData = filteredData.filter(item => 
                            item.activity_type === 'LOGIN' || item.activity_type === 'LOGOUT'
                        );
                        break;
                    case 'page':
                        filteredData = filteredData.filter(item => item.activity_type === 'PAGE_VISIT');
                        break;
                    case 'action':
                        filteredData = filteredData.filter(item => 
                            item.activity_type === 'ACTION' || item.activity_type === 'ACTIVITY'
                        );
                        break;
                }
            }
            
            // Clear existing rows
            tbody.innerHTML = '';
            
            if (filteredData.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="fas fa-search"></i>
                            <h3>No activities found</h3>
                            <p>No activities match your current filters.</p>
                        </td>
                    </tr>
                `;
                return;
            }
            
            // Add rows (limit to 50 for performance)
            filteredData.slice(0, 50).forEach(activity => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <div class="timestamp">${formatTimestamp(activity.timestamp)}</div>
                    </td>
                    <td>
                        <span class="activity-badge ${getBadgeClass(activity.activity_type)}">
                            ${activity.activity_type.replace('_', ' ')}
                        </span>
                    </td>
                    <td>${activity.description}</td>
                    <td>${activity.page}</td>
                    <td>
                        <div class="session-info">${activity.session_id.substring(0, 12)}...</div>
                    </td>
                    <td>
                        <div class="session-info">${activity.ip_address}</div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Format timestamp
        function formatTimestamp(timestamp) {
            const date = new Date(timestamp);
            const today = new Date();
            const isToday = date.toDateString() === today.toDateString();
            
            if (isToday) {
                return date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit', second:'2-digit'});
            } else {
                return date.toLocaleString([], {
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }
        }

        // Get badge class for activity type
        function getBadgeClass(type) {
            switch(type) {
                case 'LOGIN': return 'activity-login';
                case 'LOGOUT': return 'activity-logout';
                case 'PAGE_VISIT': return 'activity-page';
                default: return 'activity-action';
            }
        }

        // Setup navigation tracking
        function setupNavigationTracking() {
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href && href !== '#') {
                        const pageName = this.textContent.trim();
                        logActivity('PAGE_VISIT', `Navigated to ${pageName} page`, pageName);
                    }
                });
            });
        }

        // Log periodic activity
        function logPeriodicActivity() {
            if (document.hasFocus()) {
                logActivity('ACTIVITY', 'User active on system', getCurrentPage());
            }
        }

        // Get current page
        function getCurrentPage() {
            const activeLink = document.querySelector('.nav-link.active');
            return activeLink ? activeLink.textContent.trim() : 'Audit Trail';
        }

        // Update statistics
        function updateStats() {
            const today = new Date();
            const todayActivities = auditDatabase.filter(item => {
                const itemDate = new Date(item.timestamp);
                return itemDate.toDateString() === today.toDateString();
            });
            
            // Update if elements exist
            const totalElement = document.getElementById('total-activities');
            if (totalElement) {
                totalElement.textContent = todayActivities.length;
            }
            
            const thisMonth = auditDatabase.filter(item => {
                const itemDate = new Date(item.timestamp);
                return itemDate.getMonth() === today.getMonth() && 
                    itemDate.getFullYear() === today.getFullYear();
            });
            
            const uniqueDays = new Set(thisMonth.map(item => {
                const date = new Date(item.timestamp);
                return date.toDateString();
            }));
            
            const daysElement = document.getElementById('days-active');
            if (daysElement) {
                daysElement.textContent = uniqueDays.size;
            }
        }

        // Filter audit log
        function filterAuditLog() {
            updateAuditTable();
        }

        // Export audit log
        function exportAuditLog() {
            logActivity('ACTION', 'Exported audit log to CSV', getCurrentPage());
            
            const headers = ['Timestamp', 'Activity Type', 'Description', 'Page', 'Session ID', 'IP Address'];
            const csvContent = [
                headers.join(','),
                ...auditDatabase.map(activity => [
                    new Date(activity.timestamp).toLocaleString(),
                    activity.activity_type,
                    `"${activity.description}"`,
                    activity.page,
                    activity.session_id,
                    activity.ip_address
                ].join(','))
            ].join('\n');
            
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `audit_log_${new Date().toISOString().split('T')[0]}.csv`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        }

        // Track window close/refresh
        window.addEventListener('beforeunload', function() {
            logActivity('LOGOUT', 'User session ended (browser closed/refreshed)', getCurrentPage());
        });
    </script>
</body>
</html>