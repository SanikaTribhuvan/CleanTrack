<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanned Households - CleanTrack</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .header h1 {
            color: #333;
            font-size: 2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header h1 i {
            color: #f5576c;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #f5576c;
            text-decoration: none;
            padding: 10px 20px;
            background: white;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .back-link:hover {
            transform: translateX(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-card i {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #f5576c;
        }

        .stat-card h3 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-card p {
            color: #666;
            font-size: 0.9rem;
        }

        .filter-section {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-section input,
        .filter-section select {
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
        }

        .filter-section input[type="date"] {
            min-width: 180px;
        }

        .filter-section input[type="text"] {
            flex: 1;
            min-width: 250px;
        }

        .filter-section select {
            min-width: 150px;
        }

        .filter-section input:focus,
        .filter-section select:focus {
            outline: none;
            border-color: #f5576c;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        thead {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 0.95rem;
            white-space: nowrap;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
        }

        tbody tr {
            transition: all 0.3s;
        }

        tbody tr:hover {
            background: #fff5f7;
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .badge-bio {
            background: #d4edda;
            color: #155724;
        }

        .badge-non-bio {
            background: #fff3cd;
            color: #856404;
        }

        .badge-mixed {
            background: #cce5ff;
            color: #004085;
        }

        .badge-recyclable {
            background: #d1ecf1;
            color: #0c5460;
        }

        .loading {
            text-align: center;
            padding: 50px;
            font-size: 1.2rem;
            color: #f5576c;
        }

        .no-data {
            text-align: center;
            padding: 50px;
            color: #999;
        }

        .time-display {
            font-size: 0.85rem;
            color: #666;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .table-container {
                font-size: 0.85rem;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.html" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>

        <div class="header">
            <h1><i class="fas fa-database"></i> Scanned Households</h1>
        </div>

        <div class="stats-cards">
            <div class="stat-card">
                <i class="fas fa-home"></i>
                <h3 id="housesScanned">0</h3>
                <p>Houses Scanned</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-trash-alt"></i>
                <h3 id="totalCollections">0</h3>
                <p>Total Collections</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-weight"></i>
                <h3 id="totalWeight">0 kg</h3>
                <p>Total Weight</p>
            </div>
        </div>

        <div class="filter-section">
            <input type="date" id="dateFilter" value="">
            <input type="text" id="searchInput" placeholder="Search by house, resident, area, or driver...">
            <select id="wasteTypeFilter">
                <option value="">All Waste Types</option>
                <option value="BIODEGRADABLE">Biodegradable</option>
                <option value="NON_BIODEGRADABLE">Non-Biodegradable</option>
                <option value="MIXED">Mixed</option>
                <option value="RECYCLABLE">Recyclable</option>
            </select>
        </div>

        <div class="table-container">
            <table id="collectionsTable">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>House No.</th>
                        <th>Resident</th>
                        <th>Area</th>
                        <th>Phone</th>
                        <th>Waste Type</th>
                        <th>Weight (kg)</th>
                        <th>Driver</th>
                        <th>Vehicle</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody id="collectionsTableBody">
                    <tr>
                        <td colspan="10" class="loading">
                            <i class="fas fa-spinner fa-spin"></i> Loading collections...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let allCollections = [];
        let currentDate = new Date().toISOString().split('T')[0];

        // Set default date to today
        document.getElementById('dateFilter').value = currentDate;

        async function loadCollections() {
            const date = document.getElementById('dateFilter').value || currentDate;
            
            try {
                const response = await fetch(`api/get_scanned_houses.php?date=${date}`);
                const result = await response.json();

                if (result.success) {
                    allCollections = result.data.collections;
                    updateStats(result.data.stats);
                    displayCollections(allCollections);
                } else {
                    showError('Failed to load collections: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                showError('Failed to connect to server');
            }
        }

        function updateStats(stats) {
            document.getElementById('housesScanned').textContent = stats.housesScanned;
            document.getElementById('totalCollections').textContent = stats.totalCollections;
            document.getElementById('totalWeight').textContent = stats.totalWeight.toFixed(2) + ' kg';
        }

        function displayCollections(collections) {
            const tbody = document.getElementById('collectionsTableBody');

            if (collections.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="10" class="no-data">
                            <i class="fas fa-inbox"></i><br>
                            No collections found for this date
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = collections.map(col => `
                <tr>
                    <td class="time-display">${formatTime(col.collectionDate)}</td>
                    <td><strong>${col.household.houseNumber}</strong></td>
                    <td>${col.household.residentName}</td>
                    <td>${col.household.area}</td>
                    <td>${col.household.phone}</td>
                    <td>
                        <span class="badge badge-${getBadgeClass(col.wasteType)}">
                            ${formatWasteType(col.wasteType)}
                        </span>
                    </td>
                    <td><strong>${col.weightKg ? col.weightKg + ' kg' : '-'}</strong></td>
                    <td>${col.driver.name}</td>
                    <td>${col.driver.vehicleNumber}</td>
                    <td>${col.notes || '-'}</td>
                </tr>
            `).join('');
        }

        function formatTime(dateString) {
            const date = new Date(dateString);
            return date.toLocaleTimeString('en-IN', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function formatWasteType(type) {
            return type.replace(/_/g, ' ').toLowerCase()
                .split(' ')
                .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                .join(' ');
        }

        function getBadgeClass(type) {
            const classes = {
                'BIODEGRADABLE': 'bio',
                'NON_BIODEGRADABLE': 'non-bio',
                'MIXED': 'mixed',
                'RECYCLABLE': 'recyclable'
            };
            return classes[type] || 'mixed';
        }

        function showError(message) {
            const tbody = document.getElementById('collectionsTableBody');
            tbody.innerHTML = `
                <tr>
                    <td colspan="10" class="no-data" style="color: #e74c3c;">
                        <i class="fas fa-exclamation-triangle"></i><br>
                        ${message}
                    </td>
                </tr>
            `;
        }

        function applyFilters() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const wasteTypeFilter = document.getElementById('wasteTypeFilter').value;

            const filteredCollections = allCollections.filter(col => {
                const matchesSearch = 
                    col.household.houseNumber.toLowerCase().includes(searchTerm) ||
                    col.household.residentName.toLowerCase().includes(searchTerm) ||
                    col.household.area.toLowerCase().includes(searchTerm) ||
                    col.household.phone.includes(searchTerm) ||
                    col.driver.name.toLowerCase().includes(searchTerm);

                const matchesWasteType = !wasteTypeFilter || col.wasteType === wasteTypeFilter;

                return matchesSearch && matchesWasteType;
            });

            displayCollections(filteredCollections);
        }

        // Event listeners
        document.getElementById('dateFilter').addEventListener('change', loadCollections);
        document.getElementById('searchInput').addEventListener('input', applyFilters);
        document.getElementById('wasteTypeFilter').addEventListener('change', applyFilters);

        // Load collections on page load
        window.addEventListener('DOMContentLoaded', loadCollections);

        // Auto-refresh every 30 seconds
        setInterval(loadCollections, 30000);
    </script>
</body>
</html>