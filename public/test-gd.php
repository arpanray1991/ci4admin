<?php
echo "GD Support: " . (extension_loaded('gd') ? "✅ YES" : "❌ NO") . "<br>";
echo "imagecreatetruecolor: " . (function_exists('imagecreatetruecolor') ? "✅ YES" : "❌ NO") . "<br>";
echo "imagepng: " . (function_exists('imagepng') ? "✅ YES" : "❌ NO") . "<br>";