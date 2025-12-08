<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMG - Performance Test</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 800px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 {
            color: #1e40af;
            margin-bottom: 10px;
            font-size: 32px;
        }
        .subtitle {
            color: #6b7280;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .test-section {
            background: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .test-section h2 {
            color: #374151;
            font-size: 18px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status.success {
            background: #d1fae5;
            color: #065f46;
        }
        .status.warning {
            background: #fef3c7;
            color: #92400e;
        }
        .status.error {
            background: #fee2e2;
            color: #991b1b;
        }
        .metric {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .metric:last-child {
            border-bottom: none;
        }
        .metric-label {
            color: #6b7280;
            font-size: 14px;
        }
        .metric-value {
            color: #111827;
            font-weight: 600;
            font-size: 14px;
        }
        .score {
            text-align: center;
            padding: 30px;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            border-radius: 12px;
            margin-top: 20px;
        }
        .score-number {
            font-size: 64px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .score-label {
            font-size: 18px;
            opacity: 0.9;
        }
        .recommendations {
            background: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .recommendations h3 {
            color: #92400e;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .recommendations ul {
            list-style: none;
            padding: 0;
        }
        .recommendations li {
            color: #78350f;
            font-size: 14px;
            padding: 5px 0;
            padding-left: 20px;
            position: relative;
        }
        .recommendations li:before {
            content: "→";
            position: absolute;
            left: 0;
            color: #f59e0b;
        }
        .btn {
            display: inline-block;
            background: #1e40af;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
            transition: all 0.3s;
        }
        .btn:hover {
            background: #1e3a8a;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚡ Performance Test Results</h1>
        <p class="subtitle">TMG Website Performance Analysis</p>

        <?php
        // Start performance measurement
        $start_time = microtime(true);
        
        // Test 1: Database Connection
        include 'config.php';
        $db_time = microtime(true) - $start_time;
        $db_status = $conn ? 'success' : 'error';
        
        // Test 2: GZIP Compression
        $gzip_enabled = extension_loaded('zlib') && ini_get('zlib.output_compression');
        
        // Test 3: OpCache
        $opcache_enabled = function_exists('opcache_get_status') && opcache_get_status();
        
        // Test 4: Session Performance
        $session_start = microtime(true);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $session_time = microtime(true) - $session_start;
        
        // Test 5: Memory Usage
        $memory_usage = memory_get_usage(true) / 1024 / 1024; // MB
        $memory_peak = memory_get_peak_usage(true) / 1024 / 1024; // MB
        
        // Test 6: PHP Version
        $php_version = phpversion();
        $php_ok = version_compare($php_version, '7.4.0', '>=');
        
        // Calculate overall score
        $score = 0;
        if ($db_status === 'success') $score += 25;
        if ($gzip_enabled) $score += 20;
        if ($opcache_enabled) $score += 20;
        if ($session_time < 0.01) $score += 15;
        if ($memory_usage < 10) $score += 10;
        if ($php_ok) $score += 10;
        
        $total_time = microtime(true) - $start_time;
        ?>

        <!-- Database Test -->
        <div class="test-section">
            <h2>
                🗄️ Database Connection
                <span class="status <?php echo $db_status; ?>">
                    <?php echo $db_status === 'success' ? 'Connected' : 'Failed'; ?>
                </span>
            </h2>
            <div class="metric">
                <span class="metric-label">Connection Time</span>
                <span class="metric-value"><?php echo number_format($db_time * 1000, 2); ?> ms</span>
            </div>
            <div class="metric">
                <span class="metric-label">Database</span>
                <span class="metric-value"><?php echo DB_NAME; ?></span>
            </div>
        </div>

        <!-- Server Configuration -->
        <div class="test-section">
            <h2>
                ⚙️ Server Configuration
                <span class="status <?php echo ($gzip_enabled && $php_ok) ? 'success' : 'warning'; ?>">
                    <?php echo ($gzip_enabled && $php_ok) ? 'Optimized' : 'Needs Attention'; ?>
                </span>
            </h2>
            <div class="metric">
                <span class="metric-label">PHP Version</span>
                <span class="metric-value"><?php echo $php_version; ?> <?php echo $php_ok ? '✓' : '⚠️'; ?></span>
            </div>
            <div class="metric">
                <span class="metric-label">GZIP Compression</span>
                <span class="metric-value"><?php echo $gzip_enabled ? 'Enabled ✓' : 'Disabled ⚠️'; ?></span>
            </div>
            <div class="metric">
                <span class="metric-label">OpCache</span>
                <span class="metric-value"><?php echo $opcache_enabled ? 'Enabled ✓' : 'Disabled ⚠️'; ?></span>
            </div>
        </div>

        <!-- Performance Metrics -->
        <div class="test-section">
            <h2>
                📊 Performance Metrics
                <span class="status <?php echo ($total_time < 0.1) ? 'success' : 'warning'; ?>">
                    <?php echo ($total_time < 0.1) ? 'Fast' : 'Moderate'; ?>
                </span>
            </h2>
            <div class="metric">
                <span class="metric-label">Total Execution Time</span>
                <span class="metric-value"><?php echo number_format($total_time * 1000, 2); ?> ms</span>
            </div>
            <div class="metric">
                <span class="metric-label">Session Start Time</span>
                <span class="metric-value"><?php echo number_format($session_time * 1000, 2); ?> ms</span>
            </div>
            <div class="metric">
                <span class="metric-label">Memory Usage</span>
                <span class="metric-value"><?php echo number_format($memory_usage, 2); ?> MB</span>
            </div>
            <div class="metric">
                <span class="metric-label">Peak Memory</span>
                <span class="metric-value"><?php echo number_format($memory_peak, 2); ?> MB</span>
            </div>
        </div>

        <!-- Overall Score -->
        <div class="score">
            <div class="score-number"><?php echo $score; ?>/100</div>
            <div class="score-label">
                <?php 
                if ($score >= 90) echo '🚀 Excellent Performance!';
                elseif ($score >= 70) echo '✅ Good Performance';
                elseif ($score >= 50) echo '⚠️ Needs Optimization';
                else echo '❌ Poor Performance';
                ?>
            </div>
        </div>

        <?php if ($score < 90): ?>
        <!-- Recommendations -->
        <div class="recommendations">
            <h3>💡 Recommendations</h3>
            <ul>
                <?php if (!$gzip_enabled): ?>
                <li>Enable GZIP compression in .htaccess or php.ini</li>
                <?php endif; ?>
                <?php if (!$opcache_enabled): ?>
                <li>Enable OpCache for faster PHP execution</li>
                <?php endif; ?>
                <?php if (!$php_ok): ?>
                <li>Upgrade PHP to version 7.4 or higher</li>
                <?php endif; ?>
                <?php if ($memory_usage > 10): ?>
                <li>Optimize memory usage - consider caching</li>
                <?php endif; ?>
                <?php if ($total_time > 0.1): ?>
                <li>Optimize database queries and enable query caching</li>
                <?php endif; ?>
            </ul>
        </div>
        <?php endif; ?>

        <div style="text-align: center;">
            <a href="../index.php" class="btn">← Back to Homepage</a>
            <a href="performance_test.php" class="btn" style="background: #059669;">🔄 Run Test Again</a>
        </div>
    </div>
</body>
</html>
