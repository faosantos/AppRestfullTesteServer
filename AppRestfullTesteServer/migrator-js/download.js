var 
    fs = require('fs'),
    path = require('path'),
    rtdir = '/root/site/user_images',
    // rtdir = '/home/rsx/Documents/Projects/99club-server/public/storage/images',
    curPath = path.resolve(__dirname + '/../public/storage/images'),
    { insert } = require('./sql_insert');
var hostAndPath = 'http://31.220.59.226:8000/storage/images/';

async function downloadAvatar(uid, filename, sex = 'f'){
    return new Promise(resolve=>{
        let avatar = rtdir+'/'+uid+'/'+'avatar.webp';
        // console.log(avatar);
        let exist = fs.existsSync(avatar);
        if(exist){
            let readfile = fs.createReadStream(avatar);
            let write = fs.createWriteStream(curPath + '/' + filename + '.jpg');
            readfile.pipe(write).on('close', ()=>{
                resolve(hostAndPath + filename + '.jpg')
            });
        }else{
            resolve(hostAndPath + 'defaults/' + (sex == 'f' ? 'female.png' : 'male.png'));
        }
    });
}
async function downloadGallery(uid, prefix){
    let userId = uid;
    let gallery = rtdir + '/' + uid;
    fs.readdir(gallery, (err, dir)=>{
        if(err) return;
        dir.forEach((i, idx) => {
            if(i != 'avatar.webp' && i != 'avatar.jpeg' && i != 'avatar.png' && i != 'avatar.jpg'){
                let photo = gallery + '/' + i;
                let filename = prefix +'_'+ idx + '.jpg';
                let r = fs.createReadStream(photo);
                let w = fs.createWriteStream(curPath + '/' + filename);
                r.pipe(w).on('close', ()=>{
                    insert('user_images', {
                        user_id: userId,
                        path: hostAndPath + filename
                    }).then(i => console.log('INSERTED IMAGE'))
                });
            }
        });
    });
}

module.exports = {
    downloadAvatar,
    downloadGallery
}
