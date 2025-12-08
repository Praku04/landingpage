<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMG - Image Test</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f3f4f6;
            padding: 40px 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        h1 {
            color: #1e40af;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #6b7280;
            margin-bottom: 30px;
        }
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .image-card {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 15px;
            background: #f9fafb;
        }
        .image-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 6px;
            background: #e5e7eb;
        }
        .image-info {
            margin-top: 10px;
        }
        .image-path {
            font-size: 12px;
            color: #6b7280;
            word-break: break-all;
            margin-top: 5px;
        }
        .status {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            margin-top: 8px;
        }
        .status.loaded {
            background: #d1fae5;
            color: #065f46;
        }
        .status.error {
            background: #fee2e2;
            color: #991b1b;
        }
        .btn {
            display: inline-block;
            background: #1e40af;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
        }
        .btn:hover {
            background: #1e3a8a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🖼️ Image Loading Test</h1>
        <p class="subtitle">Testing all images on TMG website</p>

        <div class="image-grid">
            <?php
            $images = [
                ['path' => 'images/hero/heroimage.png', 'name' => 'Hero Image'],
                ['path' => 'images/hero/1668790630107.jpeg', 'name' => 'Testimonial - Pranav'],
                ['path' => 'images/hero/Screenshot_20200216-123516.png', 'name' => 'Testimonial - Sakshi'],
                ['path' => 'images/hero/1748776971244.jpeg', 'name' => 'Testimonial - Neha'],
                ['path' => 'images/tmg-logo.svg', 'name' => 'TMG Logo (SVG)'],
            ];

            foreach ($images as $img) {
                $exists = file_exists($img['path']);
                $filesize = $exists ? filesize($img['path']) : 0;
                $readable = $exists && is_readable($img['path']);
                ?>
                <div class="image-card">
                    <img src="<?php echo $img['path']; ?>" 
                         alt="<?php echo $img['name']; ?>"
                         onerror="this.parentElement.querySelector('.status').textContent='❌ Failed to Load'; this.parentElement.querySelector('.status').className='status error';"
                         onload="this.parentElement.querySelector('.status').textContent='✓ Loaded'; this.parentElement.querySelector('.status').className='status loaded';">
                    <div class="image-info">
                        <strong><?php echo $img['name']; ?></strong>
                        <div class="image-path"><?php echo $img['path']; ?></div>
                        <div class="status">Loading...</div>
                        <div style="font-size: 11px; color: #9ca3af; margin-top: 5px;">
                            <?php if ($exists): ?>
                                File exists: ✓ (<?php echo round($filesize/1024, 2); ?> KB)<br>
                                Readable: <?php echo $readable ? '✓' : '❌'; ?>
                            <?php else: ?>
                                File exists: ❌
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <div style="margin-top: 40px; padding-top: 20px; border-top: 2px solid #e5e7eb;">
            <h3 style="color: #374151; margin-bottom: 15px;">📁 Image Directory Structure</h3>
            <pre style="background: #f9fafb; padding: 15px; border-radius: 6px; overflow-x: auto; font-size: 12px;">
<?php
function listDirectory($dir, $prefix = '') {
    if (!is_dir($dir)) return;
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $path = $dir . '/' . $item;
        if (is_dir($path)) {
            echo $prefix . "📁 " . $item . "/\n";
            listDirectory($path, $prefix . "  ");
        } else {
            $size = filesize($path);
            echo $prefix . "📄 " . $item . " (" . round($size/1024, 2) . " KB)\n";
        }
    }
}
listDirectory('images');
?>
            </pre>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="index.php" class="btn">← Back to Homepage</a>
            <a href="test-images.php" class="btn" style="background: #059669;">🔄 Refresh Test</a>
        </div>
    </div>

    <script src="js/image-fallback.js"></script>
</body>
</html>
