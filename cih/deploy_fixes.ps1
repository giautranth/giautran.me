$files = @('index.html', 'bac-si.html', 'chi-tiet-bac-si.html', 'vien-dao-tao-nckh.html', 'script.js')
foreach ($f in $files) {
    scp -o StrictHostKeyChecking=no "d:\ANTIGRAVITY\GITHUB\cih\$f" root@134.209.109.20:/var/www/giautran.me/cih/$f
    scp -o StrictHostKeyChecking=no "d:\ANTIGRAVITY\GITHUB\cih\$f" root@134.209.109.20:/var/www/giautran.me/wp-content/themes/flatsome-child/cih/$f
    Copy-Item -Path "d:\ANTIGRAVITY\GITHUB\cih\$f" -Destination "D:\ANTIGRAVITY\CIH\CIH - Website\design-layout\$f" -Force
}
