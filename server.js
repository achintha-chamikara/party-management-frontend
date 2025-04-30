const express = require('express');
const mysql = require('mysql2');
const cors = require('cors');
const bodyParser = require('body-parser');

const app = express();
app.use(cors());
app.use(bodyParser.json());

// Create MySQL connection
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '', 
  database: 'party_planning_test'
});

// Connect to database
db.connect(err => {
  if (err) {
    console.error('Database connection failed:', err.stack);
    return;
  }
  console.log('Connected to database.');
});

// API route to handle feedback submission
app.post('/submit-feedback', (req, res) => {
  const { cus_id, message } = req.body;
  const sql = 'INSERT INTO feedback (cus_id, message) VALUES (?, ?)';
  db.query(sql, [cus_id, message], (err, result) => {
    if (err) {
      console.error('Error inserting feedback:', err);
      return res.status(500).send('Database error');
    }
    res.status(200).send('Feedback submitted successfully');
  });
});

// Start server
app.listen(3000, () => {
  console.log('Server is running on http://localhost:3000');
});

