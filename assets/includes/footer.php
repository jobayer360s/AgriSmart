<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - AgriSmart' : 'AgriSmart'; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
        <footer class="footer">
        <div class="footer-content">
            <div class="footer-main">
                <div class="footer-left">
                    <strong>🌾 AgriSmart</strong> - Empowering Farmers with Technology
                    
                </div>
                <div class="footer-center">
                    <a href="help.php">Help</a>
                    <a href="profile.php">Profile</a>
                    <a href="notifications.php">Notifications</a>
                    <a href="weather.php">Weather</a>
                    
                </div>
                <div class="footer-right">
                    &copy; <?php echo date('Y'); ?> AgriSmart | All rights reserved
                </div>
            </div>
        </div>
    </footer>
    
    <?php if(isset($includeAdminJS) && $includeAdminJS): ?>
        <script src="../assets/js/admin.js"></script>
    <?php endif; ?>
    <?php if(isset($includeChatJS) && $includeChatJS): ?>
        <script src="../assets/js/chat.js"></script>
    <?php endif; ?>
    
    <script>
    window.onscroll = function() {
        if(document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            if(!document.getElementById('backToTop')) {
                const btn = document.createElement('button');
                btn.id = 'backToTop';
                btn.innerHTML = '⬆️';
                btn.style.cssText = 'position:fixed;bottom:30px;right:30px;background:linear-gradient(135deg,#27ae60 0%,#229954 100%);color:white;border:none;border-radius:50%;width:50px;height:50px;font-size:1.5em;cursor:pointer;box-shadow:0 4px 15px rgba(0,0,0,0.2);z-index:999;';
                btn.onclick = function() { window.scrollTo({top: 0, behavior: 'smooth'}); };
                document.body.appendChild(btn);
            }
        } else {
            const btn = document.getElementById('backToTop');
            if(btn) btn.remove();
        }
    };
    </script>
</body>
</html>

