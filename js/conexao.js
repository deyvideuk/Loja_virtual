import pool from "./db.js";

async function conexao(){
    try{
        const res = await pool.query('SELECT NOW()');
        console.log('Conectado ao banco: ', res.rows[0]);
    } catch (erro){
        console.error('Falha na conexão: ', erro);
    } finally {
        await pool.end();
    }
}

conexao();