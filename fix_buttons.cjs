const fs = require('fs');
const path = require('path');

function walkDir(dir, callback) {
    fs.readdirSync(dir).forEach(f => {
        let dirPath = path.join(dir, f);
        let isDirectory = fs.statSync(dirPath).isDirectory();
        isDirectory ? walkDir(dirPath, callback) : callback(path.join(dir, f));
    });
}

const dirToScan = path.join(__dirname, 'resources', 'views', 'admin');

walkDir(dirToScan, function(filePath) {
    if (!filePath.endsWith('.blade.php')) return;
    
    let content = fs.readFileSync(filePath, 'utf8');
    let original = content;

    // Standardize 'flex gap-2' to 'flex items-center gap-2'
    content = content.replace(/<div class="flex gap-2">/g, '<div class="flex items-center gap-2">');

    // Replace basic text-based 'Edit' link
    const editRegex = /<a href="([^"]+)" class="[^"]*text-blora-blue[^"]*">Edit<\/a>/g;
    content = content.replace(editRegex, '<a href="$1" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-blue-700 bg-blue-50 border border-blue-200 rounded hover:bg-blue-100 transition-colors">Edit</a>');

    // Replace basic text-based 'Hapus' form
    // Matches `<form ...>@csrf @method('DELETE')<button ...>Hapus</button></form>` over multiple lines or inline
    const deleteMultilineRegex = /<form method="POST" action="([^"]+)"[\s\S]*?>[\s]*@csrf @method\('DELETE'\)[\s]*<button type="submit" class="[^"]*text-blora-red[^"]*">Hapus<\/button>[\s]*<\/form>/g;
    content = content.replace(deleteMultilineRegex, '<form method="POST" action="$1" onsubmit="return confirm(\'Hapus data ini?\')" class="inline-flex items-center">@csrf @method(\'DELETE\')<button type="submit" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded hover:bg-red-100 transition-colors">Hapus</button></form>');

    // Replace Download links
    const downloadRegex = /<a href="([^"]+)" target="_blank" class="[^"]*text-blora-blue[^"]*">Download<\/a>/g;
    content = content.replace(downloadRegex, '<a href="$1" target="_blank" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded hover:bg-gray-100 transition-colors">Download</a>');

    if (content !== original) {
        fs.writeFileSync(filePath, content);
        console.log('Updated:', filePath);
    }
});

console.log('Done.');
