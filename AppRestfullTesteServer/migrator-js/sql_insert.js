const mysql = require('mysql');
const con = require('./connector');

module.exports = {
    insert: async (table, data) => {
        let arr = Object.values(data);
        arr.forEach((d, id)=> {
            if(typeof d == "string" && d.search(/ST_PointFromText/g) != -1)
                return arr[id] = d;
            else
                return arr[id] = mysql.escape(d);
        });
        let sql = `INSERT INTO ${table} (${
            Object.keys(data).join(', ')
        }) VALUES (${
            arr.join(', ')
        })`;
        return await con(sql, true);
    },
    erase: async (table='users')=>{
        let sql = `DELETE FROM ${table} WHERE id != 1`;
        return await con(sql, true);
    }
};