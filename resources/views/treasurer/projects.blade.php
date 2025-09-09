<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Church Projects - Treasurer</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Base styles */
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

        /* Projects Grid */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .project-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: transform 0.3s ease;
            position: relative;
        }

        .project-card:hover {
            transform: translateY(-5px);
        }

        .project-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: linear-gradient(45deg, #f0f0f0, #e0e0e0);
        }

        .project-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(45deg, #f0f0f0, #e0e0e0);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 3rem;
        }

        .project-content {
            padding: 1.5rem;
        }

        .project-title {
            color: #22577A;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .project-description {
            color: #6b7280;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .project-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 8px;
            font-size: 0.85rem;
        }

        .project-date {
            color: #6b7280;
        }

        .project-status {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .status-completed {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .project-progress {
            margin-bottom: 1.5rem;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .progress-amount {
            color: #22577A;
            font-weight: 600;
        }

        .progress-target {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #f0f0f0;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #38A3A5, #57CC99);
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .progress-percent {
            margin-top: 0.5rem;
            font-size: 0.85rem;
            color: #6b7280;
            text-align: center;
        }

        .btn-deactivate {
            background: #fee2e2;
            color: #dc2626;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-deactivate:hover {
            background: #fecaca;
        }

        .btn-deactivate:disabled {
            background: #f3f4f6;
            color: #9ca3af;
            cursor: not-allowed;
        }

        /* Donations Log Section */
        .donations-section {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-top: 2rem;
        }

        .donations-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .donations-header h3 {
            color: #22577A;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .donations-table {
            overflow-x: auto;
        }

        .donations-table table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .donations-table th,
        .donations-table td {
            padding: 1rem 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .donations-table th {
            background: #f8fafc;
            color: #22577A;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .donations-table tr:hover {
            background: #f8fafc;
        }

        .amount-cell {
            color: #10b981;
            font-weight: 600;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .empty-state i {
            font-size: 4rem;
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            color: #22577A;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #6b7280;
            margin-bottom: 2rem;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.9) translateY(-20px);
            transition: all 0.3s ease;
        }

        .modal-overlay.active .modal {
            transform: scale(1) translateY(0);
        }

        .modal-header {
            padding: 2rem 2rem 1rem;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            color: #22577A;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #6b7280;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: #f0f0f0;
            color: #22577A;
        }

        .modal-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: #22577A;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #38A3A5;
            box-shadow: 0 0 0 3px rgba(56, 163, 165, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .modal-footer {
            padding: 1rem 2rem 2rem;
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        .success-message {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            border-left: 4px solid #10b981;
            display: none;
        }

        .success-message.show {
            display: block;
        }
        
        .progress-bar {
            width: 100%;
            height: 10px;
            background: #eee;
            border-radius: 5px;
            overflow: hidden;
        }
        .progress-fill {
            height: 10px;
            background: #38a3a5;
        }

        @media (max-width: 640px) {
            .modal {
                width: 95%;
                margin: 1rem;
            }
            
            .modal-body {
                padding: 1.5rem;
            }
            
            .modal-header {
                padding: 1.5rem 1.5rem 1rem;
            }
            
            .modal-footer {
                padding: 1rem 1.5rem 1.5rem;
                flex-direction: column;
            }

            .donations-table {
                font-size: 0.8rem;
            }

            .donations-table th,
            .donations-table td {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>
  <div class="dashboard-container">
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

    <main class="main-content">
      <header class="header">
        <h2>Church Projects</h2>
        <button class="btn-primary" onclick="openAddProjectModal()">
            <i class="fas fa-plus"></i> Add Project
        </button>
      </header>

      @if(session('success'))
        <div class="success-message show">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
      @endif

      <!-- Projects Grid -->
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
                <span class="project-status {{ $project->status == 'active' ? 'status-active' : 'status-completed' }}">
                  {{ ucfirst($project->status) }}
                </span>
              </div>

              <div class="project-progress">
                <div class="progress-info">
                    <span class="progress-amount">₱{{ number_format($project->raised_amount ?? 0, 2) }}</span>
                    <span class="progress-target">Goal: ₱{{ number_format($project->goal_amount, 2) }}</span>
                </div>

                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $project->progress_percent }}%;"></div>
                </div>

                <div class="progress-percent">
                    Progress: {{ number_format($project->progress_percent, 1) }}%
                </div>

              </div>

              @if($project->status == 'active')
            <form method="POST" action="{{ route('treasurer.projects.deactivate', $project->id) }}">  
                @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-deactivate">
                        <i class="fas fa-check"></i> Mark as Completed
                    </button>
                </form>
              @else
                <button class="btn-deactivate" disabled>
                    <i class="fas fa-check"></i> Project Completed
                </button>
              @endif
            </div>
          </div>
        @empty
          <div class="empty-state" style="grid-column: 1/-1;">
              <i class="fas fa-hammer"></i>
              <h3>No Projects Yet</h3>
              <p>Create your first church project to start tracking donations and progress.</p>
              <button class="btn-primary" onclick="openAddProjectModal()">
                  <i class="fas fa-plus"></i> Add Project
              </button>
          </div>
        @endforelse
      </div>

      <!-- Donations Log Section -->
      <div class="donations-section">
          <div class="donations-header">
              <h3><i class="fas fa-heart"></i> Recent Donations</h3>
              <span style="color: #6b7280; font-size: 0.9rem;">
                  Total Donations: {{ $donations->count() }}
              </span>
          </div>

          <div class="donations-table">
              @if($donations->count() > 0)
                  <table>
                      <thead>
                          <tr>
                              <th>Date</th>
                              <th>Member Name</th>
                              <th>Email</th>
                              <th>Amount</th>
                              <th>Method</th>
                              <th>Reference</th>
                              <th>Project</th>
                              <th>Notes</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($donations as $donation)
                          <tr>
                              <td>{{ $donation->created_at ? $donation->created_at->format('M j, Y') : '-' }}</td>
                              <td>{{ $donation->name ?? '-' }}</td>
                              <td>{{ $donation->email ?? '-' }}</td>
                              <td class="amount-cell">₱{{ number_format($donation->amount, 2) }}</td>
                              <td>
                                  <span style="text-transform: capitalize;">
                                      {{ $donation->payment_method ?? '-' }}
                                  </span>
                              </td>
                              <td>{{ $donation->reference ?? '-' }}</td>
                              <td>
                                  @if($donation->project)
                                      <span style="padding: 0.25rem 0.5rem; background: rgba(56, 163, 165, 0.1); color: #22577A; border-radius: 6px; font-size: 0.8rem;">
                                          {{ $donation->project->name }}
                                      </span>
                                  @else
                                      <span style="color: #9ca3af;">General Fund</span>
                                  @endif
                              </td>
                              <td>{{ Str::limit($donation->notes ?? '-', 30) }}</td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              @else
                  <div style="text-align: center; padding: 3rem; color: #6b7280;">
                      <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; color: #d1d5db;"></i>
                      <h4>No Donations Yet</h4>
                      <p>Donation records will appear here when members contribute to projects.</p>
                  </div>
              @endif
          </div>
      </div>

      <!-- Add Project Modal -->
      <div id="addProjectModal" class="modal-overlay">
        <div class="modal">
        <form id="addProjectForm" action="{{ route('treasurer.projects.store') }}" method="POST" enctype="multipart/form-data">  
        @csrf
            <div class="modal-header">
                <h3 class="modal-title">Add New Project</h3>
                <button type="button" onclick="closeAddProjectModal()" class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Project Name *</label>
                    <input type="text" name="name" class="form-input" required 
                           placeholder="Enter project name (e.g., Church Renovation)">
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input form-textarea" 
                              placeholder="Describe the project purpose and details..."></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Goal Amount *</label>
                    <input type="number" step="0.01" min="0" name="goal_amount" class="form-input" required 
                           placeholder="0.00">
                </div>

                <div class="form-group">
                    <label class="form-label">Start Date *</label>
                    <input type="date" name="start_date" class="form-input" required 
                           value="{{ date('Y-m-d') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Project Image</label>
                    <input type="file" name="image" class="form-input" accept="image/*">
                    <small style="color: #6b7280; font-size: 0.8rem; margin-top: 0.5rem; display: block;">
                        Upload an image to make your project more appealing (Optional)
                    </small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeAddProjectModal()">Cancel</button>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Create Project
                </button>
            </div>
          </form>
        </div>
      </div>

    </main>
  </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addModal = document.getElementById('addProjectModal');
        const addForm = document.getElementById('addProjectForm');

        function openAddProjectModal() {
            if (!addModal) return;
            addModal.classList.add('active');
            if (addForm) {
                addForm.reset();
                const startEl = addForm.querySelector('input[name="start_date"]');
                if (startEl) startEl.value = new Date().toISOString().split('T')[0];
            }
        }

        function closeAddProjectModal() {
            if (!addModal) return;
            addModal.classList.remove('active');
        }

        // Expose to global so your inline onclick works
        window.openAddProjectModal = openAddProjectModal;
        window.closeAddProjectModal = closeAddProjectModal;

        // Close modal when clicking on overlay background
        if (addModal) {
            addModal.addEventListener('click', function(e) {
                if (e.target === this) closeAddProjectModal();
            });
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeAddProjectModal();
        });

        // Auto-hide success message after 5 seconds
        const successMessage = document.querySelector('.success-message.show');
        if (successMessage) {
            setTimeout(function() {
                successMessage.classList.remove('show');
            }, 5000);
        }

        // Form validation
        if (addForm) {
            addForm.addEventListener('submit', function(e) {
                const goalAmountEl = addForm.querySelector('input[name="goal_amount"]');
                const goalAmount = parseFloat(goalAmountEl && goalAmountEl.value ? goalAmountEl.value : 0);
                if (isNaN(goalAmount) || goalAmount <= 0) {
                    e.preventDefault();
                    alert('Goal amount must be greater than 0');
                    return false;
                }
            });
        }
    });
</script>
</body>
</html>