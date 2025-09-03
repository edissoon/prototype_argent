<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Church Finance Management</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20100%20100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%2322577A'/%3E%3Cpath d='M30 40 L50 25 L70 40 L50 55 Z' fill='%2357CC99'/%3E%3Cpath d='M35 50 L65 50 L65 75 L35 75 Z' fill='%2380ED99'/%3E%3Ctext x='50' y='82' text-anchor='middle' fill='white' font-family='sans-serif' font-size='12' font-weight='bold'%3EA%3C/text%3E%3C/svg%3E" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
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
            padding: 1rem;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
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
        .header h1 {
            color: #22577A;
            font-size: 1.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .back-btn {
            background: linear-gradient(135deg, #38A3A5, #22577A);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(56, 163, 165, 0.3);
        }
        .date-selector {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .date-selector label {
            color: #22577A;
            font-weight: 600;
            font-size: 1rem;
        }
        .date-input {
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.9rem;
            color: #22577A;
            font-weight: 500;
            outline: none;
            transition: border-color 0.3s ease;
        }
        .date-input:focus {
            border-color: #38A3A5;
        }
        .main-content {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 2rem;
        }
        @media (max-width: 1200px) {
            .main-content {
                grid-template-columns: 1fr;
            }
        }
        .finance-section {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .section-header h2 {
            color: #22577A;
            font-size: 1.3rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .section-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .btn {
            background: linear-gradient(135deg, #38A3A5, #22577A);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(56, 163, 165, 0.3);
        }
        .btn-secondary {
            background: #f3f4f6;
            color: #6b7280;
            border: 1px solid #e5e7eb;
        }
        .btn-secondary:hover {
            background: #e5e7eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .table-container {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
            background: white;
            max-height: 400px;
            overflow-y: auto;
        }
        .finance-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
            background: white;
        }
        .finance-table th {
            background: #f8fafc;
            color: #22577A;
            font-weight: 600;
            padding: 0.75rem;
            text-align: left;
            border-bottom: 2px solid #e5e7eb;
            border-right: 1px solid #e5e7eb;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .finance-table th:last-child {
            border-right: none;
        }
        .finance-table td {
            padding: 0;
            border-bottom: 1px solid #f0f0f0;
            border-right: 1px solid #f0f0f0;
            position: relative;
        }
        .finance-table td:last-child {
            border-right: none;
        }
        #expenseTableBody tr:nth-child(1),
        #expenseTableBody tr:nth-child(2) {
            background-color: #f0f0f0;
        }
        .table-input {
            width: 100%;
            border: none;
            padding: 0.75rem;
            font-size: 0.9rem;
            background: transparent;
            transition: all 0.2s ease;
            outline: none;
            font-family: inherit;
        }
        .table-input:focus {
            background: #f0f9ff;
            box-shadow: inset 0 0 0 2px #38A3A5;
            position: relative;
            z-index: 5;
        }
        .row-number {
            background: #f8fafc !important;
            color: #6b7280;
            font-weight: 600;
            text-align: center;
            font-size: 0.8rem;
            width: 50px;
            min-width: 50px;
            padding: 0.75rem;
        }
        .new-row {
            background: #fafafa;
        }
        .new-row .table-input {
            background: #fafafa;
        }
        .delete-btn {
            background: #fee2e2;
            color: #dc2626;
            border: none;
            padding: 0.25rem;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            margin: 0.25rem auto;
        }
        .delete-btn:hover {
            background: #fecaca;
            transform: scale(1.1);
        }
        .summary-section {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 2rem;
            height: fit-content;
        }
        .summary-section h2 {
            color: #22577A;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .total-card {
            background: linear-gradient(135deg, #38A3A5, #22577A);
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .total-card h3 {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .total-amount {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .breakdown {
            display: grid;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .breakdown-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 8px;
            border-left: 4px solid #38A3A5;
        }
        .breakdown-item.income { border-left-color: #10b981; }
        .breakdown-item.tithes { border-left-color: #22c55e; }
        .breakdown-item.offering { border-left-color: #3b82f6; }
        .breakdown-item.others { border-left-color: #8b5cf6; }
        .breakdown-item.expenses { border-left-color: #ef4444; }
        .breakdown-item.balance { border-left-color: #f59e0b; }
        .breakdown-label {
            color: #22577A;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .breakdown-amount {
            color: #22577A;
            font-weight: 700;
            font-size: 1rem;
        }
        .records-archive {
            background: #f8fafc;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }
        .records-archive h4 {
            color: #22577A;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .archive-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem;
            background: white;
            border-radius: 6px;
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
        }
        .archive-date {
            color: #6b7280;
            font-weight: 500;
        }
        .archive-amount {
            color: #22577A;
            font-weight: 600;
        }
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            .table-container {
                overflow-x: auto;
            }
            .finance-table {
                min-width: 600px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>
                <i class="fas fa-coins"></i> Cash Flow Management
            </h1>
            <a href="{{ route('treasurer.home') }}" class="back-btn" onclick="goToDashboard()">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>

        <!-- Date Selector -->
        <div class="date-selector">
            <label for="selectedDate">Select Date:</label>
            <input type="date" id="selectedDate" class="date-input" onchange="loadRecordsForDate()" />
            <span id="dateDisplay" class="text-[#22577A] font-semibold ml-4"></span>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Income and Expense Sections -->
            <div>
                <!-- Income Section -->
                <div class="finance-section">
                    <div class="section-header">
                        <h2>
                            <i class="fas fa-coins"></i>
                            Income Records
                        </h2>
                        <div class="section-actions">
                            <button class="btn" onclick="addIncomeRow()">
                                <i class="fas fa-plus"></i>
                                Add Row
                            </button>
                            <button class="btn btn-secondary" onclick="clearIncomeData()">
                                <i class="fas fa-trash"></i>
                                Clear
                            </button>
                            <button class="btn btn-secondary" onclick="exportIncomeData()">
                                <i class="fas fa-download"></i>
                                Export
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-container">
                        <table class="finance-table">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th style="width: 200px;">Name</th>
                                    <th style="width: 120px;">Tithes (₱)</th>
                                    <th style="width: 120px;">Offering (₱)</th>
                                    <th style="width: 120px;">Others (₱)</th>
                                    <th style="width: 200px;">Note</th>
                                    <th style="width: 60px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="incomeTableBody">
                                <!-- Income rows generated by JS -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Expense Section -->
                <div class="finance-section">
                    <div class="section-header">
                        <h2>
                            <i class="fas fa-credit-card"></i>
                            Expense Records
                        </h2>
                        <div class="section-actions">
                            <button class="btn" onclick="addExpenseRow()">
                                <i class="fas fa-plus"></i>
                                Add Row
                            </button>
                            <button class="btn btn-secondary" onclick="clearExpenseData()">
                                <i class="fas fa-trash"></i>
                                Clear
                            </button>
                            <button class="btn btn-secondary" onclick="exportExpenseData()">
                                <i class="fas fa-download"></i>
                                Export
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-container">
                        <table class="finance-table">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th style="width: 300px;">Expense Name</th>
                                    <th style="width: 150px;">Amount (₱)</th>
                                    <th style="width: 60px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="expenseTableBody">
                                <!-- Expense rows generated by JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Summary Section -->
            <div class="summary-section">
                <h2>
                    <i class="fas fa-chart-bar"></i>
                    Financial Summary
                </h2>
                
                <div class="total-card">
                    <h3>Net Balance</h3>
                    <div class="total-amount" id="netBalance">₱0.00</div>
                </div>

                <div class="breakdown">
                    <div class="breakdown-item income">
                        <span class="breakdown-label">Total Income</span>
                        <span class="breakdown-amount" id="totalIncome">₱0.00</span>
                    </div>
                    <div class="breakdown-item tithes">
                        <span class="breakdown-label">├ Tithes</span>
                        <span class="breakdown-amount" id="tithesAmount">₱0.00</span>
                    </div>
                    <div class="breakdown-item offering">
                        <span class="breakdown-label">├ Offering</span>
                        <span class="breakdown-amount" id="offeringAmount">₱0.00</span>
                    </div>
                    <div class="breakdown-item others">
                        <span class="breakdown-label">└ Others</span>
                        <span class="breakdown-amount" id="othersAmount">₱0.00</span>
                    </div>
                    <div class="breakdown-item expenses">
                        <span class="breakdown-label">Total Expenses</span>
                        <span class="breakdown-amount" id="totalExpenses">₱0.00</span>
                    </div>
                </div>

                <button class="btn w-full" onclick="generateReport()">
                    <i class="fas fa-file-alt"></i>
                    Generate Report
                </button>

                <button class="btn btn-success w-full mt-4" onclick="saveAllRecordsToDatabase()">
                    <i class="fas fa-save"></i> Save All Records
                </button>

                <!-- Records Archive -->
                <div class="records-archive">
                    <h4>
                        <i class="fas fa-archive"></i>
                        Previous Records
                    </h4>
                    <div id="archiveList">
                        <!-- Archive items populated by JS -->
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    function createNewIncomeRecord(element) {
        const row = element.closest('tr');
        const name = row.querySelector('[data-field="name"]').value.trim();
        const tithes = parseFloat(row.querySelector('[data-field="tithes"]').value) || 0;
        const offering = parseFloat(row.querySelector('[data-field="offering"]').value) || 0;
        const others = parseFloat(row.querySelector('[data-field="others"]').value) || 0;
        const note = row.querySelector('[data-field="note"]').value.trim();

        if (name && (tithes > 0 || offering > 0 || others > 0)) {
            const record = {
                id: Date.now() + Math.random(),
                name: name,
                tithes: tithes,
                offering: offering,
                others: others,
                note: note
            };

            financeData[currentDate].income.push(record);
            convertToIncomeDataRow(row, record);
            addEmptyIncomeRow();
            initializeExpenseTables(); // Recompute 10% and 40% expense rows
            updateSummary();
            updateArchiveList();
        }
    }

    // Data storage for different dates
    let financeData = {};
    let currentDate = new Date().toISOString().split('T')[0];

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('selectedDate').value = currentDate;
    updateDateDisplay();
    
    // Load existing data and initialize tables
    loadRecordsForDate();
    
    // Load and update archive list from database
    updateArchiveList();
    });

    function updateDateDisplay() {
        const date = new Date(currentDate);
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('dateDisplay').textContent = date.toLocaleDateString('en-US', options);
    }

    function loadRecordsForDate() {
        currentDate = document.getElementById('selectedDate').value;
        updateDateDisplay();

        if (!financeData[currentDate]) {
            financeData[currentDate] = {
                income: [],
                expenses: []
            };
        }

        // Load existing data from database for the selected date
        loadExistingCashflowData();

        initializeIncomeTables();
        initializeExpenseTables();
        updateSummary();
    }

    // Part for the detailed entry retrieval
    function loadDetailedEntries(date) {
        // Load income entries
        fetch(`/cashflow/income-entries/${date}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.entries) {
                    financeData[date].income = data.entries.map(entry => ({
                        id: entry.id,
                        name: entry.name,
                        tithes: parseFloat(entry.tithes),
                        offering: parseFloat(entry.offering),
                        others: parseFloat(entry.others),
                        note: entry.note || ''
                    }));
                    initializeIncomeTables();
                    updateSummary();
                }
            })
            .catch(error => console.log('Error loading income entries:', error));

        // Load expense entries
        fetch(`/cashflow/expense-entries/${date}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.entries) {
                    // Filter out auto-generated entries and load only manual ones
                    const manualEntries = data.entries.filter(entry => !entry.is_auto);
                    financeData[date].expenses = manualEntries.map(entry => ({
                        id: entry.id,
                        name: entry.name,
                        amount: parseFloat(entry.amount),
                        auto: entry.is_auto
                    }));
                    initializeExpenseTables();
                    updateSummary();
                }
            })
            .catch(error => console.log('Error loading expense entries:', error));
    }

    // Income Table Initialization
    function initializeIncomeTables() {
        const tbody = document.getElementById('incomeTableBody');
        tbody.innerHTML = '';

        const incomeData = financeData[currentDate].income;
        incomeData.forEach((record, index) => {
            addIncomeRowToTable(record, index + 1);
        });

        // Add 3 empty rows for new entries
        for (let i = 0; i < 3; i++) {
            addEmptyIncomeRow();
        }
    }

    // Expense Table Initialization
    function initializeExpenseTables() {
        const tbody = document.getElementById('expenseTableBody');
        tbody.innerHTML = '';

        // Add auto-computed 10% and 40% rows
        addComputedExpenseRows();

        // Load existing manual expense data (exclude auto)
        const expenseData = financeData[currentDate].expenses.filter(r => !r.auto);
        expenseData.forEach((record, index) => {
            addExpenseRowToTable(record, index + 3); // start after computed rows 1 and 2
        });

        // Add 2 empty rows for manual entries
        for (let i = 0; i < 2; i++) {
            addEmptyExpenseRow();
        }
    }

    // Add 10% and 40% computed expense rows
    function addComputedExpenseRows() {
        const tbody = document.getElementById('expenseTableBody');
        const dayData = financeData[currentDate];
        if (!dayData) return;

        let totalTithes = 0, totalOffering = 0;
        dayData.income.forEach(record => {
            totalTithes += record.tithes;
            totalOffering += record.offering;
        });

        const incomeBase = totalTithes + totalOffering;
        const tenPercent = +(incomeBase * 0.10).toFixed(2);
        const afterTen = incomeBase - tenPercent;
        const fortyPercent = +(afterTen * 0.40).toFixed(2);

        // Create 10% row
        const tenRow = document.createElement('tr');
        tenRow.innerHTML = `
            <td class="row-number">1</td>
            <td><input type="text" class="table-input" value="10% (Tithes of Tithes)" readonly></td>
            <td><input type="number" class="table-input" value="${tenPercent}" readonly></td>
            <td></td>
        `;
        tbody.appendChild(tenRow);

        // Create 40% row
        const fortyRow = document.createElement('tr');
        fortyRow.innerHTML = `
            <td class="row-number">2</td>
            <td><input type="text" class="table-input" value="40% (Love Gift)" readonly></td>
            <td><input type="number" class="table-input" value="${fortyPercent}" readonly></td>
            <td></td>
        `;
        tbody.appendChild(fortyRow);

        // Update expenses data: remove old auto10 and auto40, add new ones
        financeData[currentDate].expenses = [
            { id: 'auto10', name: '10% (Tithes of Tithes)', amount: tenPercent, auto: true },
            { id: 'auto40', name: '40% (Love Gift)', amount: fortyPercent, auto: true },
            ...financeData[currentDate].expenses.filter(r => !r.auto)
        ];
    }

    // Add income row to table
    function addIncomeRowToTable(record, rowNum) {
        const tbody = document.getElementById('incomeTableBody');
        const row = document.createElement('tr');
        row.dataset.recordId = record.id;

        row.innerHTML = `
            <td class="row-number">${rowNum}</td>
            <td><input type="text" class="table-input" value="${record.name}" data-field="name" onchange="updateIncomeRecord(this)"></td>
            <td><input type="number" class="table-input" value="${record.tithes}" data-field="tithes" step="0.01" min="0" onchange="updateIncomeRecord(this)"></td>
            <td><input type="number" class="table-input" value="${record.offering}" data-field="offering" step="0.01" min="0" onchange="updateIncomeRecord(this)"></td>
            <td><input type="number" class="table-input" value="${record.others}" data-field="others" step="0.01" min="0" onchange="updateIncomeRecord(this)"></td>
            <td><input type="text" class="table-input" value="${record.note || ''}" data-field="note" placeholder="Purpose of Others" onchange="updateIncomeRecord(this)"></td>
            <td style="text-align: center;">
                <button class="delete-btn" onclick="deleteIncomeRecord('${record.id}')" title="Delete record">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;

        tbody.appendChild(row);
    }

    // Add expense row to table
    function addExpenseRowToTable(record, rowNum) {
        const tbody = document.getElementById('expenseTableBody');
        const row = document.createElement('tr');
        row.dataset.recordId = record.id;

        row.innerHTML = `
            <td class="row-number">${rowNum}</td>
            <td><input type="text" class="table-input" value="${record.name}" data-field="name" onchange="updateExpenseRecord(this)"></td>
            <td><input type="number" class="table-input" value="${record.amount}" data-field="amount" step="0.01" min="0" onchange="updateExpenseRecord(this)"></td>
            <td style="text-align: center;">
                <button class="delete-btn" onclick="deleteExpenseRecord('${record.id}')" title="Delete record">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;

        tbody.appendChild(row);
    }

    // Add empty income row for new entry
    function addEmptyIncomeRow() {
        const tbody = document.getElementById('incomeTableBody');
        const row = document.createElement('tr');
        row.classList.add('new-row');

        row.innerHTML = `
            <td class="row-number">${tbody.children.length + 1}</td>
            <td><input type="text" class="table-input" data-field="name" placeholder="Enter name" onchange="createNewIncomeRecord(this)"></td>
            <td><input type="number" class="table-input" data-field="tithes" step="0.01" min="0" placeholder="0.00" onchange="createNewIncomeRecord(this)"></td>
            <td><input type="number" class="table-input" data-field="offering" step="0.01" min="0" placeholder="0.00" onchange="createNewIncomeRecord(this)"></td>
            <td><input type="number" class="table-input" data-field="others" step="0.01" min="0" placeholder="0.00" onchange="createNewIncomeRecord(this)"></td>
            <td><input type="text" class="table-input" data-field="note" placeholder="Purpose of Others" onchange="createNewIncomeRecord(this)"></td>
            <td></td>
        `;
        tbody.appendChild(row);
    }

    // Add empty expense row for new entry
    function addEmptyExpenseRow() {
        const tbody = document.getElementById('expenseTableBody');
        const row = document.createElement('tr');
        row.classList.add('new-row');

        row.innerHTML = `
            <td class="row-number">${tbody.children.length + 1}</td>
            <td><input type="text" class="table-input" data-field="name" placeholder="Enter expense name" onchange="createNewExpenseRecord(this)"></td>
            <td><input type="number" class="table-input" data-field="amount" step="0.01" min="0" placeholder="0.00" onchange="createNewExpenseRecord(this)"></td>
            <td></td>
        `;
        tbody.appendChild(row);
    }

    // Create new income record from empty row inputs
    function createNewIncomeRecord(element) {
        const row = element.closest('tr');
        const name = row.querySelector('[data-field="name"]').value.trim();
        const tithes = parseFloat(row.querySelector('[data-field="tithes"]').value) || 0;
        const offering = parseFloat(row.querySelector('[data-field="offering"]').value) || 0;
        const others = parseFloat(row.querySelector('[data-field="others"]').value) || 0;
        const note = row.querySelector('[data-field="note"]').value.trim();

        if (name && (tithes > 0 || offering > 0 || others > 0)) {
            const record = {
                id: Date.now() + Math.random(),
                name: name,
                tithes: tithes,
                offering: offering,
                others: others,
                note: note
            };

            financeData[currentDate].income.push(record);
            convertToIncomeDataRow(row, record);
            addEmptyIncomeRow();
            initializeExpenseTables(); // Recompute 10% and 40% expense rows
            updateSummary();
            updateArchiveList();
        }
    }

    // Create new expense record from empty row inputs
    function createNewExpenseRecord(element) {
        const row = element.closest('tr');
        const name = row.querySelector('[data-field="name"]').value.trim();
        const amount = parseFloat(row.querySelector('[data-field="amount"]').value) || 0;

        if (name && amount > 0) {
            const record = {
                id: Date.now() + Math.random(),
                name: name,
                amount: amount
            };

            financeData[currentDate].expenses.push(record);
            convertToExpenseDataRow(row, record);
            addEmptyExpenseRow();
            updateSummary();
            updateArchiveList();
        }
    }

    // Convert empty income row to data row
    function convertToIncomeDataRow(row, record) {
        row.classList.remove('new-row');
        row.dataset.recordId = record.id;

        const actionCell = row.children[6];
        actionCell.innerHTML = `
            <button class="delete-btn" onclick="deleteIncomeRecord('${record.id}')" title="Delete record">
                <i class="fas fa-trash"></i>
            </button>
        `;
        actionCell.style.textAlign = 'center';

        row.querySelectorAll('.table-input').forEach(input => {
            input.onchange = function() { updateIncomeRecord(this); };
        });
    }

    // Convert empty expense row to data row
    function convertToExpenseDataRow(row, record) {
        row.classList.remove('new-row');
        row.dataset.recordId = record.id;

        const actionCell = row.children[3];
        actionCell.innerHTML = `
            <button class="delete-btn" onclick="deleteExpenseRecord('${record.id}')" title="Delete record">
                <i class="fas fa-trash"></i>
            </button>
        `;
        actionCell.style.textAlign = 'center';

        row.querySelectorAll('.table-input').forEach(input => {
            input.onchange = function() { updateExpenseRecord(this); };
        });
    }

    // Update income record on input change
    function updateIncomeRecord(element) {
        const row = element.closest('tr');
        const recordId = row.dataset.recordId;
        if (!recordId) return;

        const record = financeData[currentDate].income.find(r => r.id == recordId);
        if (!record) return;

        const field = element.dataset.field;
        let value = element.value;

        if (field === 'tithes' || field === 'offering' || field === 'others') {
            value = parseFloat(value) || 0;
        } else if (field === 'note') {
            record[field] = value.trim();
            updateSummary();
            return;
        }

        record[field] = value;
        initializeExpenseTables(); // Recompute 10% and 40% expense rows on income change
        updateSummary();
    }

    // Update expense record on input change
    function updateExpenseRecord(element) {
        const row = element.closest('tr');
        const recordId = row.dataset.recordId;
        if (!recordId) return;

        if (recordId === 'auto10' || recordId === 'auto40') {
            alert("This record is auto-generated and cannot be edited.");
            initializeExpenseTables();
            return;
        }

        const record = financeData[currentDate].expenses.find(r => r.id == recordId);
        if (!record) return;

        const field = element.dataset.field;
        let value = element.value;

        if (field === 'amount') {
            value = parseFloat(value) || 0;
        }

        record[field] = value;
        updateSummary();
    }

    // Delete income record
    function deleteIncomeRecord(recordId) {
        if (confirm('Are you sure you want to delete this income record?')) {
            financeData[currentDate].income = financeData[currentDate].income.filter(record => record.id != recordId);
            initializeIncomeTables();
            initializeExpenseTables(); // Recompute 10% and 40% expense rows
            updateSummary();
            updateArchiveList();
        }
    }

    // Delete expense record
    function deleteExpenseRecord(recordId) {
        if (recordId === 'auto10' || recordId === 'auto40') {
            alert("This record is auto-generated and cannot be deleted.");
            return;
        }

        if (confirm('Are you sure you want to delete this expense record?')) {
            financeData[currentDate].expenses = financeData[currentDate].expenses.filter(record => record.id != recordId);
            initializeExpenseTables();
            updateSummary();
            updateArchiveList();
        }
    }

    // Update summary section
    function updateSummary() {
        const dayData = financeData[currentDate];
        if (!dayData) return;

        let totalTithes = 0, totalOffering = 0, totalOthers = 0;

        // Sum income parts
        dayData.income.forEach(record => {
            totalTithes += record.tithes;
            totalOffering += record.offering;
            totalOthers += record.others;
        });

        // Total income = tithes + offering only (exclude others)
        const incomeBase = totalTithes + totalOffering;

        // 10% fixed expense (auto)
        const tenPercent = +(incomeBase * 0.10).toFixed(2);
        // 40% fixed expense (auto) from remaining after 10%
        const afterTen = incomeBase - tenPercent;
        const fortyPercent = +(afterTen * 0.40).toFixed(2);

        // Sum user-defined expenses (exclude auto)
        let userExpenses = 0;
        dayData.expenses.forEach(r => {
            if (!r.auto) userExpenses += r.amount;
        });

        // Total expenses = 10% + 40% fixed + user expenses
        const totalExpenses = tenPercent + fortyPercent + userExpenses;

        // Net balance = incomeBase - totalExpenses
        const netBalance = incomeBase - totalExpenses;

        // Update DOM
        document.getElementById("tithesAmount").textContent = `₱${totalTithes.toFixed(2)}`;
        document.getElementById("offeringAmount").textContent = `₱${totalOffering.toFixed(2)}`;
        document.getElementById("othersAmount").textContent = `₱${totalOthers.toFixed(2)}`;
        document.getElementById("totalIncome").textContent = `₱${incomeBase.toFixed(2)}`;
        document.getElementById("totalExpenses").textContent = `₱${totalExpenses.toFixed(2)}`;
        document.getElementById("netBalance").textContent = `₱${netBalance.toFixed(2)}`;
    }

    // Archive List rendering
    function updateArchiveList() {
        const archiveList = document.getElementById("archiveList");
        if (!archiveList) return;

        // Clear existing list
        archiveList.innerHTML = "";

        // Load saved records from database
        fetch('/cashflow/previous-records')
            .then(response => response.json())
            .then(data => {
                const allDates = new Set();

                // Add database records
                if (data.success && data.records) {
                    data.records.forEach(record => {
                        allDates.add(record.record_date);
                    });
                }

                // Add current session data
                Object.keys(financeData).forEach(date => {
                    allDates.add(date);
                });

                // Sort all unique dates descending
                const sortedDates = Array.from(allDates).sort().reverse();

                sortedDates.forEach(date => {
                    const div = document.createElement("div");
                    div.classList.add("archive-item");

                    // Check if date exists in DB records
                    const dbRecord = data.records?.find(r => r.record_date === date);
                    const statusIcon = dbRecord
                        ? '<i class="fas fa-check-circle text-green-500"></i>'
                        : '<i class="fas fa-edit text-yellow-500"></i>';

                    div.innerHTML = `
                        <a href="#" onclick="selectDateFromArchive('${date}')">
                            <i class="fas fa-calendar-alt"></i> ${date} ${statusIcon}
                        </a>
                    `;
                    archiveList.appendChild(div);
                });
            })
            .catch(error => {
                console.error('Error loading previous records:', error);

                // Fallback to session data only
                const dates = Object.keys(financeData).sort().reverse();
                dates.forEach(date => {
                    const div = document.createElement("div");
                    div.classList.add("archive-item");
                    div.innerHTML = `
                        <a href="#" onclick="selectDateFromArchive('${date}')">
                            <i class="fas fa-calendar-alt"></i> ${date}
                        </a>
                    `;
                    archiveList.appendChild(div);
                });
            });
    }

    function selectDateFromArchive(date) {
        currentDate = date;
        document.getElementById('selectedDate').value = date;

        // Initialize empty data structure if it doesn't exist
        if (!financeData[currentDate]) {
            financeData[currentDate] = {
                income: [],
                expenses: []
            };
        }

        // Load the data for the selected date
        loadRecordsForDate();
    }

    // Add Row Buttons
    function addIncomeRow() {
        addEmptyIncomeRow();
    }

    function addExpenseRow() {
        addEmptyExpenseRow();
    }

    // Clear Buttons
    function clearIncomeData() {
        if (confirm("Clear all income records for this date?")) {
            financeData[currentDate].income = [];
            initializeIncomeTables();
            initializeExpenseTables(); // Recompute 10% and 40% expense rows
            updateSummary();
            updateArchiveList();
        }
    }

    function clearExpenseData() {
        if (confirm("Clear all expense records for this date?")) {
            // Remove all manual expenses, keep auto10 and auto40
            financeData[currentDate].expenses = financeData[currentDate].expenses.filter(r => r.auto);
            initializeExpenseTables();
            updateSummary();
            updateArchiveList();
        }
    }

    // Export Buttons
    function exportIncomeData() {
        const records = financeData[currentDate]?.income || [];
        if (records.length === 0) return alert("No income data to export.");

        let csv = "Name,Tithes,Offering,Others,Note\n";
        records.forEach(r => {
            csv += `${r.name},${r.tithes},${r.offering},${r.others},"${r.note || ''}"\n`;
        });

        downloadCSV(csv, `income_${currentDate}.csv`);
    }

    function exportExpenseData() {
        const records = financeData[currentDate]?.expenses || [];
        if (records.length === 0) return alert("No expense data to export.");

        let csv = "Name,Amount\n";
        records.forEach(r => {
            csv += `${r.name},${r.amount}\n`;
        });

        downloadCSV(csv, `expenses_${currentDate}.csv`);
    }

    function downloadCSV(csv, filename) {
        const blob = new Blob([csv], { type: 'text/csv' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.setAttribute('href', url);
        link.setAttribute('download', filename);r
        link.click();
        URL.revokeObjectURL(url);
    }

    // Optional Report Generator
    function generateReport() {
        // Redirect to reports page
        window.location.href = '/treasurer/reports';
    }

    function loadExistingCashflowData() {
        fetch(`/cashflow/data/${currentDate}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data) {
                    const cashflowData = data.data;

                    // Load detailed entries if available
                    loadDetailedEntries(currentDate);

                    console.log('Existing cashflow data loaded:', cashflowData);
                    // You can optionally show this data or use it for reference
                } else {
                    console.log('No existing cashflow data for this date');
                }
            })
            .catch(error => {
                console.log('Error loading cashflow data:', error);
            });
    }

    // Save all records to database (dummy implementation)
    function saveAllRecordsToDatabase() {
        const dayData = financeData[currentDate];
        if (!dayData) {
            alert('No data to save for this date.');
            return;
        }

        // Calculate income totals
        let totalTithes = 0, totalOffering = 0, totalOthers = 0;
        dayData.income.forEach(record => {
            totalTithes += record.tithes;
            totalOffering += record.offering;
            totalOthers += record.others;
        });

        const totalIncome = totalTithes + totalOffering; // Exclude others from income total

        // Calculate total expenses
        let totalExpenses = 0;
        dayData.expenses.forEach(record => {
            totalExpenses += record.amount;
        });

        const balance = totalIncome - totalExpenses;

        // Prepare data for saving
        const cashflowData = {
            record_date: currentDate,
            total_income: totalIncome,
            tithes: totalTithes,
            offering: totalOffering,
            others: totalOthers,
            total_expenses: totalExpenses,
            balance: balance
        };

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

        // Button loading state
        const saveButton = document.querySelector('button[onclick="saveAllRecordsToDatabase()"]');
        const originalText = saveButton.innerHTML;
        saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
        saveButton.disabled = true;

        // Send main cashflow data
        fetch('/cashflow/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(cashflowData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Save detailed income/expense records
                saveDetailedEntries(currentDate, csrfToken);

                // Update archive list UI
                updateArchiveList();

                alert('Cashflow record and all entries saved successfully!');
                console.log('Saved data:', data.data);
            } else {
                alert('Error saving record: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error saving record. Please try again.');
        })
        .finally(() => {
            // Restore button state
            saveButton.innerHTML = originalText;
            saveButton.disabled = false;
        });
    }

// Save detailed income and expense entries
function saveDetailedEntries(date, csrfToken) {
    const dayData = financeData[date];
    
    // Prepare income entries data
    const incomeEntries = dayData.income.map(record => ({
        record_date: date,
        name: record.name,
        tithes: record.tithes,
        offering: record.offering,
        others: record.others,
        note: record.note || ''
    }));

    // Prepare expense entries data (exclude auto-generated ones)
    const expenseEntries = dayData.expenses
        .filter(record => !record.auto)
        .map(record => ({
            expense_name: record.name,
            amount: record.amount,
        }));

    // ✅ Save income entries
    if (incomeEntries.length > 0) {
        fetch('/cashflow/save-income-entries', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ entries: incomeEntries })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Income entries saved successfully');
            }
        })
        .catch(error => console.error('Error saving income entries:', error));
    }

    // ✅ Save expense entries to expense table
    if (expenseEntries.length > 0) {
        fetch('/expense/save-entries', {   // 👉 hiwalay na endpoint para sa expenses table
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ entries: expenseEntries })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Expense entries saved successfully to expenses table');
            }
        })
        .catch(error => console.error('Error saving expense entries:', error));
    }
}

    // Delete record from database and archive
    function deleteRecordFromArchive(date) {
        if (confirm(`Are you sure you want to delete all records for ${date}? This action cannot be undone.`)) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
            
            fetch(`/cashflow/delete/${date}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove from current session data
                    delete financeData[date];
                    
                    // Update archive list
                    updateArchiveList();
                    
                    // If deleted date was current date, reset to today
                    if (currentDate === date) {
                        currentDate = new Date().toISOString().split('T')[0];
                        document.getElementById('selectedDate').value = currentDate;
                        loadRecordsForDate();
                    }
                    
                    alert('Record deleted successfully!');
                } else {
                    alert('Error deleting record: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting record. Please try again.');
            });
        }
    }
</script>
</body>
</html>