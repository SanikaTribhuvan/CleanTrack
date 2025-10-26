<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Details - CleanTrack</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
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
            color: #667eea;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #667eea;
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

        .search-box {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-box input {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
        }

        .search-box input:focus {
            outline: none;
            border-color: #667eea;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 0.95rem;
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

        .loading {
            text-align: center;
            padding: 50px;
            font-size: 1.2rem;
            color: #667eea;
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
            color: #667eea;
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
            <h1><i class="fas fa-id-card"></i> Driver Details</h1>
        </div>

        <div class="stats-cards">
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <h3 id="totalDrivers">0</h3>
                <p>Total Drivers</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-user-check"></i>
                <h3 id="activeDrivers">0</h3>
                <p>Active Drivers</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-trash-alt"></i>
                <h3 id="totalCollections">0</h3>
                <p>Total Collections</p>
            </div>
        </div>

        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search by name, phone, license, or vehicle number...">
        </div>

        <div class="table-container">
            <table id="driversTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>License No.</th>
                        <th>Vehicle No.</th>
                        <th>Collections</th>
                        <th>Status</th>
                        <th>Joined Date</th>
                    </tr>
                </thead>
                <tbody id="driversTableBody">
                    <tr>
                        <td colspan="9" class="loading">
                            <i class="fas fa-spinner fa-spin"></i> Loading drivers...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let allDrivers = [];

        async function loadDrivers() {
            try {
                const response = await fetch('api/get_drivers.php');
                const result = await response.json();

                if (result.success) {
                    allDrivers = result.data;
                    updateStats();
                    displayDrivers(allDrivers);
                } else {
                    showError('Failed to load drivers: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                showError('Failed to connect to server');
            }
        }

        function updateStats() {
            const totalDrivers = allDrivers.length;
            const activeDrivers = allDrivers.filter(d => d.status === 'ACTIVE').length;
            const totalCollections = allDrivers.reduce((sum, d) => sum + d.totalCollections, 0);

            document.getElementById('totalDrivers').textContent = totalDrivers;
            document.getElementById('activeDrivers').textContent = activeDrivers;
            document.getElementById('totalCollections').textContent = totalCollections;
        }

        function displayDrivers(drivers) {
            const tbody = document.getElementById('driversTableBody');

            if (drivers.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="9" class="no-data">
                            <i class="fas fa-inbox"></i><br>
                            No drivers found
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = drivers.map(driver => `
                <tr>
                    <td><strong>${driver.id}</strong></td>
                    <td>${driver.name}</td>
                    <td>${driver.phone}</td>
                    <td>${driver.email || '-'}</td>
                    <td>${driver.licenseNumber}</td>
                    <td>${driver.vehicleNumber}</td>
                    <td><strong>${driver.totalCollections}</strong></td>
                    <td>
                        <span class="badge ${driver.status === 'ACTIVE' ? 'badge-active' : 'badge-inactive'}">
                            ${driver.status}
                        </span>
                    </td>
                    <td>${formatDate(driver.createdAt)}</td>
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
            const tbody = document.getElementById('driversTableBody');
            tbody.innerHTML = `
                <tr>
                    <td colspan="9" class="no-data" style="color: #e74c3c;">
                        <i class="fas fa-exclamation-triangle"></i><br>
                        ${message}
                    </td>
                </tr>
            `;
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            
            const filteredDrivers = allDrivers.filter(driver => 
                driver.name.toLowerCase().includes(searchTerm) ||
                driver.phone.includes(searchTerm) ||
                driver.licenseNumber.toLowerCase().includes(searchTerm) ||
                driver.vehicleNumber.toLowerCase().includes(searchTerm) ||
                (driver.email && driver.email.toLowerCase().includes(searchTerm))
            );

            displayDrivers(filteredDrivers);
        });

        // Load drivers on page load
        window.addEventListener('DOMContentLoaded', loadDrivers);

        // Auto-refresh every 30 seconds
        setInterval(loadDrivers, 30000);
    </script>
</body>
</html>