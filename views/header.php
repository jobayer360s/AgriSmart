<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AgriSmart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= htmlspecialchars(csrfToken(), ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<nav>
    <ul>
        <li><a class="logo" href="/">🌾 AgriSmart</a></li>
        <li>
            <a href="/">Home</a>
            <a href="/marketplace">Marketplace</a>
            <a href="/weather">Weather</a>
            <a href="/disease/finder">Disease Finder</a>
        </li>
        <li>
            <?php if (isAuthenticated()): ?>
                <a href="/dashboard">Dashboard</a>
                <a href="/logout">Logout</a>
            <?php else: ?>
                <a href="/login">Login</a>
                <a href="/register">Sign Up</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>
<div class="container">
