import express from 'express';
import pool from '../db.js';

const router = express.Router();

//listar todos os usuários
router.get('/', async (req, res) => {
  try {
    const result = await pool.query('SELECT * FROM usuarios');
    res.json(result.rows);
  } catch (error) {
    console.error('Erro ao buscar usuários:', error);
    res.status(500).send('Erro ao buscar usuários.');
  }
});

//cadastrar novo usuário
router.post('/', async (req, res) => {
  const {
    nomeUsuario,
    cpfUsuario,
    emailUsuario,
    telefoneUsuario,
    dataUsuario,
    cepUsuario,
    numeroUsuario,
    enderecoUsuario,
    complementoUsuario,
    bairroUsuario,
    estadoUsuario,
    cidadeUsuario,
    senhaUsuario
  } = req.body;

  // validação simples
  if (!nomeUsuario || !emailUsuario || !senhaUsuario) {
    return res.status(400).json({ erro: 'Nome, e-mail e senha são obrigatórios!' });
  }

  try {
    const result = await pool.query(
      `INSERT INTO usuarios (
        nomeUsuario, cpfUsuario, emailUsuario, telefoneUsuario,
        dataUsuario, cepUsuario, numeroUsuario, enderecoUsuario,
        complementoUsuario, bairroUsuario, estadoUsuario, cidadeUsuario, senhaUsuario
      ) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13)
      RETURNING *`,
      [
        nomeUsuario, cpfUsuario, emailUsuario, telefoneUsuario,
        dataUsuario, cepUsuario, numeroUsuario, enderecoUsuario,
        complementoUsuario, bairroUsuario, estadoUsuario, cidadeUsuario, senhaUsuario
      ]
    );

    res.status(201).json(result.rows[0]);
  } catch (error) {
    console.error('Erro ao inserir usuário:', error);
    res.status(500).send('Erro ao inserir usuário.');
  }
});

//buscar usuário por ID
router.get('/:idUsuario', async (req, res) => {
  const { idUsuario } = req.params;

  try {
    const result = await pool.query(
      'SELECT * FROM usuarios WHERE idUsuario = $1',
      [idUsuario]
    );

    if (result.rows.length === 0) {
      return res.status(404).json({ erro: 'Usuário não encontrado.' });
    }

    res.json(result.rows[0]);
  } catch (error) {
    console.error('Erro ao buscar usuário:', error);
    res.status(500).send('Erro interno no servidor.');
  }
});

export default router;
