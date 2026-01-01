
<?php
// Remove session_start() since it's already active
require_once "../../connect.php"; // This will give you access to $pdo

// Use PDO instead of mysqli
$query = "SELECT r.*, u.username 
          FROM manage_reports r 
          JOIN users u ON r.user_id = u.id 
          ORDER BY r.created_at DESC";
          
$stmt = $pdo->prepare($query);
$stmt->execute();
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Reports - Admin Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
    body {
            background: #1a1a2e; /* Dark background */
            font-family: 'Times New Roman', Times, serif;
            color: #ffffff; /* White text */
        }
        .report-container {
            background: rgba(30, 30, 47, 0.9); /* Semi-transparent dark background */
            border: 2px solid #9b59b6; /* Neon purple border */
            border-radius: 10px; /* Rounded corners */
            padding: 20px; /* Inner padding */
            margin: 20px auto; /* Center the container */
            max-width: 600px; /* Max width for the container */
            box-shadow: 0 0 20px rgba(155, 89, 182, 0.7); /* Neon glow effect */
        }
        .report-header {
            text-align: center;
            margin-bottom: 20px;
            color: #9b59b6; /* Neon purple */
            text-shadow: 0 0 10px #9b59b6, 0 0 20px #8e44ad; /* Neon glow */
        }
        .items {
            display: flex;
            flex-direction: column;
            gap: 15px; /* Space between items */
        }
        .item1 {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1); /* Semi-transparent item background */
            padding: 10px; /* Inner padding */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(155, 89, 182, 0.5); /* Neon glow effect */
            transition: transform 0.2s; /* Smooth transition */
        }
        .item1:hover {
            transform: scale(1.05); /* Slightly enlarge on hover */
        }
        .item1 i {
            font-size: 24px; /* Icon size */
            margin-right: 10px; /* Space between icon and text */
            color: #9b59b6; /* Neon purple */
        }
        .t-op {
            font-size: 18px; /* Text size */
            color: #ecf0f1; /* Light text color */
        }
        .report-topic-heading {
            font-size: 24px;
            color: #9b59b6; /* Neon purple */
            text-shadow: 0 0 10px #9b59b6, 0 0 20px #8e44ad; /* Neon glow */
            margin-bottom: 20px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #9b59b6; /* Neon purple border */
            color: #ecf0f1; /* Light text color */
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s; /* Smooth transition */
            text-align: center;
            vertical-align: middle;
        }
        .table th {
            background-color: #2c3e50; /* Darker background for header */
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table tr:hover {
            background-color: #1a1a2e; /* Darker background on hover */
        }

        .table td:last-child {
            white-space: nowrap;
        }
        .view {
            background-color: #9b59b6; /* Neon purple */
            color: #ffffff; /* White text */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            box-shadow: 0 0 10px rgba(155, 89, 182, 0.7); /* Neon glow effect */
            }
            .view:hover { 
                background-color: #8e44ad; 

            }
            .view:active {
                background-color: #8e44ad;
            }
            .view:focus {
                outline: none;
            }
            .view:hover {
                background-color: #8e44ad;
            }
            .view:active {
                background-color: #8e44ad;
            }
            .view:focus {
                outline: none;
            }

    </style>
</head>
<body>
    <div class="main">
<div class="report-container">
    <div class="report-header">
        <h1 class="recent-Articles">Manage Reports</h1>
        <button class="view" onclick="location.href= 'add_report.php'">Add Report</button>  

    </div>
    <div class="report-body">
        <!-- Add your reports management content here -->
        <div class="report-topic-heading">
            System Reports Overview
        </div>
        <!-- Add report listing and management features -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Get reports using PDO
                    $query = "SELECT r.*, u.username 
                              FROM manage_reports r 
                              JOIN users u ON r.user_id = u.id 
                              ORDER BY r.created_at DESC";
                              
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Display reports
                    if (count($reports) > 0) {
                        foreach ($reports as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "<td>
                                    <a href='view_report.php?id=" . $row['id'] . "' class='btn btn-info'>View</a>
                                    <a href='edit_report.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>
                                    <a href='delete_report.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No reports found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>        </div>
    </div>
</div>
</div>
</div>
</div>
</body>
</html>