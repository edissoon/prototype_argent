<!doctype html>
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
            <a href="{{ route('treasurer.home') }}" class="back-btn" id="backBtn">
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
                                    <th style="width: 50px; text-align:center;">#</th>
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
                                    <th style="width: 50px; text-align: center;">#</th>
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

                <button class="btn w-full mt-4" id="saveBtn">
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
        /*
        Core JS logic:
        - maintain incomeRows[] and expenseRows[]
        - top two expense rows are auto (10% and 40%) and non-deletable
        - compute totals live
        - Save to server via AJAX (fetch)
        */

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let incomeRows = []; // {name, tithes, offering, others, note}
        let expenseRows = []; // manual entries (not including auto rows)
        let autoExpenseRows = []; // will contain 2 auto rows: tithe-of-tithes and 40% of remaining

        const incomeTableBody = document.getElementById('incomeTableBody');
        const expenseTableBody = document.getElementById('expenseTableBody');

        const totalIncomeEl = document.getElementById('totalIncome');
        const tithesAmountEl = document.getElementById('tithesAmount');
        const offeringAmountEl = document.getElementById('offeringAmount');
        const othersAmountEl = document.getElementById('othersAmount');
        const totalExpensesEl = document.getElementById('totalExpenses');
        const netBalanceEl = document.getElementById('netBalance');
        const selectedDateInput = document.getElementById('selectedDate');
        const dateDisplay = document.getElementById('dateDisplay');
        const archiveListEl = document.getElementById('archiveList');
        const saveBtn = document.getElementById('saveBtn');

        document.addEventListener('DOMContentLoaded', () => {
            // default: add one income row and one expense row
            addIncomeRow();
            addExpenseRow();
            selectedDateInput.valueAsDate = new Date();
            updateDateDisplay();
            computeAll();
            loadArchive();
        });

        function updateDateDisplay() {
            const d = new Date(selectedDateInput.value);
            dateDisplay.textContent = d.toLocaleDateString();
        }

        // INCOME FUNCTIONS
        function addIncomeRow(data = null) {
            const row = data ?? { name: '', tithes: 0, offering: 0, others: 0, note: '' };
            incomeRows.push(row);
            renderIncomeTable();
        }

        function deleteIncomeRow(index) {
            incomeRows.splice(index, 1);
            renderIncomeTable();
            computeAll();
        }

        function clearIncomeData() {
            incomeRows = [];
            addIncomeRow();
            computeAll();
        }

        function exportIncomeData() {
            // quick CSV export
            let csv = 'Name,Tithes,Offering,Others,Note\n';
            incomeRows.forEach(r => {
                csv += `"${r.name}",${r.tithes},${r.offering},${r.others},"${(r.note||'').replace(/"/g,'""')}"\n`;
            });
            const blob = new Blob([csv], {type: 'text/csv'});
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'income_export.csv';
            a.click();
            URL.revokeObjectURL(url);
        }

        function renderIncomeTable() {
            incomeTableBody.innerHTML = '';
            incomeRows.forEach((r, i) => {
                const tr = document.createElement('tr');
                tr.className = (i % 2 === 0) ? 'new-row' : '';
                tr.innerHTML = `
                    <td class="row-number">${i+1}</td>
                    <td><input type="text" class="table-input" value="${escapeHtml(r.name)}" oninput="onIncomeChange(${i}, 'name', this.value)" /></td>
                    <td><input type="number" min="0" step="0.01" class="table-input" value="${Number(r.tithes).toFixed(2)}" oninput="onIncomeChange(${i}, 'tithes', this.value)" /></td>
                    <td><input type="number" min="0" step="0.01" class="table-input" value="${Number(r.offering).toFixed(2)}" oninput="onIncomeChange(${i}, 'offering', this.value)" /></td>
                    <td><input type="number" min="0" step="0.01" class="table-input" value="${Number(r.others).toFixed(2)}" oninput="onIncomeChange(${i}, 'others', this.value)" /></td>
                    <td><input type="text" class="table-input" value="${escapeHtml(r.note||'')}" oninput="onIncomeChange(${i}, 'note', this.value)" /></td>
                    <td><button class="delete-btn" onclick="deleteIncomeRow(${i})"><i class="fas fa-trash"></i></button></td>
                `;
                incomeTableBody.appendChild(tr);
            });
        }

        // when income input changes
        function onIncomeChange(index, key, value) {
            if (!incomeRows[index]) return;
            if (['tithes','offering','others'].includes(key)) {
                incomeRows[index][key] = parseFloat(value || 0);
            } else {
                incomeRows[index][key] = value;
            }
            computeAll();
        }

        // EXPENSE FUNCTIONS
        function addExpenseRow(data = null) {
            const row = data ?? { expense_name: '', amount: 0, note: '', is_auto: false };
            expenseRows.push(row);
            renderExpenseTable();
        }

        function deleteExpenseRow(index) {
            expenseRows.splice(index, 1);
            renderExpenseTable();
            computeAll();
        }

        function clearExpenseData() {
            expenseRows = [];
            addExpenseRow();
            computeAll();
        }

        function exportExpenseData() {
            let csv = 'Expense Name,Amount,Note\n';
            // include auto rows first
            autoExpenseRows.forEach(r => {
                csv += `"${r.expense_name}",${r.amount},"${(r.note||'').replace(/"/g,'""')}"\n`;
            });
            expenseRows.forEach(r => {
                csv += `"${r.expense_name}",${r.amount},"${(r.note||'').replace(/"/g,'""')}"\n`;
            });
            const blob = new Blob([csv], {type: 'text/csv'});
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'expense_export.csv';
            a.click();
            URL.revokeObjectURL(url);
        }

        function renderExpenseTable() {
            expenseTableBody.innerHTML = '';
            // render auto rows at top (non-deletable)
            autoExpenseRows.forEach((r, i) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="row-number">${i+1}</td>
                    <td><input type="text" class="table-input" value="${escapeHtml(r.expense_name)}" readonly /></td>
                    <td><input type="number" class="table-input" value="${Number(r.amount).toFixed(2)}" readonly /></td>
                    <td></td>
                `;
                expenseTableBody.appendChild(tr);
            }); 

            // normal expense rows
            expenseRows.forEach((r, i) => {
                const idx = autoExpenseRows.length + i + 1;
                const tr = document.createElement('tr');
                tr.className = (i % 2 === 0) ? 'new-row' : '';
                tr.innerHTML = `
                    <td class="row-number">${idx}</td>
                    <td><input type="text" class="table-input" value="${escapeHtml(r.expense_name)}" oninput="onExpenseChange(${i}, 'expense_name', this.value)" /></td>
                    <td><input type="number" min="0" step="0.01" class="table-input" value="${Number(r.amount).toFixed(2)}" oninput="onExpenseChange(${i}, 'amount', this.value)" /></td>
                    <td><button class="delete-btn" onclick="deleteExpenseRow(${i})"><i class="fas fa-trash"></i></button></td>
                `;
                expenseTableBody.appendChild(tr);
            });
        }

        // expense input change
        function onExpenseChange(index, key, value) {
            if (!expenseRows[index]) return;
            if (key === 'amount') expenseRows[index].amount = parseFloat(value || 0);
            else expenseRows[index][key] = value;
            computeAll();
        }

        // COMPUTE FUNCTIONS
        function computeAutoExpenses(tithesTotal, offeringTotal) {
            const total = (Number(tithesTotal) || 0) + (Number(offeringTotal) || 0);

            const tenPercent = round2(total * 0.10); // tithe of tithes
            const remainingAfterTen = round2(total - tenPercent);
            const fortyPercent = round2(remainingAfterTen * 0.40);

            autoExpenseRows = [
                { expense_name: 'Tithe of Tithes (10%)', amount: tenPercent, is_auto: true, note: 'Auto-generated' },
                { expense_name: 'Ministry Fund (40% of remaining)', amount: fortyPercent, is_auto: true, note: 'Auto-generated' }
            ];
        }

        function computeAll() {
            // totals from incomeRows
            let totalTithes = 0, totalOffering = 0, totalOthers = 0;
            incomeRows.forEach(r => {
                totalTithes += Number(r.tithes || 0);
                totalOffering += Number(r.offering || 0);
                totalOthers += Number(r.others || 0);
            });

            const totalIncome = round2(totalTithes + totalOffering);

            // compute autos
            computeAutoExpenses(totalTithes, totalOffering);

            // total expenses = sum(auto + manual expenseRows)
            let manualExpenses = 0;
            expenseRows.forEach(r => manualExpenses += Number(r.amount || 0));
            let autoExpenseTotal = autoExpenseRows.reduce((s, r) => s + Number(r.amount || 0), 0);
            const totalExpenses = round2(manualExpenses + autoExpenseTotal);

            const netBalance = round2(totalIncome - totalExpenses);

            // render to DOM
            totalIncomeEl.textContent = formatCurrency(totalIncome);
            tithesAmountEl.textContent = formatCurrency(totalTithes);
            offeringAmountEl.textContent = formatCurrency(totalOffering);
            othersAmountEl.textContent = formatCurrency(totalOthers);
            totalExpensesEl.textContent = formatCurrency(totalExpenses);
            netBalanceEl.textContent = formatCurrency(netBalance);

            renderExpenseTable();
        }

        function round2(n) {
            return Math.round((Number(n) + Number.EPSILON) * 100) / 100;
        }

        function formatCurrency(n) {
            return '₱' + Number(n || 0).toFixed(2);
        }

        function escapeHtml(text) {
            if (text === null || text === undefined) return '';
            return String(text)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
        }

        // SAVE ALL RECORDS
        saveBtn.addEventListener('click', saveAllRecordsToDatabase);

        async function saveAllRecordsToDatabase() {
            // build payload
            const recordDate = selectedDateInput.value;
            if (!recordDate) {
                alert('Please choose a date first.');
                return;
            }

            // totals (recompute to be safe)
            let totalTithes = 0, totalOffering = 0, totalOthers = 0;
            incomeRows.forEach(r => {
                totalTithes += Number(r.tithes || 0);
                totalOffering += Number(r.offering || 0);
                totalOthers += Number(r.others || 0);
            });
            const totalIncome = round2(totalTithes + totalOffering);

            computeAutoExpenses(totalTithes, totalOffering);
            let autoExpenseTotal = autoExpenseRows.reduce((s, r) => s + Number(r.amount || 0), 0);
            let manualExpenseTotal = expenseRows.reduce((s, r) => s + Number(r.amount || 0), 0);
            const totalExpenses = round2(autoExpenseTotal + manualExpenseTotal);
            const netBalance = round2(totalIncome - totalExpenses);

            // prepare expense_entries array (auto rows first)
            const expense_entries = [];
            autoExpenseRows.forEach(r => expense_entries.push({
                expense_name: r.expense_name,
                amount: Number(r.amount),
                is_auto: true,
                note: r.note || null
            }));
            expenseRows.forEach(r => expense_entries.push({
                expense_name: r.expense_name || 'Unnamed expense',
                amount: Number(r.amount || 0),
                is_auto: false,
                note: r.note || null
            }));

            const payload = {
                record_date: recordDate,
                total_income: totalIncome,
                total_tithes: round2(totalTithes),
                total_offering: round2(totalOffering),
                total_others: round2(totalOthers),
                total_expenses: totalExpenses,
                net_balance: netBalance,
                income_records: incomeRows,
                expense_entries: expense_entries
            };

            saveBtn.disabled = true;
            saveBtn.textContent = 'Saving...';

            try {
                const res = await fetch('{{ route("treasurer.cshflw.save") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await res.json();
                if (res.ok && data.success) {
                    alert('Saved successfully!');
                    loadArchive();
                } else {
                    console.error(data);
                    alert('Error saving: ' + (data.message || JSON.stringify(data.errors || data)));
                }
            } catch (err) {
                console.error(err);
                alert('Network/server error. Check console.');
            } finally {
                saveBtn.disabled = false;
                saveBtn.innerHTML = '<i class="fas fa-save"></i> Save All Records';
            }
        }

        // LOAD existing records for the chosen date
        async function loadRecordsForDate() {
            const d = selectedDateInput.value;
            updateDateDisplay();
            if (!d) return;

            try {
                const res = await fetch('{{ route("treasurer.cshflw.load") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ date: d })
                });
                const json = await res.json();
                if (json.found) {
                    // populate UI with saved data
                    incomeRows = json.cashflow.income_records || [];
                    // expense rows: separate auto from manual; auto rows will come with is_auto true
                    const expenses = json.expenses || [];
                    autoExpenseRows = expenses.filter(e => e.is_auto).map(e => ({
                        expense_name: e.expense_name, amount: Number(e.amount), is_auto: true, note: e.note
                    }));
                    expenseRows = expenses.filter(e => !e.is_auto).map(e => ({
                        expense_name: e.expense_name, amount: Number(e.amount), note: e.note, is_auto: false
                    }));

                    renderIncomeTable();
                    renderExpenseTable();
                    computeAll();
                    alert('Loaded saved record for ' + new Date(d).toLocaleDateString());
                } else {
                    // no saved record for this date
                    incomeRows = [];
                    expenseRows = [];
                    addIncomeRow();
                    addExpenseRow();
                    computeAll();
                    alert('No saved record for this date. You can enter new data and save.');
                }
            } catch (err) {
                console.error(err);
                alert('Error loading data. See console.');
            }
        }

        // ARCHIVE
        async function loadArchive() {
            try {
                const res = await fetch('{{ route("treasurer.cshflw.archive") }}', {
                    method: 'GET',
                    headers: { 'Accept': 'application/json' }
                });
                const json = await res.json();
                archiveListEl.innerHTML = '';
                (json.list || []).forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'archive-item';
                    div.innerHTML = `
                        <div>
                        <div class="archive-date">${new Date(item.record_date).toLocaleDateString()}</div>
                        </div>
                        <div class="archive-amount">₱${Number(item.net_balance).toFixed(2)}</div>
                    `;
                    div.addEventListener('click', () => {
                        selectedDateInput.value = item.record_date;
                        loadRecordsForDate();
                    });
                    archiveListEl.appendChild(div);
                });
            } catch (err) {
                console.error(err);
            }
        }

        function generateReport() {
            // simple report: just open printable window
            let html = '<h1>Cashflow Report - ' + new Date(selectedDateInput.value).toLocaleDateString() + '</h1>';
            html += `<p>Total Income: ${totalIncomeEl.textContent}</p>`;
            html += `<p>Total Expenses: ${totalExpensesEl.textContent}</p>`;
            html += `<p>Net Balance: ${netBalanceEl.textContent}</p>`;
            const win = window.open('', '_blank');
            win.document.write(html);
            win.print();
        }
    </script>
    </body>
    </html>