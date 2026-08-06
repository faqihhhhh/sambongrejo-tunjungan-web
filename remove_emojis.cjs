const fs = require('fs');
const path = require('path');

const emojiRegex = /[\u{1F300}-\u{1F6FF}\u{1F900}-\u{1F9FF}\u{2600}-\u{26FF}\u{2700}-\u{27BF}\u{1F1E6}-\u{1F1FF}\u{1F200}-\u{1F251}]\s*/ug;

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

const viewsDir = path.join(__dirname, 'resources', 'views', 'admin');

walkDir(viewsDir, function(filePath) {
    if (!filePath.endsWith('.blade.php')) return;
    let content = fs.readFileSync(filePath, 'utf8');
    let original = content;
    
    content = content.replace(emojiRegex, '');

    if (content !== original) {
        fs.writeFileSync(filePath, content);
        console.log('Cleaned emojis in:', filePath);
    }
});
console.log('Done cleaning emojis');
