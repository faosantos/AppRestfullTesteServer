const mysql = require('mysql');
let connection = mysql.createConnection({
    host        : '31.220.59.226',
    user        : 'clubapp_db_user',
    password    : 'Fenix437533882079',
    database    : 'clubapp_db'
});
let connection2 = mysql.createConnection({
    host        : '31.220.59.226',
    user        : 'clubapp_db_user',
    password    : 'Fenix437533882079',
    database    : 'old_club_db'
    // host: 'localhost',
    // user: 'root',
    // password: '33882079',
    // database: 'old_club_db'
});
connection2.connect();
connection.connect();

module.exports = con = (sql, remote) => {
    if(remote)
        return new Promise( resolve => {
            connection2.query(sql, (err, values)=>{
                if(err) {
                    resolve(err);
                    // console.log(err);
                    // process.exit();
                    return;
                }
                resolve(values);
                // connection.end();
                return;
            })
        });
    else
        return new Promise(resolve=>{
            connection.query(sql, (err, values)=>{
                if(err) {
                    resolve(err);
                    // connection.end();
                    return;
                }
                resolve(values);
                // connection.end();
                return;
            });
        });
}
