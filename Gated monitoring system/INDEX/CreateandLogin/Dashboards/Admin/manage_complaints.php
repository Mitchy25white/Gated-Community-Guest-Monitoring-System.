<?php
require_once "../../connect.php";

$query = "SELECT c.*, u.username 
          FROM manage_complaints c 
          JOIN users u ON c.user_id = u.id 
          ORDER BY c.created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$complaints = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Complaints</title>
   
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
        .report-topic-headings {
            font-size: 24px;
            color: #9b59b6; /* Neon purple */
            text-shadow: 0 0 10px #9b59b6, 0 0 20px #8e44ad; /* Neon glow */
            margin-bottom: 20px;
            margin-top: 20px;
            text-align: center;
            text-decoration: underline;
            text-underline-offset:10px;
        }
        .table-responsive {
            overflow-x: auto;
        }       
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            color: #ecf0f1; /* Light text color */
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid #9b59b6; /* Neon purple border */

        }
        th {
            background-color: #2c3e50; /* Darker header background */
            
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #1a1a2e; /* Darker background on hover */
        }
        .td:last-child {
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
        }
        .view:hover {
            background-color: #8e44ad; /* Darker purple on hover */
        }


        

    </style>
</head>
<body>
    <div class="main">
    <div class="report-container">
        <div class="report-header">
            <h1>Manage Complaints</h1>
            <button class="view" onclick="location.href='add_complaint.php'">Add New</button>
        </div>
        <div class="report-body">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Resident</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($complaints as $complaint): ?>
                    <tr>
                        <td><?= $complaint['id'] ?></td>
                        <td><?= $complaint['username'] ?></td>
                        <td><?= $complaint['subject'] ?></td>
                        <td><?= $complaint['status'] ?></td>
                        <td><?= $complaint['created_at'] ?></td>
                        <td>
                            <a href="view_complaint.php?id=<?= $complaint['id'] ?>">View</a>
                            <a href="edit_complaint.php?id=<?= $complaint['id'] ?>">Edit</a>
                            <a href="delete_complaint.php?id=<?= $complaint['id'] ?>">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
