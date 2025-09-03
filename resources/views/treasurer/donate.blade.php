<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Logs - Church Treasurer Dashboard</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%2322577A'/%3E%3Cpath d='M30 40 L50 25 L70 40 L50 55 Z' fill='%2357CC99'/%3E%3Cpath d='M35 50 L65 50 L65 75 L35 75 Z' fill='%2380ED99'/%3E%3Ctext x='50' y='82' text-anchor='middle' fill='white' font-family='sans-serif' font-size='12' font-weight='bold'%3EA%3C/text%3E%3C/svg%3E">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* --- your CSS stays the same --- */
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;background:linear-gradient(135deg,#22577A 0%,#38A3A5 100%);min-height:100vh;}
        .dashboard-container{display:flex;flex-direction:column;min-height:100vh;}
        @media(min-width:768px){.dashboard-container{flex-direction:row;}}
        .sidebar{width:100%;max-width:280px;background:linear-gradient(180deg,#22577A 0%,#38A3A5 100%);color:white;padding:2rem 0;box-shadow:4px 0 15px rgba(0,0,0,0.1);}
        .logo{text-align:center;padding:0 2rem 2rem;border-bottom:1px solid rgba(255,255,255,0.1);margin-bottom:2rem;}
        .logo h1{font-size:1.5rem;font-weight:600;margin-bottom:0.5rem;}
        .logo p{color:#C7F9CC;font-size:0.9rem;}
        .nav-menu{list-style:none;padding:0 1rem;}
        .nav-item{margin-bottom:0.5rem;}
        .nav-link{display:flex;align-items:center;padding:1rem 1.5rem;color:#80ED99;text-decoration:none;border-radius:12px;transition:all 0.3s ease;font-weight:500;cursor:pointer;}
        .nav-link:hover,.nav-link.active{background:rgba(255,255,255,0.1);color:white;transform:translateX(5px);}
        .nav-link i{margin-right:1rem;font-size:1.1rem;width:20px;}
        .main-content{flex:1;padding:2rem;overflow-x:auto;}
        @media(max-width:767px){.main-content{padding:1rem;}}
        .header{background:white;padding:1.5rem 2rem;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:2rem;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;}
        .header h2{color:#22577A;font-size:1.8rem;font-weight:600;}
        .date-time{color:#6b7280;font-size:0.9rem;}
        .controls-section{background:white;padding:1.5rem 2rem;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:2rem;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;}
        .search-filter{display:flex;gap:1rem;flex-wrap:wrap;align-items:center;}
        .search-input{padding:0.75rem 1rem;border:2px solid #e5e7eb;border-radius:8px;font-size:0.9rem;min-width:200px;transition:border-color 0.3s ease;}
        .search-input:focus{outline:none;border-color:#38A3A5;}
        .filter-select{padding:0.75rem 1rem;border:2px solid #e5e7eb;border-radius:8px;font-size:0.9rem;background:white;cursor:pointer;transition:border-color 0.3s ease;}
        .filter-select:focus{outline:none;border-color:#38A3A5;}
        .export-btn{padding:0.75rem 1.5rem;background:#38A3A5;color:white;border:none;border-radius:8px;font-size:0.9rem;font-weight:500;cursor:pointer;transition:all 0.3s ease;display:flex;align-items:center;gap:0.5rem;}
        .export-btn:hover{background:#22577A;transform:translateY(-2px);}
        .table-container{background:white;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.08);overflow:hidden;margin-bottom:2rem;}
        .table-header{padding:1.5rem 2rem;background:#f8fafc;border-bottom:1px solid #e5e7eb;display:flex;justify-content:space-between;align-items:center;}
        .table-header h3{color:#22577A;font-size:1.3rem;font-weight:600;}
        .table-stats{color:#6b7280;font-size:0.9rem;}
        .donations-table{width:100%;border-collapse:collapse;font-size:0.9rem;}
        .donations-table th{background:#f8fafc;padding:1rem;text-align:left;font-weight:600;color:#22577A;border-bottom:2px solid #e5e7eb;position:sticky;top:0;z-index:10;}
        .donations-table td{padding:1rem;border-bottom:1px solid #f0f0f0;color:#374151;}
        .donations-table tr:hover{background:#f8fafc;}
        .amount-cell{font-weight:600;color:#22577A;}
        .method-badge{padding:0.25rem 0.5rem;border-radius:6px;font-size:0.8rem;font-weight:500;text-transform:uppercase;}
        .method-gcash{background:#e8f5e8;color:#0d6efd;}
        .method-maya{background:#fff3cd;color:#856404;}
        .pagination{display:flex;justify-content:center;align-items:center;gap:0.5rem;padding:1.5rem;background:white;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.08);}
        .pagination-btn{padding:0.5rem 1rem;border:1px solid #e5e7eb;background:white;color:#6b7280;border-radius:6px;cursor:pointer;transition:all 0.3s ease;font-size:0.9rem;}
        .pagination-btn:hover,.pagination-btn.active{background:#38A3A5;color:white;border-color:#38A3A5;}
        .pagination-btn:disabled{opacity:0.5;cursor:not-allowed;}
        @media(max-width:768px){.controls-section{flex-direction:column;align-items:stretch;}.search-filter{flex-direction:column;}.search-input{min-width:100%;}.donations-table{font-size:0.8rem;}.donations-table th,.donations-table td{padding:0.75rem 0.5rem;}}
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
                <li class="nav-item"><a href="{{ route('treasurer.project') }}" class="nav-link"><i class="fas fa-hammer"></i> Church Projects</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.savings') }}" class="nav-link"><i class="fas fa-piggy-bank"></i> Church Savings</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.pledges') }}" class="nav-link"><i class="fas fa-handshake"></i> Pledges</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.audit') }}" class="nav-link"><i class="fas fa-clipboard-list"></i> Audit Trail</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.donate') }}" class="nav-link"><i class="fas fa-donate"></i> Donation Logs</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <div>
                    <h2>Donation Logs</h2>
                    <div class="date-time" id="current-date"></div>
                </div>
            </div>

            <div class="controls-section">
                <div class="search-filter">
                    <input type="text" class="search-input" placeholder="Search by name, reference, email..." id="searchInput">
                    <select class="filter-select" id="methodFilter">
                        <option value="">All Methods</option>
                        <option value="gcash">GCash</option>
                        <option value="maya">Maya</option>
                    </select>
                    <select class="filter-select" id="purposeFilter">
                        <option value="">All Purposes</option>
                        <option value="church_project">Church Project</option>
                        <option value="pledge">Pledge</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <button class="export-btn" onclick="exportData()"><i class="fas fa-download"></i> Export CSV</button>
            </div>

            <div class="table-container">
                <div class="table-header">
                    <h3>Donation Records</h3>
                    <div class="table-stats"><span id="totalRecords">Total: 0 records</span></div>
                </div>
                <div class="table-responsive">
                    <table class="donations-table">
                        <thead>
                            <tr>
                                <th>Date Sent</th>
                                <th>Member Name</th>
                                <th>Email</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Reference #</th>
                                <th>Purpose</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody id="donationsTableBody"></tbody>
                    </table>
                </div>
            </div>

            <div class="pagination">
                <button class="pagination-btn" onclick="changePage(-1)" id="prevBtn"><i class="fas fa-chevron-left"></i> Previous</button>
                <span id="pageInfo">Page 1 of 1</span>
                <button class="pagination-btn" onclick="changePage(1)" id="nextBtn">Next <i class="fas fa-chevron-right"></i></button>
            </div>
        </main>
    </div>

    <script>
        // Laravel passes donations to JS
        let allDonations = @json($donations);
        let filteredDonations = [...allDonations];
        let currentPage = 1;
        const itemsPerPage = 6;

        document.addEventListener('DOMContentLoaded', function () {
            updateDateTime();
            renderDonationsTable();

            document.getElementById('searchInput').addEventListener('keyup', filterDonations);
            document.getElementById('methodFilter').addEventListener('change', filterDonations);
            document.getElementById('purposeFilter').addEventListener('change', filterDonations);

            setInterval(updateDateTime, 60000);
        });

        function updateDateTime() {
            const now = new Date();
            const options = {weekday:'long',year:'numeric',month:'long',day:'numeric',hour:'2-digit',minute:'2-digit'};
            document.getElementById('current-date').textContent = now.toLocaleDateString('en-US', options);
        }

        function formatCurrency(amount) {
            return new Intl.NumberFormat('en-PH',{style:'currency',currency:'PHP'}).format(amount);
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US',{year:'numeric',month:'short',day:'numeric'});
        }

        function getMethodBadge(method) {
            const m = method || 'unknown';
            return `<span class="method-badge method-${m.toLowerCase()}">${m.toUpperCase()}</span>`;
        }

        function getPurposeText(purpose) {
            const purposes = {'church_project':'Church Project','pledge':'Pledge','other':'Other'};
            return purposes[purpose] || purpose;
        }

        function renderDonationsTable() {
            const tableBody = document.getElementById('donationsTableBody');
            const startIndex = (currentPage-1)*itemsPerPage;
            const endIndex = startIndex+itemsPerPage;
            const pageData = filteredDonations.slice(startIndex,endIndex);

            if (filteredDonations.length===0) {
                tableBody.innerHTML = `<tr><td colspan="8" style="text-align:center;">No donation records found.</td></tr>`;
            } else {
                tableBody.innerHTML = pageData.map(donation=>`
                    <tr>
                        <td>${formatDate(donation.created_at)}</td>
                        <td>${donation.member ? donation.member.name : donation.name}</td>
                        <td>${donation.email}</td>
                        <td class="amount-cell">${formatCurrency(donation.amount)}</td>
                        <td>${getMethodBadge(donation.payment_method)}</td>
                        <td>${donation.reference}</td>
                        <td>${getPurposeText(donation.purpose)}</td>
                        <td>${donation.notes ?? '—'}</td>
                    </tr>
                `).join('');
            }

            updatePagination();
            document.getElementById('totalRecords').textContent = `Total: ${filteredDonations.length} records`;
        }

        function updatePagination() {
            const totalPages = Math.ceil(filteredDonations.length/itemsPerPage) || 1;
            document.getElementById('pageInfo').textContent = `Page ${currentPage} of ${totalPages}`;
            document.getElementById('prevBtn').disabled = currentPage===1;
            document.getElementById('nextBtn').disabled = currentPage===totalPages;
        }

        function changePage(direction) {
            const totalPages = Math.ceil(filteredDonations.length/itemsPerPage);
            if (direction===-1 && currentPage>1) currentPage--;
            else if (direction===1 && currentPage<totalPages) currentPage++;
            renderDonationsTable();
        }

        function filterDonations() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const methodFilter = document.getElementById('methodFilter').value;
            const purposeFilter = document.getElementById('purposeFilter').value;

            filteredDonations = allDonations.filter(donation=>{
                const matchesSearch = 
                    (donation.name && donation.name.toLowerCase().includes(searchTerm)) ||
                    (donation.email && donation.email.toLowerCase().includes(searchTerm)) ||
                    (donation.reference && donation.reference.toLowerCase().includes(searchTerm));

                const matchesMethod = !methodFilter || donation.payment_method===methodFilter;
                const matchesPurpose = !purposeFilter || donation.purpose===purposeFilter;

                return matchesSearch && matchesMethod && matchesPurpose;
            });

            currentPage=1;
            renderDonationsTable();
        }

        function exportData() {
            const csvContent = [
                ['Date','Donor Name','Email','Amount','Method','Reference','Purpose','Notes'],
                ...filteredDonations.map(d=>[
                    d.created_at,
                    d.member ? d.member.name : d.name,
                    d.email,
                    d.amount,
                    d.payment_method,
                    d.reference,
                    getPurposeText(d.purpose),
                    d.notes || ''
                ])
            ].map(row=>row.join(',')).join('\n');

            const blob = new Blob([csvContent],{type:'text/csv'});
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href=url;
            a.download=`donation_logs_${new Date().toISOString().split('T')[0]}.csv`;
            a.click();
            window.URL.revokeObjectURL(url);
        }
    </script>
</body>
</html>
