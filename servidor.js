import express from 'express';
import cors from 'cors';
import usuariosRouter from './rotas/usuarios.js';

const app = express();
const PORT = process.env.PORT || 3000;

app.use(cors());
app.use(express.json());

app.get('/', (req, res) => {
  res.send('🚀 API ToyMania conectada ao banco Neon!');
});

// rota principal dos usuários
app.use('/api/usuarios', usuariosRouter);

app.listen(PORT, () => {
  console.log(`✅ Servidor rodando em http://localhost:${PORT}`);
});
