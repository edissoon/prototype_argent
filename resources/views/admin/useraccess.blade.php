<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Argent Admin Dashboard - User Access Control</title>
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border-left: 4px solid #38A3A5;
            transition: transform 0.3s ease;
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

        .btn-warning {
            background: linear-gradient(45deg, #f59e0b, #d97706);
        }

        .btn-warning:hover {
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        .data-table-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .table-header h3 {
            color: #22577A;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .search-box {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .search-input {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 0.9rem;
            min-width: 200px;
        }

        .search-input:focus {
            outline: none;
            border-color: #38A3A5;
            box-shadow: 0 0 0 3px rgba(56, 163, 165, 0.1);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .data-table th {
            background: #f8fafc;
            color: #22577A;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-table td {
            font-size: 0.9rem;
            color: #374151;
        }

        .data-table tbody tr:hover {
            background-color: #f9fafb;
        }

        .status-active {
            background: #C7F9CC;
            color: #22577A;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-inactive {
            background: #fee2e2;
            color: #dc2626;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .role-admin {
            background: #fef3c7;
            color: #d97706;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .role-member {
            background: #e0f7f7;
            color: #38A3A5;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-header h3 {
            color: #22577A;
            font-size: 1.4rem;
            font-weight: 600;
        }

        .close {
            cursor: pointer;
            font-size: 1.5rem;
            color: #6b7280;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .close:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #22577A;
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #38A3A5;
            box-shadow: 0 0 0 3px rgba(56, 163, 165, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 576px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: none;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .alert.show {
            display: block;
        }

        .no-data {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
        }

        .no-data i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #d1d5db;
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
                    <h2>User Access Control</h2>
                    <div class="date-time" id="current-date"></div>
                </div>
            </div>

            <!-- Alert Messages -->
            <div id="alert-success" class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span id="success-message"></span>
            </div>
            <div id="alert-error" class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                <span id="error-message"></span>
            </div>

            <!-- User Management Table -->
            <div class="data-table-container">
                <div class="table-header">
                    <h3>User Management</h3>
                    <div class="search-box">
                        <input type="text" 
                               class="search-input" 
                               id="search-users" 
                               placeholder="Search users..."
                               onkeyup="filterUsers()">
                        <button class="btn" onclick="openAddUserModal()">
                            <i class="fas fa-plus"></i> Add New User
                        </button>
                    </div>
                </div>
                
                <div id="table-content">
                    <table class="data-table" id="users-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Custom ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Phone</th>
                                <th>Ministry</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="users-tbody">
                            <!-- Users will be populated here -->
                        </tbody>
                    </table>
                    
                    <div id="no-users" class="no-data" style="display: none;">
                        <i class="fas fa-users"></i>
                        <h3>No users found</h3>
                        <p>Start by adding your first user to the system</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Add/Edit User Modal -->
    <div id="user-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title">Add New User</h3>
                <span class="close" onclick="closeUserModal()">&times;</span>
            </div>
            <form id="user-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="user-custom-id">Custom ID</label>
                        <input type="text" id="user-custom-id" name="custom_id" placeholder="Enter custom ID" required>
                    </div>
                    <div class="form-group">
                        <label for="user-name">Full Name</label>
                        <input type="text" id="user-name" name="name" placeholder="Enter full name" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="user-email">Email Address</label>
                    <input type="email" id="user-email" name="email" placeholder="Enter email address" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="user-phone">Phone Number</label>
                        <input type="tel" id="user-phone" name="phone" placeholder="Enter phone number" required>
                    </div>
                    <div class="form-group">
                        <label for="user-role">Role</label>
                        <select id="user-role" name="role" required>
                            <option value="">Select role</option>
                            <option value="admin">Administrator</option>
                            <option value="member">Member</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="user-address">Address</label>
                    <input type="text" id="user-address" name="address" placeholder="Enter complete address" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="user-ministry">Ministry</label>
                        <select id="user-ministry" name="ministry" required>
                            <option value="">Select ministry</option>
                            <option value="youth">Youth Ministry</option>
                            <option value="worship">Worship Team</option>
                            <option value="children">Children's Ministry</option>
                            <option value="none">None</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user-status">Status</label>
                        <select id="user-status" name="status" required>
                            <option value="">Select status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                
                <div id="password-fields" class="form-row">
                    <div class="form-group">
                        <label for="user-password">Password</label>
                        <input type="password" id="user-password" name="password" placeholder="Enter password" minlength="8">
                    </div>
                    <div class="form-group">
                        <label for="user-password-confirm">Confirm Password</label>
                        <input type="password" id="user-password-confirm" name="password_confirmation" placeholder="Confirm password">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeUserModal()">Cancel</button>
                    <button type="submit" class="btn" id="submit-user-btn">
                        <i class="fas fa-save"></i> Save User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="modal">
        <div class="modal-content" style="max-width: 400px;">
            <div class="modal-header">
                <h3>Confirm Deletion</h3>
                <span class="close" onclick="closeDeleteModal()">&times;</span>
            </div>
            <p style="margin-bottom: 1.5rem; color: #374151;">
                Are you sure you want to delete this user? This action cannot be undone.
            </p>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeDeleteModal()">Cancel</button>
                <button type="button" class="btn-danger" onclick="confirmDelete()">
                    <i class="fas fa-trash"></i> Delete User
                </button>
            </div>
        </div>
    </div>

    <script>
        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            updateDateTime();
            setInterval(updateDateTime, 60000);
            updateStats();
            renderUsersTable();
        });

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

        // Update statistics
        function updateStats() {
            const totalUsers = users.length;
            const activeUsers = users.filter(user => user.status === 'active').length;
            const adminCount = users.filter(user => user.role === 'admin').length;
            const memberCount = users.filter(user => user.role === 'member').length;

            document.getElementById('total-users').textContent = totalUsers;
            document.getElementById('active-users').textContent = activeUsers;
            document.getElementById('admin-count').textContent = adminCount;
            document.getElementById('member-count').textContent = memberCount;
        }

        // Render users table
        function renderUsersTable() {
            const tbody = document.getElementById('users-tbody');
            const noUsersDiv = document.getElementById('no-users');
            
            if (users.length === 0) {
                tbody.innerHTML = '';
                noUsersDiv.style.display = 'block';
                return;
            }
            
            noUsersDiv.style.display = 'none';
            
            tbody.innerHTML = users.map(user => `
                <tr>
                    <td>${user.id}</td>
                    <td>${user.custom_id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td><span class="role-${user.role}">${user.role.charAt(0).toUpperCase() + user.role.slice(1)}</span></td>
                    <td>${user.phone}</td>
                    <td>${user.ministry.charAt(0).toUpperCase() + user.ministry.slice(1)}</td>
                    <td><span class="status-${user.status}">${user.status.charAt(0).toUpperCase() + user.status.slice(1)}</span></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-small" onclick="editUser(${user.id})" title="Edit User">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-small btn-warning" onclick="toggleUserStatus(${user.id})" title="${user.status === 'active' ? 'Deactivate' : 'Activate'} User">
                                <i class="fas fa-${user.status === 'active' ? 'user-times' : 'user-check'}"></i>
                            </button>
                            <button class="btn btn-small btn-danger" onclick="openDeleteModal(${user.id})" title="Delete User">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        // Filter users based on search
        function filterUsers() {
            const searchTerm = document.getElementById('search-users').value.toLowerCase();
            const filteredUsers = users.filter(user => 
                user.name.toLowerCase().includes(searchTerm) ||
                user.email.toLowerCase().includes(searchTerm) ||
                user.custom_id.toLowerCase().includes(searchTerm) ||
                user.role.toLowerCase().includes(searchTerm) ||
                user.ministry.toLowerCase().includes(searchTerm)
            );
            
            const tbody = document.getElementById('users-tbody');
            const noUsersDiv = document.getElementById('no-users');
            
            if (filteredUsers.length === 0) {
                tbody.innerHTML = '';
                noUsersDiv.style.display = 'block';
                noUsersDiv.innerHTML = `
                    <i class="fas fa-search"></i>
                    <h3>No users found</h3>
                    <p>No users match your search criteria</p>
                `;
                return;
            }
            
            noUsersDiv.style.display = 'none';
            
            tbody.innerHTML = filteredUsers.map(user => `
                <tr>
                    <td>${user.id}</td>
                    <td>${user.custom_id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td><span class="role-${user.role}">${user.role.charAt(0).toUpperCase() + user.role.slice(1)}</span></td>
                    <td>${user.phone}</td>
                    <td>${user.ministry.charAt(0).toUpperCase() + user.ministry.slice(1)}</td>
                    <td><span class="status-${user.status}">${user.status.charAt(0).toUpperCase() + user.status.slice(1)}</span></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-small" onclick="editUser(${user.id})" title="Edit User">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-small btn-warning" onclick="toggleUserStatus(${user.id})" title="${user.status === 'active' ? 'Deactivate' : 'Activate'} User">
                                <i class="fas fa-${user.status === 'active' ? 'user-times' : 'user-check'}"></i>
                            </button>
                            <button class="btn btn-small btn-danger" onclick="openDeleteModal(${user.id})" title="Delete User">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }
    </script>
</body>
</html>