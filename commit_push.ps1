cd C:\Users\Admin\Downloads\laravel_DANT-main
$env:PATH = "C:\xampp82\php;$env:PATH"

Write-Host "Checking git status..." -ForegroundColor Yellow
git status

Write-Host "`nAdding all changes..." -ForegroundColor Yellow
git add -A

Write-Host "`nCommitting changes..." -ForegroundColor Yellow
git commit -m "fix: update logo path in header"

Write-Host "`nPushing to remote..." -ForegroundColor Yellow
git push

Write-Host "`nDone!" -ForegroundColor Green

