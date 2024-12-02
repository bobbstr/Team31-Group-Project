const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const app = express();

app.use(bodyParser.json());

const db = mysql.createConnection({
    host: 'localhost',
    user: 'db_user',
    password: 'password',
    database: 'sugarrush',
});

db.connect(err => {
    if (err) {
        console.error('Error connecting to database:', err);
        throw err;
    }
    console.log('MySQL Connected...');
});

app.get('/products', (req, res) => {
    const sql = 'SELECT * FROM products';
    db.query(sql, (err, results) => {
        if (err) {
            console.error('Error fetching products:', err);
            res.status(500).json({ error: 'Database query failed' });
        } else {
            res.json(results);
        }
    });
});

app.get('/products/:id', (req, res) => {
    const sql = 'SELECT * FROM products WHERE ProductID = ?';
    db.query(sql, [req.params.id], (err, result) => {
        if (err) {
            console.error('Error fetching product:', err);
            res.status(500).json({ error: 'Database query failed' });
        } else {
            res.json(result);
        }
    });
});

const PORT = 5000;
app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});