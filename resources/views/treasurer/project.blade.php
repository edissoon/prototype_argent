<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Church Projects - Treasurer Dashboard</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%2322577A'/%3E%3Cpath d='M30 40 L50 25 L70 40 L50 55 Z' fill='%2357CC99'/%3E%3Cpath d='M35 50 L65 50 L65 75 L35 75 Z' fill='%2380ED99'/%3E%3Ctext x='50' y='82' text-anchor='middle' fill='white' font-family='sans-serif' font-size='12' font-weight='bold'%3EA%3C/text%3E%3C/svg%3E">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Base styles from dashboard */
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

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
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

        .project-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-small {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .btn-view {
            background: #f0f9ff;
            color: #0369a1;
        }

        .btn-view:hover {
            background: #e0f2fe;
        }

        .btn-edit {
            background: #fef3c7;
            color: #92400e;
        }

        .btn-edit:hover {
            background: #fde68a;
        }

        .btn-archive {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-archive:hover {
            background: #fecaca;
        }

        .project-status {
            position: absolute;
            top: 1rem;
            right: 1rem;
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

        .status-archived {
            background: rgba(107, 114, 128, 0.1);
            color: #6b7280;
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

        .image-upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            background: #f9fafb;
        }

        .image-upload-area:hover {
            border-color: #38A3A5;
            background: #f0f9ff;
        }

        .image-upload-area.dragover {
            border-color: #38A3A5;
            background: #f0f9ff;
            transform: scale(1.02);
        }

        .upload-icon {
            font-size: 3rem;
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        .upload-text {
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .upload-subtext {
            color: #9ca3af;
            font-size: 0.85rem;
        }

        .image-preview {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-top: 1rem;
        }

        .remove-image {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
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

        .form-error {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 0.25rem;
            display: none;
        }

        .form-input.error {
            border-color: #ef4444;
        }

        .success-message {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: none;
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
                <li class="nav-item"><a href="{{ route('treasurer.projects') }}" class="nav-link active"><i class="fas fa-hammer"></i> Church Projects</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.savings') }}" class="nav-link"><i class="fas fa-piggy-bank"></i> Church Savings</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.pledges') }}" class="nav-link"><i class="fas fa-handshake"></i> Pledges</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.audit') }}" class="nav-link"><i class="fas fa-clipboard-list"></i> Audit Trail</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.donate') }}" class="nav-link"><i class="fas fa-donate"></i> Donation Logs</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <h2>Church Projects</h2>
                <div class="header-actions">
                    <button class="btn-primary" onclick="openAddProjectModal()">
                        <i class="fas fa-plus"></i>
                        Add New Project
                    </button>
                </div>
            </header>

            @if(session('success'))
                <div class="alert alert-success" style="margin-bottom: 1rem;">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" style="margin-bottom: 1rem;">
                    <ul style="margin: 0; padding-left: 1.5rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Projects Grid -->
            <div class="projects-grid">
                @forelse($projects as $project)
                    <div class="project-card">
                        <div class="project-status status-{{ $project->status }}">
                            {{ ucfirst($project->status) }}
                        </div>
                        <div class="project-image">
                            @if($project->image_path)
                                <img src="{{ asset('storage/'.$project->image_path) }}" alt="{{ $project->name }}">
                            @else
                                <i class="fas fa-image"></i>
                            @endif
                        </div>
                        <div class="project-content">
                            <h3>{{ $project->name }}</h3>
                            <p>{{ $project->description }}</p>
                            <p><strong>₱{{ number_format($project->current_amount, 2) }}</strong> 
                               of ₱{{ number_format($project->target_amount, 2) }}</p>
                            
                            <div class="project-actions">
                                <!-- Edit Button -->
                                <button type="button" class="btn-small btn-edit" onclick="editProject({{ $project->id }}, '{{ $project->name }}', '{{ $project->description }}', {{ $project->target_amount }}, '{{ $project->status }}', '{{ $project->image_path ? asset('storage/'.$project->image_path) : '' }}')">
                                    Edit
                                </button>

                                <!-- Toggle Button -->
                                <form method="POST" action="{{ route('treasurer.projects.toggle', $project->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-small btn-archive" onclick="return confirm('Are you sure you want to {{ $project->status === 'archived' ? 'restore' : 'archive' }} this project?')">
                                        {{ $project->status === 'archived' ? 'Restore' : 'Archive' }}
                                    </button>
                                </form>

                                <!-- Delete Button -->
                                <form method="POST" action="{{ route('treasurer.projects.delete', $project->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-small btn-danger" onclick="return confirm('Are you sure you want to delete this project? This action cannot be undone.')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No projects yet. <a href="#" onclick="openAddProjectModal()">Add your first project</a></p>
                @endforelse
            </div>
        </main>
    </div>

    <!-- Add/Edit Project Modal -->
    <div class="modal-overlay" id="projectModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Add New Project</h3>
                <button class="modal-close" onclick="closeProjectModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="success-message" id="successMessage" style="display:none;">
                    <i class="fas fa-check-circle"></i>
                    Project saved successfully!
                </div>

                <form id="projectForm" action="{{ route('treasurer.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="methodField" name="_method" value="">
                    <input type="hidden" id="projectId" value="">

                    <div class="form-group">
                        <label class="form-label" for="projectName">Project Name *</label>
                        <input type="text" id="projectName" name="name" class="form-input" required>
                        <div class="form-error" style="display:none;">Project name is required</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="projectDescription">Project Description *</label>
                        <textarea id="projectDescription" name="description" class="form-input form-textarea" required></textarea>
                        <div class="form-error" style="display:none;">Project description is required</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="targetAmount">Target Amount (₱) *</label>
                        <input type="number" id="targetAmount" name="target_amount" class="form-input" min="1" step="0.01" required>
                        <div class="form-error" style="display:none;">Target amount must be greater than 0</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Project Image</label>
                        <div class="image-upload-area" id="imageUploadArea" onclick="triggerFileInput()">
                            <input type="file" id="imageInput" name="image" accept="image/*" style="display:none;" onchange="handleImageUpload(event)">
                            <div id="uploadContent">
                                <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <div class="upload-text">Click to upload or drag and drop</div>
                                <div class="upload-subtext">PNG, JPG, GIF up to 10MB</div>
                            </div>
                            <div id="imagePreviewContainer" style="display:none;">
                                <img id="imagePreview" class="image-preview" alt="Project preview">
                                <button type="button" class="remove-image" onclick="removeImage()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="projectStatus">Project Status</label>
                        <select id="projectStatus" name="status" class="form-input">
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeProjectModal()">Cancel</button>
                <button type="button" class="btn-primary" onclick="submitProjectForm()">
                    <i class="fas fa-save"></i> Save Project
                </button>
            </div>
        </div>
    </div>

    <script>
        function openAddProjectModal() {
            document.getElementById('modalTitle').textContent = 'Add New Project';
            document.getElementById('projectForm').action = '{{ route("treasurer.projects.store") }}';
            document.getElementById('methodField').value = '';
            document.getElementById('projectForm').reset();
            document.getElementById('projectId').value = '';
            resetImageUpload();
            clearFormErrors();
            document.getElementById('successMessage').style.display = 'none';
            document.getElementById('projectModal').classList.add('active');
        }

        function editProject(projectId, name, description, targetAmount, status, imagePath) {
            document.getElementById('modalTitle').textContent = 'Edit Project';
            document.getElementById('projectForm').action = '{{ route("treasurer.projects.update", ":id") }}'.replace(':id', projectId);
            document.getElementById('methodField').value = 'PUT';
            document.getElementById('projectId').value = projectId;
            document.getElementById('projectName').value = name;
            document.getElementById('projectDescription').value = description;
            document.getElementById('targetAmount').value = targetAmount;
            document.getElementById('projectStatus').value = status;
            
            // Handle image preview if exists
            if (imagePath) {
                showImagePreview(imagePath);
            } else {
                resetImageUpload();
            }
            
            clearFormErrors();
            document.getElementById('successMessage').style.display = 'none';
            document.getElementById('projectModal').classList.add('active');
        }

        function closeProjectModal() {
            document.getElementById('projectModal').classList.remove('active');
        }

        function triggerFileInput() {
            document.getElementById('imageInput').click();
        }

        function handleImageUpload(event) {
            const file = event.target.files[0];
            if (!file) return;

            // Validate file size (10MB max)
            if (file.size > 10 * 1024 * 1024) {
                alert('File size must be less than 10MB');
                event.target.value = '';
                return;
            }

            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Please select a valid image file');
                event.target.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                showImagePreview(e.target.result);
            };
            reader.readAsDataURL(file);
        }

        function showImagePreview(imageSrc) {
            document.getElementById('uploadContent').style.display = 'none';
            document.getElementById('imagePreviewContainer').style.display = 'block';
            document.getElementById('imagePreview').src = imageSrc;
        }

        function removeImage() {
            resetImageUpload();
            document.getElementById('imageInput').value = '';
        }

        function resetImageUpload() {
            document.getElementById('uploadContent').style.display = 'block';
            document.getElementById('imagePreviewContainer').style.display = 'none';
            document.getElementById('imagePreview').src = '';
        }

        function validateForm() {
            let isValid = true;
            const requiredFields = [
                { id: 'projectName', message: 'Project name is required' },
                { id: 'projectDescription', message: 'Project description is required' },
                { id: 'targetAmount', message: 'Target amount is required' }
            ];

            clearFormErrors();

            requiredFields.forEach(field => {
                const input = document.getElementById(field.id);
                const value = input.value.trim();
                
                if (!value) {
                    showFieldError(field.id, field.message);
                    isValid = false;
                } else if (field.id === 'targetAmount' && parseFloat(value) <= 0) {
                    showFieldError(field.id, 'Target amount must be greater than 0');
                    isValid = false;
                }
            });

            return isValid;
        }

        function showFieldError(fieldId, message) {
            const input = document.getElementById(fieldId);
            const errorDiv = input.nextElementSibling;
            
            input.classList.add('error');
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
        }

        function clearFormErrors() {
            const errorDivs = document.querySelectorAll('.form-error');
            const inputs = document.querySelectorAll('.form-input');
            
            errorDivs.forEach(div => {
                div.style.display = 'none';
            });
            
            inputs.forEach(input => {
                input.classList.remove('error');
            });
        }

        function submitProjectForm() {
            if (!validateForm()) return;
            
            // Show loading state
            const submitBtn = event.target;
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            submitBtn.disabled = true;

            // Submit the form
            document.getElementById('projectForm').submit();
        }

        // Drag and drop functionality
        const imageUploadArea = document.getElementById('imageUploadArea');
        
        imageUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        imageUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        imageUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const input = document.getElementById('imageInput');
                input.files = files;
                handleImageUpload({ target: { files: [files[0]] } });
            }
        });

        // Close modal when clicking outside
        document.getElementById('projectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeProjectModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('projectModal').classList.contains('active')) {
                closeProjectModal();
            }
        });
    </script>
</body>
</html>