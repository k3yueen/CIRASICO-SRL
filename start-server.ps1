Write-Host "Starting CIRASICO Modern Theme Demo Server..." -ForegroundColor Green
Write-Host ""
Write-Host "Server will be available at: http://localhost:8000/demo.html" -ForegroundColor Yellow
Write-Host ""
Write-Host "Press Ctrl+C to stop the server" -ForegroundColor Cyan
Write-Host ""

try {
    php -S localhost:8000
} catch {
    Write-Host "Error: PHP not found. Please make sure PHP is installed and in your PATH." -ForegroundColor Red
    Write-Host "You can download PHP from: https://windows.php.net/download/" -ForegroundColor Yellow
    Read-Host "Press Enter to exit"
} 