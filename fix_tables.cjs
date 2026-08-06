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

const dirToScanAdmin = path.join(__dirname, 'resources', 'views', 'admin');
walkDir(dirToScanAdmin, function(filePath) {
    if (!filePath.endsWith('.blade.php')) return;
    let content = fs.readFileSync(filePath, 'utf8');
    let original = content;

    // Change overflow-hidden to overflow-x-auto on table containers for mobile responsiveness
    content = content.replace(/class="bg-white rounded-lg border border-gray-200 overflow-hidden"/g, 'class="bg-white rounded-lg border border-gray-200 overflow-x-auto"');

    if (content !== original) {
        fs.writeFileSync(filePath, content);
        console.log('Updated admin:', filePath);
    }
});

const dirToScanPublic = path.join(__dirname, 'resources', 'views');
walkDir(dirToScanPublic, function(filePath) {
    if (!filePath.endsWith('.blade.php')) return;
    if (filePath.includes(path.sep + 'admin' + path.sep)) return; // Skip admin
    
    let content = fs.readFileSync(filePath, 'utf8');
    let original = content;

    // Change py-10 to py-6 md:py-10 for mobile responsiveness spacing
    content = content.replace(/py-10/g, 'py-6 md:py-10');

    if (content !== original) {
        fs.writeFileSync(filePath, content);
        console.log('Updated public:', filePath);
    }
});

console.log('Done fix tables and spacing');
