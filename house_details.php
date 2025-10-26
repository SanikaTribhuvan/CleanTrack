<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Household Details - CleanTrack</title>
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
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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
            color: #11998e;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #11998e;
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

        .filter-section {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-section input,
        .filter-section select {
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
        }

        .filter-section input {
            flex: 1;
            min-width: 250px;
        }

        .filter-section select {
            min-width: 150px;
        }

        .filter-section input:focus,
        .filter-section select:focus {
            outline: none;
            border-color: #11998e;
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
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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
            background: #f8f9fa;
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .badge-active {
            background: #d4edda;
            color: #155724;
        }

        .badge-inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .qr-code {
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
            background: #f8f9fa;
            padding: 5px 8px;
            border-radius: 5px;
            color: #11998e;
            font-weight: 600;
        }

        .loading {
            text-align: center;
            padding: 50px;
            font-size: 1.2rem;
            color: #11998e;
        }

        .no-data {
            text-align: center;
            padding: 50px;
            color: #999;
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
            color: #11998e;
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

        .last-collection {
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
            <h1><i class="fas fa-home"></i> Household Details</h1>
        </div>

        <div class="stats-cards">
            <div class="stat-card">
                <i class="fas fa-home"></i>
                <h3 id="totalHouses">0</h3>
                <p>Total Households</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-check-circle"></i>
                <h3 id="activeHouses">0</h3>
                <p>Active Households</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-map-marked-alt"></i>
                <h3 id="totalAreas">0</h3>
                <p>Different Areas</p>
            </div>
        </div>

        <div class="filter-section">
            <input type="text" id="searchInput" placeholder="Search by house number, resident name, phone, or address...">
            <select id="areaFilter">
                <option value="">All Areas</option>
            </select>
            <select id="statusFilter">
                <option value="">All Status</option>
                <option value="ACTIVE">Active</option>
                <option value="INACTIVE">Inactive</option>
            </select>
        </div>

        <div class="table-container">
            <table id="householdsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>House No.</th>
                        <th>Resident Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Area</th>
                        <th>QR Code</th>
                        <th>Collections</th>
                        <th>Last Collection</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="householdsTableBody">
                    <tr>
                        <td colspan="10" class="loading">
                            <i class="fas fa-spinner fa-spin"></i> Loading households...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let allHouseholds = [];

        async function loadHouseholds() {
            try {
                const response = await fetch('api/get_houses.php');
                const result = await response.json();

                if (result.success) {
                    allHouseholds = result.data;
                    updateStats();
                    populateAreaFilter();
                    displayHouseholds(allHouseholds);
                } else {
                    showError('Failed to load households: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                showError('Failed to connect to server');
            }
        }

        function updateStats() {
            const totalHouses = allHouseholds.length;
            const activeHouses = allHouseholds.filter(h => h.status === 'ACTIVE').length;
            const areas = [...new Set(allHouseholds.map(h => h.area))];

            document.getElementById('totalHouses').textContent = totalHouses;
            document.getElementById('activeHouses').textContent = activeHouses;
            document.getElementById('totalAreas').textContent = areas.length;
        }

        function populateAreaFilter() {
            const areas = [...new Set(allHouseholds.map(h => h.area))].sort();
            const areaFilter = document.getElementById('areaFilter');
            
            areas.forEach(area => {
                const option = document.createElement('option');
                option.value = area;
                option.textContent = area;
                areaFilter.appendChild(option);
            });
        }

        function displayHouseholds(households) {
            const tbody = document.getElementById('householdsTableBody');

            if (households.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="10" class="no-data">
                            <i class="fas fa-inbox"></i><br>
                            No households found
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = households.map(house => `
                <tr>
                    <td><strong>${house.id}</strong></td>
                    <td><strong>${house.houseNumber}</strong></td>
                    <td>${house.residentName}</td>
                    <td>${house.phone}</td>
                    <td>${house.address}</td>
                    <td>${house.area}</td>
                    <td><span class="qr-code">${house.qrCode}</span></td>
                    <td><strong>${house.totalCollections}</strong></td>
                    <td class="last-collection">
                        ${house.lastCollection ? formatDate(house.lastCollection) : 'Never'}
                    </td>
                    <td>
                        <span class="badge ${house.status === 'ACTIVE' ? 'badge-active' : 'badge-inactive'}">
                            ${house.status}
                        </span>
                    </td>
                </tr>
            `).join('');
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-IN', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        }

        function showError(message) {
            const tbody = document.getElementById('householdsTableBody');
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
            const areaFilter = document.getElementById('areaFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;

            const filteredHouseholds = allHouseholds.filter(house => {
                const matchesSearch = 
                    house.houseNumber.toLowerCase().includes(searchTerm) ||
                    house.residentName.toLowerCase().includes(searchTerm) ||
                    house.phone.includes(searchTerm) ||
                    house.address.toLowerCase().includes(searchTerm);

                const matchesArea = !areaFilter || house.area === areaFilter;
                const matchesStatus = !statusFilter || house.status === statusFilter;

                return matchesSearch && matchesArea && matchesStatus;
            });

            displayHouseholds(filteredHouseholds);
        }

        // Event listeners for filters
        document.getElementById('searchInput').addEventListener('input', applyFilters);
        document.getElementById('areaFilter').addEventListener('change', applyFilters);
        document.getElementById('statusFilter').addEventListener('change', applyFilters);

        // Load households on page load
        window.addEventListener('DOMContentLoaded', loadHouseholds);

        // Auto-refresh every 30 seconds
        setInterval(loadHouseholds, 30000);
    </script>
</body>
</html>