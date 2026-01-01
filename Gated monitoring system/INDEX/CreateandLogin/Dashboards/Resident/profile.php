<?php
session_start();
// Check if user is logged in and is a resident
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'resident') {
    header("Location: ../../login.html");
    exit();
}

require_once "../../connect.php";

try {
    // Get resident's information using user_id from session
    $stmt = $pdo->prepare("SELECT r.* FROM resident r 
                          INNER JOIN users u ON r.email = u.email 
                          WHERE u.id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $resident = $stmt->fetch(PDO::FETCH_ASSOC);

    // Store resident data in variables
    $firstName = $resident['firstName'] ?? 'Not Available';
    $lastName = $resident['lastName'] ?? 'Not Available';
    $email = $resident['email'] ?? 'Not Available';
    $telephone = $resident['telephone'] ?? 'Not Available';
    $courtNo = $resident['courtNo'] ?? 'Not Available';
    $houseNo = $resident['houseNo'] ?? 'Not Available';
    $national_ID = $resident['national_ID'] ?? 'Not Available';

} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    // Set default values if query fails
    $firstName = $lastName = $email = $telephone = $courtNo = $houseNo = $national_ID = 'Error loading data';
}
?>

<?php
// ... (same code as before)
?>
<style>
    .main-container {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        position: relative;
        margin-top: 20px;

    }
        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .report-container {
          
            width: 80%;
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .report-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .items {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .item1 {
            width: 100%;
            max-width: 300px;
            margin: 10px;
            padding: 15px;
            background-color: #f5f5f5;
            border-radius: 5px;
            text-align: center;
        }

        .item1 i {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .t-op {
            font-weight: bold;
        }
    </style>

















































    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="logosec">
            <div class="logo">Gated Monitoring<i class='bx bxs-cctv'></i></div>
            <div class="menu" id="menuicn"><i class='bx bx-menu'></i></div>
        </div>
    </header>
        <div class="main">
            <div class="report-container">
                <div class="report-header">
                    <h1>Resident Profile</h1>
                </div>
                <div class="items">
                    <div class="item1">
                        <i class='bx bxs-user'></i>
                        <span class="t-op">Full Name: <?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></span>
                    </div>
                    <div class="item1">
                        <i class='bx bxs-id-card'></i>
                        <span class="t-op">National ID: <?php echo htmlspecialchars($national_ID); ?></span>
                    </div>
                    <div class="item1">
                        <i class='bx bxs-phone'></i>
                        <span class="t-op">Phone: <?php echo htmlspecialchars($telephone); ?></span>
                    </div>
                    <div class="item1">
                        <i class='bx bxs-envelope'></i>
                        <span class="t-op">Email: <?php echo htmlspecialchars($email); ?></span>
                    </div>
                    <div class="item1">
                        <i class='bx bxs-buildings'></i>
                        <span class="t-op">Court No: <?php echo htmlspecialchars($courtNo); ?></span>
                    </div>
                    <div class="item1">
                        <i class='bx bxs-home'></i>
                        <span class="t-op">House No: <?php echo htmlspecialchars($houseNo); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../dashboard.js"></script>
</body>
</html>
