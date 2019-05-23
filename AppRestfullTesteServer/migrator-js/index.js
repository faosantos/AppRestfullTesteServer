const con = require('./connector');
const {insert, erase} = require('./sql_insert');
const {downloadAvatar, downloadGallery} = require('./download');

let sqls = {
    user:`SELECT * FROM users`,
    fav: `SELECT * FROM favorites`,
    blk: `SELECT * FROM blocks`
};
async function formatUser(u){
    "use strict"
    let date = new Date(u.created_at);
    let formatBDate = (d) => {
        if(d.length > 10){
            d=d.splice(10, d.length);
            return d;
        }
        d = d.split('-');
        if(d[2] != 'undefined' && d[1] != 'undefined' && d[0] != 'undefined'){
            let data = d[2] + '-' + d[1] + '-' + d[0];
            return data;
        }
        return '2000-01-01';
    }
    let formatDate = (d) =>{
        return d.getUTCFullYear() + '-' + (d.getUTCMonth() + 1) + '-' + d.getUTCDate()
    }
    let avHash = (u.email.split('@'))[0] + '_' + u.id + '_avatar';
    let user = {
        id: u.id,
        email: u.email,
        name: u.name,
        sex: u.sex == 'male'? 'm':'f',
        interest: u.interest == 'male'? 'm':'f',
        location: `ST_PointFromText('POINT(${u.lat} ${u.lng})')`,
        feed_max_distance: u.feed_max_distance,
        avatar: await downloadAvatar(u.id, avHash, u.sex == 'male'? 'm':'f'),
        password: u.password,
        about: u.about,
        birth_date: formatBDate(u.birth_date),
        created_at: formatDate(date),
        updated_at: formatDate(new Date(Date.now()))
    };
    return user;
}
async function main(){
    let users = await con(sqls['user']);
    erase('users');
    users.forEach(async u => {
        let user = await formatUser(u);
        let inserted = await insert('users', user);
        if(inserted){
            await downloadGallery(u.id, (u.email.split('@'))[0] + '_' + u.id + '_');
        }
    });
    let favs = await con(sqls['fav']);
    erase('favorites');
    favs.forEach(async f => {
        let fav = {id: f.id, to_id: f.favorite_id, owner_id: f.owner_id, created_at: f.created_at}
        insert('favorites', fav).then(()=>{
            console.log('SET FAV');
        });
    });
    let blocks = await con(sqls['blk']);
    erase('blocks');
    blocks.forEach(async b => {
        let blk = {id: b.id, from_user_id: b.from_user_id, to_user_id: b.to_user_id, created_at: b.created_at}
        insert('blocks', blk).then(()=>{
            console.log('SET BLOCK');
        });
    });
}

main();
