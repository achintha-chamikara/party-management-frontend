<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>THEMES</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef2f3;
      padding: 20px;
      background-image: url('../Backend/images/s2.jpg');
      background-size: cover;
      
    }

    h1 {
      color: rgb(255, 255, 255);
      text-align: center;
    }

    ul {
      font-size: 16px;
    }

    h2 {
      text-align: center;
      color: #333;
    }

    table {
      width: 80%;
      margin: 0 auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px;
      text-align: center;
      border: 1px solid #ccc;
    }

    th {
      background-color: #ffffff;
      color: #6b0c6e;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
  </style>
</head>

<body>

<h1>THEMES</h1>

<table id="themeTable">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <!-- Data will be populated here -->
  </tbody>
</table>

<?php
        include '../Backend/back.php'
        ?>

<script>
  fetch('themeData.php')
    .then(response => response.json())
    .then(data => {
      const tbody = document.querySelector('#themeTable tbody');

      if (data.length === 0) {
        const tr = document.createElement('tr');
        tr.innerHTML = `<td colspan="3">No themes found.</td>`;
        tbody.appendChild(tr);
      } else {
        data.forEach(item => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td>${item.theme_id}</td>
            <td>${item.name}</td>
            <td>${item.description}</td>
          `;
          tbody.appendChild(tr);
        });
      }
    })
    .catch(error => console.error('Error fetching data:', error));
</script>

</body>
</html>
