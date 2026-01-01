<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Request - Gated Community</title>
    <link rel="stylesheet" href="../dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
    <div class="logosec">
    <div class="logo">Gated Monitoring<i class='bx bxs-cctv'></i></div>
    </div>
    </header>

        <div class="main-container">
            <div class="report-container">
                <div class="report-header">
                    <h1>Maintenance Request</h1>
                </div>
                <div class="report-body">
                    <form action="maintenance_request.php" method="post">
                        <label for="maintenance_type">Maintenance Type:</label>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="priority">Priority:</label>
                            <select id="priority" name="priority" required>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit">Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>
</div>
    </div>
<style>
    .maintenance_request-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--primary-color);
        } 
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--Border-color);
            background: var(--background-color3);
            color: white;
            border-radius: 4px;
        }
        .form-group textarea {
            width: 100%;
            padding: 30px;
            border: 1px solid var(--Border-color);
            background: var(--background-color3);
            color: white;
            border-radius: 4px;
        }
        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        .button-submit {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background: var(--secondary-color);
            color: white;
        }
       
</style>
    <script src="../dashboard.js"></script>
</body>
</html>
