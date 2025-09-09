<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Church Savings - Treasurer Dashboard</title>
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

        /* Balance Summary Card */
        .balance-card {
            background: linear-gradient(135deg, #22577A, #38A3A5);
            color: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(34, 87, 122, 0.3);
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .balance-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(45deg);
        }

        .balance-label {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .balance-amount {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .balance-subtitle {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        @media (max-width: 640px) {
            .balance-amount {
                font-size: 2.2rem;
            }
        }

        /* Transaction History Table */
        .transactions-section {
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

        .table-container {
            overflow-x: auto;
        }

        .transactions-table {
            width: 100%;
            border-collapse: collapse;
        }

        .transactions-table th {
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

        .transactions-table td {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .transactions-table tr:hover {
            background: #f8fafc;
        }

        .transaction-date {
            color: #6b7280;
            font-weight: 500;
        }

        .transaction-amount {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .amount-add {
            color: #10b981;
        }

        .amount-deduct {
            color: #ef4444;
        }

        .transaction-type {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .type-add {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .type-deduct {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .transaction-note {
            color: #6b7280;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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
            max-width: 500px;
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
            min-height: 80px;
            font-family: inherit;
        }

        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            cursor: pointer;
        }

        .form-select:focus {
            outline: none;
            border-color: #38A3A5;
            box-shadow: 0 0 0 3px rgba(56, 163, 165, 0.1);
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
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: none;
            align-items: center;
            gap: 0.5rem;
        }

        @media (max-width: 640px) {
            .header-actions {
                width: 100%;
                justify-content: center;
            }
            
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

            .transactions-table th,
            .transactions-table td {
                padding: 0.75rem 0.5rem;
                font-size: 0.9rem;
            }

            .transaction-note {
                max-width: 120px;
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
                <li class="nav-item"><a href="{{ route('treasurer.projects') }}" class="nav-link"><i class="fas fa-hammer"></i> Church Projects</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.savings') }}" class="nav-link"><i class="fas fa-piggy-bank"></i> Church Savings</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.pledges') }}" class="nav-link"><i class="fas fa-handshake"></i> Pledges</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.audit') }}" class="nav-link"><i class="fas fa-clipboard-list"></i> Audit Trail</a></li>
                <li class="nav-item"><a href="{{ route('treasurer.donate') }}" class="nav-link"><i class="fas fa-donate"></i> Donation Logs</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h2>Church Savings</h2>
                <div class="header-actions">
                    <button class="btn-primary" onclick="openModal('add')">
                        <i class="fas fa-plus"></i>
                        Add Money
                    </button>
                    <button class="btn-danger" onclick="openModal('deduct')">
                        <i class="fas fa-minus"></i>
                        Deduct Money
                    </button>
                </div>
            </div>

            <!-- Balance Summary -->
            <div class="balance-card">
                <div class="balance-label">Current Balance</div>
                <div class="balance-amount" id="currentBalance">₱0.00</div>
                <div class="balance-subtitle">Church General Fund</div>
            </div>

            <!-- Transaction History -->
            <div class="transactions-section">
                <div class="section-header">
                    <h3 class="section-title">Transaction History</h3>
                </div>
                <div class="table-container">
                    <table class="transactions-table" id="transactionsTable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Note</th>
                                <th>Balance After</th>
                            </tr>
                        </thead>
                        <tbody id="transactionsBody">
                            <!-- Transactions will be populated here -->
                        </tbody>
                    </table>
                    <div class="empty-state" id="emptyState">
                        <i class="fas fa-history"></i>
                        <h3>No Transactions Yet</h3>
                        <p>Start by adding or deducting money to see transaction history</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Transaction Modal -->
    <div class="modal-overlay" id="transactionModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Add Money</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle"></i>
                    <span>Transaction completed successfully!</span>
                </div>
                
                <form id="transactionForm">
                    <div class="form-group">
                        <label class="form-label" for="amount">Amount (₱)</label>
                        <input type="number" id="amount" class="form-input" step="0.01" min="0.01" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="note">Note</label>
                        <textarea id="note" class="form-input form-textarea" placeholder="Enter purpose or description..." required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn-secondary" onclick="closeModal()">Cancel</button>
                <button class="btn-primary" id="submitBtn" onclick="submitTransaction()">
                    <i class="fas fa-save"></i>
                    Save Transaction
                </button>
            </div>
        </div>
    </div>
    
    <script>
        let transactions = [];
        let currentBalance = 0;
        let transactionType = 'add';

        document.addEventListener('DOMContentLoaded', async function () {
            await fetchSavingsData();
        });

        async function fetchSavingsData() {
            try {
                const response = await fetch('{{ route("treasurer.savings.api") }}');
                const data = await response.json();
                transactions = data.transactions;
                currentBalance = data.balance;
                updateBalance();
                renderTransactions();
            } catch (error) {
                console.error('Failed to load savings data:', error);
            }
        }

        function updateBalance() {
            document.getElementById('currentBalance').textContent = formatCurrency(currentBalance);
        }

        function formatCurrency(amount) {
            return new Intl.NumberFormat('en-PH', {
                style: 'currency',
                currency: 'PHP'
            }).format(amount);
        }

        function formatDate(date) {
            return new Date(date).toLocaleDateString('en-PH', {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function openModal(type) {
            transactionType = type;
            const modal = document.getElementById('transactionModal');
            const modalTitle = document.getElementById('modalTitle');
            const submitBtn = document.getElementById('submitBtn');

            if (type === 'add') {
                modalTitle.textContent = 'Add Money';
                submitBtn.innerHTML = '<i class="fas fa-plus"></i> Add Money';
                submitBtn.className = 'btn-primary';
            } else {
                modalTitle.textContent = 'Deduct Money';
                submitBtn.innerHTML = '<i class="fas fa-minus"></i> Deduct Money';
                submitBtn.className = 'btn-danger';
            }

            document.getElementById('transactionForm').reset();
            document.getElementById('successMessage').style.display = 'none';
            modal.classList.add('active');
        }

        function closeModal() {
            document.getElementById('transactionModal').classList.remove('active');
        }

        async function submitTransaction() {
            const amount = parseFloat(document.getElementById('amount').value);
            const note = document.getElementById('note').value.trim();

            if (!amount || amount <= 0 || !note) {
                alert('Invalid input.');
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const res = await fetch("{{ route('treasurer.savings.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        type: transactionType,
                        amount: amount,
                        note: note
                    })
                });

                const data = await res.json();

                if (!res.ok) {
                    alert(data.error || 'Transaction failed.');
                    return;
                }

                // Update only from server response to avoid manual errors
                transactions.unshift(data);
                currentBalance = data.balance_after;
                updateBalance();
                renderTransactions();

                document.getElementById('successMessage').style.display = 'flex';
                setTimeout(closeModal, 1500);
            } catch (error) {
                console.error('Transaction error:', error);
                alert('Something went wrong. Please try again.');
            }
        }

        function renderTransactions() {
            const tbody = document.getElementById('transactionsBody');
            const emptyState = document.getElementById('emptyState');

            if (transactions.length === 0) {
                tbody.style.display = 'none';
                emptyState.style.display = 'block';
                return;
            }

            tbody.style.display = 'table-row-group';
            emptyState.style.display = 'none';

            tbody.innerHTML = transactions.map(transaction => `
                <tr>
                    <td class="transaction-date">${formatDate(transaction.created_at)}</td>
                    <td>
                        <span class="transaction-type ${transaction.type === 'add' ? 'type-add' : 'type-deduct'}">
                            ${transaction.type === 'add' ? 'Add' : 'Deduct'}
                        </span>
                    </td>
                    <td class="transaction-amount ${transaction.type === 'add' ? 'amount-add' : 'amount-deduct'}">
                        ${transaction.type === 'add' ? '+' : '-'}${formatCurrency(transaction.amount)}
                    </td>
                    <td class="transaction-note" title="${transaction.note}">${transaction.note}</td>
                    <td class="transaction-amount">${formatCurrency(transaction.balance_after)}</td>
                </tr>
            `).join('');
        }

        // Close modal on outside click
        document.getElementById('transactionModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Submit on Enter key
        document.getElementById('transactionForm').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                submitTransaction();
            }
        });
    </script>
</body>
</html>