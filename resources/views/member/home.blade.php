<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard - Our Church</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%2322577A'/%3E%3Cpath d='M30 40 L50 25 L70 40 L50 55 Z' fill='%2357CC99'/%3E%3Cpath d='M35 50 L65 50 L65 75 L35 75 Z' fill='%2380ED99'/%3E%3Ctext x='50' y='82' text-anchor='middle' fill='white' font-family='sans-serif' font-size='12' font-weight='bold'%3EA%3C/text%3E%3C/svg%3E">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        :root {
            --primary: #22577A;
            --accent: #38A3A5;
            --mint: #57CC99;
            --light-green: #80ED99;
            --pale-green: #C7F9CC;
            --error: #b00020;
            --light-red: #ffe0e0;
            --pink: #ffb3b3;
            --success-bg: #c7f9cc;
            --success-text: #2f855a;
            --info-bg: #e6fffa;
            --info-border: #81e6d9;
            --info-text: #2c7a7b;
            --info-icon: #4fd1c7;
            --input-bg: #f8fafc;
            --white: #ffffff;
            --background: #f8fafc;
            --surface: #ffffff;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border: #e5e7eb;
            --success: #57CC99;
            --warning: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--background);
            color: var(--text-primary);
            line-height: 1.6;
        }

        .header {
            background: var(--surface);
            padding: 1.5rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--text-secondary);
            position: relative;
        }

        .profile-dropdown {
            position: relative;
        }

        .profile-trigger {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: var(--pale-green);
            border: 1px solid var(--mint);
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--primary);
            font-weight: 500;
        }

        .profile-trigger:hover {
            background: var(--mint);
            color: white;
        }

        .profile-icon {
            width: 30px;
            height: 30px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .dropdown-arrow {
            font-size: 0.8rem;
            transition: transform 0.3s ease;
        }

        .profile-trigger.active .dropdown-arrow {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            color: var(--text-primary);
            text-decoration: none;
        }

        .dropdown-item:hover {
            background: var(--pale-green);
        }

        .dropdown-item:first-child {
            border-radius: 10px 10px 0 0;
        }

        .dropdown-item:last-child {
            border-radius: 0 0 10px 10px;
            border-top: 1px solid var(--border);
            color: var(--error);
        }

        .dropdown-item:last-child:hover {
            background: var(--light-red);
        }

        .dropdown-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .profile-modal.show {
            opacity: 1;
            visibility: visible;
        }

        .profile-modal-content {
            background: var(--white);
            border-radius: 15px;
            padding: 2rem;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .profile-modal.show .profile-modal-content {
            transform: scale(1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-secondary);
            padding: 0.5rem;
            border-radius: 500px;
            transition: background-color 0.3s ease;
        }

        .modal-close:hover {
            background:rgb(190, 190, 190);
            border-radius: 500px;
        }

        .dashboard {
            padding: 2rem 0;
        }

        .welcome-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                        url('/img/banner.png') center/cover no-repeat;
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .welcome-section:hover {
            transform: scale(1.01);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }

        .welcome-section h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            animation: fadeInDown 1s ease;
        }

        .welcome-section p {
            font-size: 1.1rem;
            animation: fadeInUp 1s ease;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--surface);
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .charts-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .chart-card {
            background: var(--surface);
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .chart-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        /* Add these styles to your existing <style> tag */
        .projects-section {
            background: var(--surface);
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary);
            text-align: center;
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .project-card {
            background: var(--background);
            padding: 1.5rem;
            border-radius: 10px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }

        .project-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .project-placeholder {
            width: 100%;
            height: 200px;
            background-color: var(--border);
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--text-secondary);
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .project-content {
            display: flex;
            flex-direction: column;
        }

        .project-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }

        .project-description {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin-bottom: 1rem;
        }

        .project-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .project-status {
            background: var(--mint);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .project-progress {
            margin-top: auto;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .progress-amount {
            font-weight: bold;
            color: var(--primary);
        }

        .progress-target {
            font-weight: normal;
        }

        .progress-bar {
            background: var(--border);
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .progress-fill {
            height: 100%;
            background: var(--accent);
            border-radius: 4px;
            transition: width 0.4s ease-in-out;
        }

        .progress-percent {
            text-align: right;
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .btn-donate {
            display: inline-block;
            width: 100%;
            text-align: center;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            padding: 0.75rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-donate:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .empty-state {
            grid-column: 1/-1;
            text-align: center;
            padding: 3rem;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: var(--border);
        }

        .empty-state h3 {
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }    

        .donation-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .qr-section {
            background: var(--surface);
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .qr-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            justify-content: center;
        }

        .qr-tab {
            padding: 0.75rem 1.5rem;
            border: 2px solid var(--border);
            background: var(--background);
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .qr-tab.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .qr-code {
            width: 200px;
            height: 200px;
            background: var(--border);
            margin: 0 auto 1rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
        }

        .form-section {
            background: var(--surface);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease;
            width: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
        }

        .pledge-reminder {
            background: var(--surface);
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .my-donations {
            background: var(--surface);
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .donations-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .donations-table th,
        .donations-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .donations-table th {
            background: var(--background);
            font-weight: 600;
            color: var(--text-primary);
        }

        .profile-section {
            background: var(--surface);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .info-box {
            background: var(--info-bg);
            padding: 1.5rem;
            border-radius: 10px;
            border-left: 4px solid var(--info-icon);
            margin-bottom: 2rem;
        }

        .info-box h4 {
            color: var(--info-text);
            margin-bottom: 0.5rem;
        }

        .info-box ol {
            color: var(--info-text);
            padding-left: 1rem;
            text-align: left;
        }

        @media (max-width: 768px) {
            .charts-section {
                grid-template-columns: 1fr;
            }
            
            .donation-section {
                grid-template-columns: 1fr;
            }
            
            .profile-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">⛪ Argent</div>
                <div class="user-info">
                    <div class="profile-dropdown">
                        <!-- modify to na dapat kung sinong user ang nakalogin, yung name non yung makukuha -->
                        <div class="profile-trigger" onclick="toggleDropdown()">
                            @php
                                $user = Auth::user();
                            @endphp
                            <div class="profile-icon">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                            <span>{{ $user->name }}</span>
                        </div>
                        <div class="dropdown-menu" id="profileDropdown">
                            <div class="dropdown-item" onclick="openProfileModal()">
                                <div class="dropdown-icon">👤</div>
                                <span>Profile Settings</span>
                            </div>
                        <div class="dropdown-item" onclick="logout()">
                            <div class="dropdown-icon">🚪</div>
                            <span>Logout</span>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="post">
                            @csrf
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="dashboard">
        <div class="container">
            <div class="welcome-section" id="welcomeSection">
                <h1>Welcome, {{ Auth::user()->name }}!</h1>
                <p>Your faith and generosity help build the church. Track, support, and grow with us.</p>
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
            
            </div>

            <!-- Current Project -->
            <div class="projects-section">
                <h2 class="section-title">Active Church Projects 🔨</h2>
                <div class="projects-grid">
                    @forelse($projects as $project)
                        <div class="project-card">
                            @if($project->image_url)
                                <img src="{{ asset('storage/' . $project->image_url) }}" class="project-image" alt="{{ $project->name }}">
                            @else
                                <div class="project-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                            <div class="project-content">
                                <h3 class="project-title">{{ $project->name }}</h3>
                                <p class="project-description">{{ Str::limit($project->description, 120) }}</p>

                                <div class="project-meta">
                                    <span class="project-date">
                                        <i class="fas fa-calendar-alt"></i> Started: {{ \Carbon\Carbon::parse($project->start_date)->format('M j, Y') }}
                                    </span>
                                    <span class="project-status status-active">
                                        Active
                                    </span>
                                </div>

                                <div class="project-progress">
                                    <div class="progress-info">
                                        <span class="progress-amount">₱{{ number_format($project->raised_amount ?? 0, 2) }}</span>
                                        <span class="progress-target">Goal: ₱{{ number_format($project->goal_amount, 2) }}</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: {{ isset($project->progress_percent) ? $project->progress_percent : 0 }}%;"></div>
                                    </div>
                                    <div class="progress-percent">
                                        Progress: {{ number_format($project->progress_percent, 1) }}%
                                    </div>
                                </div>
                                
                                <a href="#donation-section" class="btn-donate" data-project-id="{{ $project->id }}" data-project-name="{{ $project->name }}" onclick="prefillDonationForm(this)">
                                    <i class="fas fa-donate"></i> Donate to this Project
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-hammer"></i>
                            <h3>No Active Projects Yet</h3>
                            <p>Check back soon for new church projects!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Donation Section -->
            <div class="donation-section" id="donation-section">
                <div class="qr-section">
                    <h3 class="section-title">Make a Donation</h3>
                    <div class="qr-tabs">
                        <div class="qr-tab active" onclick="switchQR('gcash')">GCash</div>
                        <div class="qr-tab" onclick="switchQR('maya')">Maya</div>
                    </div>
                    <div class="qr-code" id="qrDisplay">
                        GCash QR Code<br>
                        <small>Scan to donate</small>
                    </div>
                    <div class="info-box">
                        <h4>How to Give:</h4>
                        <ol>
                            <li>Send your donation to the GCash or Maya number above.</li>
                            <li>Take a screenshot of your transaction.</li>
                            <li>Fill out the form to submit your donation proof.</li>
                            <li>Our finance team will verify and acknowledge your contribution.</li>
                        </ol>
                    </div>
                </div>

                <div class="form-section">
                    <h3 style="color: var(--primary); margin-bottom: 2rem;">Donation Verification Form</h3>
                        <form id="donationForm" method="POST" action="{{ route('donation.store') }}">
                            @csrf
                            <input type="hidden" name="member_id" value="{{ auth()->check() ? auth()->user()->id : '' }}">

                            <div class="form-group">
                                <label for="name">Full Name *</label>
                                <input type="text" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone">
                            </div>

                            <div class="form-group">
                                <label for="amount">Donation Amount *</label>
                                <input type="number" id="amount" name="amount" min="1" step="0.01" required>
                            </div>

                            <div class="form-group">
                                <label for="payment_method">Payment Method *</label>
                                <select name="payment_method" required>
                                    <option value="gcash">GCash</option>
                                    <option value="maya">Maya</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="reference">Transaction Reference Number *</label>
                                <input type="text" id="reference" name="reference" required>
                            </div>

                            <div class="form-group">
                                <label for="purpose">Donation Purpose *</label>
                                <select name="purpose" required>
                                    <option value="pledge">Pledge</option>
                                    <option value="church_project">Church Project</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>

                            <div class="form-group" id="project-selection" style="display: none;">
                                <label for="project_id">Select Project *</label>
                                <select name="project_id" id="project_id">
                                    <option value="">Choose a project...</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="notes">Additional Notes</label>
                                <textarea id="notes" name="notes" rows="3" placeholder="Any additional information about your donation..."></textarea>
                            </div>

                            <button type="submit" class="submit-btn">Submit Donation Proof</button>
                        </form>
                </div>
            </div>

            <!-- Set a Pledge Reminder -->

            <!-- My Donations Tracking -->
            <section class="my-donations">
                <h2 class="section-title">My Donation History</h2>
                <table class="donations-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Purpose</th>
                            <th>Method</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </section>
        </div>

        <!-- Profile Modal -->
        <div class="profile-modal" id="profileModal">
            <div class="profile-modal-content">
                <div class="modal-header">
                    <h2 style="color: var(--primary); margin: 0;">Profile Management</h2>
                    <button class="modal-close" onclick="closeProfileModal()"> x </button>
                </div>

                <form id="profileForm" method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    <div class="profile-grid">
                        <div class="form-group">
                            <label for="profile-name">Full Name</label>
                            <input type="text" id="profile-name" name="name" value="{{ $user->name }}">
                        </div>

                        <div class="form-group">
                            <label for="profile-email">Email Address</label>
                            <input type="email" id="profile-email" name="email" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label for="profile-phone">Phone Number</label>
                            <input type="tel" id="profile-phone" name="phone" value="{{ $user->phone }}">
                        </div>

                       <div class="form-group">
                            <label for="custom_id">Church Member ID</label>
                            <input type="text" id="custom_id" class="form-control" value="{{ Auth::user()->custom_id }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="profile-address">Address</label>
                            <input type="text" id="profile-address" name="address" value="{{ $user->address }}">
                        </div>

                        <div class="form-group">
                            <label for="profile-ministry">Ministry Involvement</label>
                            <select id="profile-ministry" name="ministry">
                                <option value="youth" {{ $user->ministry == 'youth' ? 'selected' : '' }}>Youth Ministry</option>
                                <option value="worship" {{ $user->ministry == 'worship' ? 'selected' : '' }}>Worship Team</option>
                                <option value="children" {{ $user->ministry == 'children' ? 'selected' : '' }}>Children's Ministry</option>
                                <option value="none" {{ $user->ministry == 'none' ? 'selected' : '' }}>None</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn" style="margin-top: 1.5rem;">Update Profile</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Profile dropdown and modal functions
        function toggleDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            const trigger = document.querySelector('.profile-trigger');
            
            dropdown.classList.toggle('show');
            trigger.classList.toggle('active');
        }

        function toggleProjectSelection() {
            const purpose = document.getElementById('purpose').value;
            const projectSelection = document.getElementById('project-selection');
            const projectSelect = document.getElementById('project_id');
            
            if (purpose === 'church_project') {
                projectSelection.style.display = 'block';
                projectSelect.required = true;
            } else {
                projectSelection.style.display = 'none';
                projectSelect.required = false;
                projectSelect.value = '';
            }
        }

        function openProfileModal() {
            const modal = document.getElementById('profileModal');
            const dropdown = document.getElementById('profileDropdown');
            const trigger = document.querySelector('.profile-trigger');
            
            // Close dropdown first
            dropdown.classList.remove('show');
            trigger.classList.remove('active');
            
            // Open modal
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeProfileModal() {
            const modal = document.getElementById('profileModal');
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                document.getElementById('logout-form').submit();
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.profile-dropdown');
            const dropdownMenu = document.getElementById('profileDropdown');
            const trigger = document.querySelector('.profile-trigger');
            
            if (!dropdown.contains(event.target)) {
                dropdownMenu.classList.remove('show');
                trigger.classList.remove('active');
            }
        });

        // Close modal when clicking outside
        document.getElementById('profileModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeProfileModal();
            }
        });
        function switchQR(method) {
            const tabs = document.querySelectorAll('.qr-tab');
            const qrDisplay = document.getElementById('qrDisplay');
            
            tabs.forEach(tab => tab.classList.remove('active'));
            event.target.classList.add('active');
            
            if (method === 'gcash') {
                qrDisplay.innerHTML = 'GCash QR Code<br><small>Scan to donate</small>';
            } else {
                qrDisplay.innerHTML = 'Maya QR Code<br><small>Scan to donate</small>';
            }
        }

        // Form submission handler
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());
            
            // Simple validation
            if (!data.name || !data.email || !data.phone || !data.amount || !data.reference) {
                alert('Please fill in all required fields.');
                return;
            }
            
            // Simulate form submission
            const submitBtn = this.querySelector('.submit-btn');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Submitting...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                alert('Thank you for your donation! Your submission has been received and will be verified by our finance team.');
                this.reset();
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }, 2000);
        });

        //for the form
        function prefillDonationForm(buttonElement) {
            const projectId = buttonElement.getAttribute('data-project-id');
            const projectName = buttonElement.getAttribute('data-project-name');

            const purposeSelect = document.querySelector('select[name="purpose"]');
            const projectSelect = document.querySelector('select[name="project_id"]');
            const projectSelectionDiv = document.getElementById('project-selection');

            // Step 1: Set the purpose to 'Church Project'
            purposeSelect.value = 'church_project';
            
            // Step 2: Show the project selection field
            projectSelectionDiv.style.display = 'block';

            // Step 3: Set the selected project
            projectSelect.value = projectId;

            // Optional: Scroll to the form section
            document.getElementById('donation-section').scrollIntoView({ behavior: 'smooth' });
        }

        // Existing event listener to show/hide project selection
        document.querySelector('select[name="purpose"]').addEventListener('change', function() {
            const projectSelectionDiv = document.getElementById('project-selection');
            if (this.value === 'church_project') {
                projectSelectionDiv.style.display = 'block';
            } else {
                projectSelectionDiv.style.display = 'none';
            }
        });
    </script>
</body>
</html>