<?php
function get_user_image_path() {
    global $pdo; // <-- add this
    require_once "client/db.php"; 

    $userId = $_SESSION['id'];
    
    $stmt = $pdo->prepare("SELECT image_path FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $row['image_path'] ?? 'public/img/profile/default.png';
}

