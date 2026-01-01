<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
    </style>
</head>
<body>

<div class="report-container">
    <div class="report-header">
        <h1>Manage Users</h1>
    </div>
    <div class="items">
        <div class="item1">
            <a href="Resident.html"> <i class='bx bxs-user-plus'></i><h3>Add New Resident</h3></a>
        </div>
        
        <div class="item1">
            <a href="security.html"><i class='bx bxs-shield'></i><h3>Add Security Personnel</h3></a>
        </div>
    </div>
</div>
</body>
</html>
