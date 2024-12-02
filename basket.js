const express = require("express");
const cors = require("cors");
const app = express();

app.use(cors());

app.get('/api/basket', (req, res) => {
    res.json(basketItems);
});

const PORT = 3000;
app.listen(PORT, () => console.log('Server runing on https://localhost:${PORT}'));