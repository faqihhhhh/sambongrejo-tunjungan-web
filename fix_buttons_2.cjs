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

const dirToScan = path.join(__dirname, 'resources', 'views', 'admin');

walkDir(dirToScan, function(filePath) {
    if (!filePath.endsWith('.blade.php')) return;
    
    let content = fs.readFileSync(filePath, 'utf8');
    let original = content;

    // Edit Button
    const editRegex = /<a href="([^"]+)" class="inline-flex items-center px-2\.5 py-1 text-xs font-medium text-blue-700 bg-blue-50 border border-blue-200 rounded hover:bg-blue-100 transition-colors">Edit<\/a>/g;
    const editReplacement = '<a href="$1" class="inline-flex items-center text-sm font-medium text-blora-blue hover:text-blora-green-dark transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>Edit</a>';
    content = content.replace(editRegex, editReplacement);

    // Delete Button
    const deleteRegex = /<button type="submit" class="inline-flex items-center px-2\.5 py-1 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded hover:bg-red-100 transition-colors">Hapus<\/button>/g;
    const deleteReplacement = '<button type="submit" class="inline-flex items-center text-sm font-medium text-blora-red hover:text-red-800 transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>Hapus</button>';
    content = content.replace(deleteRegex, deleteReplacement);

    // Download Button
    const downloadRegex = /<a href="([^"]+)" target="_blank" class="inline-flex items-center px-2\.5 py-1 text-xs font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded hover:bg-gray-100 transition-colors">Download<\/a>/g;
    const downloadReplacement = '<a href="$1" target="_blank" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blora-blue transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>Download</a>';
    content = content.replace(downloadRegex, downloadReplacement);

    // Detail Button
    const detailRegex = /<a href="([^"]+)" class="inline-flex items-center px-2\.5 py-1 text-xs font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded hover:bg-gray-100 transition-colors">Detail<\/a>/g;
    const detailReplacement = '<a href="$1" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blora-blue transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>Detail</a>';
    content = content.replace(detailRegex, detailReplacement);

    // gap-2 to gap-4 for text links with icons to breathe better
    content = content.replace(/<div class="flex items-center gap-2">/g, '<div class="flex items-center gap-4">');

    if (content !== original) {
        fs.writeFileSync(filePath, content);
        console.log('Updated:', filePath);
    }
});

console.log('Done.');
