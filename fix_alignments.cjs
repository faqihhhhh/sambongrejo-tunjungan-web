const fs = require('fs');
const path = require('path');

function walkDir(dir, callback) {
    fs.readdirSync(dir).forEach(f => {
        let dirPath = path.join(dir, f);
        if (fs.statSync(dirPath).isDirectory()) {
            walkDir(dirPath, callback);
        } else {
            callback(path.join(dir, f));
        }
    });
}

const viewsDir = path.join(__dirname, 'resources', 'views');

walkDir(viewsDir, function(filePath) {
    if (!filePath.endsWith('.blade.php')) return;
    let content = fs.readFileSync(filePath, 'utf8');
    let original = content;
    
    // Fix action forms inside tables
    content = content.replace(/class="inline-flex items-center">@csrf @method\('DELETE'\)<button/g, 'class="flex m-0 p-0">@csrf @method(\'DELETE\')<button');
    content = content.replace(/class="inline-flex items-center">(\s*)@csrf(\s*)@method\('DELETE'\)(\s*)<button/g, 'class="flex m-0 p-0">$1@csrf$2@method(\'DELETE\')$3<button');

    // Fix logout form in admin.blade.php
    if (filePath.includes('admin.blade.php')) {
        content = content.replace(/<form method="POST" action="{{ route\('logout'\) }}" class="inline">/g, '<form method="POST" action="{{ route(\'logout\') }}" class="flex m-0 p-0">');
    }

    if (content !== original) {
        fs.writeFileSync(filePath, content);
        console.log('Fixed form alignment in:', filePath);
    }
});
console.log('Done fixing alignments');
