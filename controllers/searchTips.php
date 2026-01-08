<?php
require_once(__DIR__ . '/../models/tipModel.php');

if(isset($_POST['query'])) {
    $query = trim($_POST['query']);
    
    if(empty($query)) {
        echo '';
        exit;
    }
    
    $tips = getAllTips();
    $filtered = array_filter($tips, function($tip) use ($query) {
        return stripos($tip['title'], $query) !== false || 
               stripos($tip['content'], $query) !== false ||
               stripos($tip['category'], $query) !== false;
    });
    
    if(count($filtered) > 0) {
        echo '<div class="tips-list">';
        foreach($filtered as $tip) {
            echo '<div class="tip-card">';
            echo '<div class="tip-header">';
            echo '<h3>' . htmlspecialchars($tip['title']) . '</h3>';
            echo '<span class="badge">' . $tip['category'] . '</span>';
            echo '</div>';
            echo '<div class="tip-content">' . nl2br(htmlspecialchars(substr($tip['content'], 0, 200))) . '...</div>';
            echo '<div class="tip-footer">';
            echo '<span>By: <strong>' . htmlspecialchars($tip['expert_name']) . '</strong></span>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>No tips found.</p>';
    }
}
?>
