<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../connect.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $created_by = $_POST['created_by'];

    try {
        $sql = "INSERT INTO process_event (title, description, event_date, created_by) 
                VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $description, $event_date, $created_by]);

        $message = "<div class='alert alert-success'>Event created successfully!</div>";
    } catch(PDOException $e) {
        $message = "<div class='alert alert-danger'>Error creating event: " . $e->getMessage() . "</div>";
    }
}

// Check for success or error messages from redirects
if (isset($_GET['success'])) {
    $message = "<div class='alert alert-success'>Event created successfully!</div>";
} elseif (isset($_GET['error'])) {
    $message = "<div class='alert alert-danger'>Error creating event. Please try again.</div>";
}
?>

<?php
// Fetch users from the database
$users = [];
try {
    $stmt = $pdo->query("SELECT id, username FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Error fetching users: " . $e->getMessage() . "</div>";
}
?>

<div class="wrapper">
    <?php
    if (!empty($message)) {
        echo $message;
    }
    ?>
    <!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <style>
        body {
    background: #2a1b3d;
    color: #fff;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.wrapper {
    background: #44318d;
    max-width: 600px;
    margin: 50px auto;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(98, 0, 238, 0.3);
}

h1 {
    color: #fff;
    text-align: center;
    margin-bottom: 30px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.input-box {
    margin-bottom: 25px;
}

.input-box label {
    color: #fff;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    background: #2a1b3d;
    border: 2px solid #8a2be2;
    color: #fff;
    padding: 12px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-control:focus {
    background: #321b4a;
    border-color: #9d4edd;
    box-shadow: 0 0 10px rgba(157, 78, 221, 0.4);
}

textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.btn-primary {
    background: #9d4edd;
    border: none;
    width: 100%;
    padding: 15px;
    border-radius: 8px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #a663cc;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(157, 78, 221, 0.4);
}

.alert {
    background: #321b4a;
    border-left: 4px solid #9d4edd;
    margin-bottom: 20px;
    padding: 15px;
    border-radius: 8px;
}

        </style>
    <div class="wrapper">
        <h1>Add Event</h1>
    <form action="process_event.php" method="POST">
        <div class="input-box">
            <label for="title">Event Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="input-box">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
        </div>

        <div class="input-box">
            <label for="event_date">Event Date:</label>
            <input type="date" class="form-control" id="event_date" name="event_date" required>
        </div>

        <div class="input-box">
            <label for="created_by">Created By:</label>
            <select class="form-control" id="created_by" name="created_by" required>
                <option value="">Select a user</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['username']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>
    <style>
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}
</style>
</div>
</body>
</html>
