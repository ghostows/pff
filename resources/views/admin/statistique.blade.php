<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Statistiques des Classes</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3f37c9;
      --accent-color: #4cc9f0;
      --text-color: #2b2d42;
      --light-bg: #f4f6f8;
      --white: #ffffff;
      --border-color: #e0e0e0;
      --success-color: #4caf50;
      --warning-color: #ff9800;
      --danger-color: #f44336;
    }
    
    body {
      font-family: 'Roboto', sans-serif;
      padding: 2rem;
      background: var(--light-bg);
      color: var(--text-color);
      line-height: 1.6;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
    }
    
    h1 {
      color: var(--primary-color);
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }
    
    .stat-card {
      background: var(--white);
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-align: center;
    }
    
    .stat-card h3 {
      margin-top: 0;
      color: var(--primary-color);
      font-size: 1rem;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    
    .stat-card p {
      font-size: 1.8rem;
      font-weight: 700;
      margin: 0.5rem 0 0;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      background: var(--white);
      margin-top: 2rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      border-radius: 8px;
      overflow: hidden;
    }
    
    th, td {
      padding: 1rem;
      border-bottom: 1px solid var(--border-color);
      text-align: left;
    }
    
    th {
      background: var(--primary-color);
      color: var(--white);
      position: sticky;
      top: 0;
    }
    
    tr:hover {
      background-color: rgba(76, 201, 240, 0.1);
    }
    
    .btn {
      display: inline-block;
      background: var(--secondary-color);
      color: var(--white);
      padding: 0.5rem 1rem;
      border-radius: 5px;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .btn:hover {
      background: var(--primary-color);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .chart-container {
      background: var(--white);
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      margin-bottom: 2rem;
    }
    
    canvas {
      width: 100% !important;
      height: auto !important;
    }
    
    .badge {
      display: inline-block;
      padding: 0.25rem 0.5rem;
      border-radius: 12px;
      font-size: 0.75rem;
      font-weight: 600;
    }
    
    .badge-success {
      background-color: rgba(76, 175, 80, 0.2);
      color: var(--success-color);
    }
    
    .badge-warning {
      background-color: rgba(255, 152, 0, 0.2);
      color: var(--warning-color);
    }
    
    .badge-danger {
      background-color: rgba(244, 67, 54, 0.2);
      color: var(--danger-color);
    }
    
    @media (max-width: 768px) {
      body {
        padding: 1rem;
      }
      
      table {
        display: block;
        overflow-x: auto;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1><span>📊</span> Statistiques des Classes</h1>
    
    <div class="stats-grid">
      <div class="stat-card">
        <h3>Nombre total de classes</h3>
        <p>{{ count($stats) }}</p>
      </div>
      
      <div class="stat-card">
        <h3>Moyenne générale des notes</h3>
        <p>{{ number_format(collect($stats)->pluck('moyenne_notes')->map(fn($n) => floatval($n))->avg(), 2) }}</p>
      </div>
      
      <div class="stat-card">
        <h3>Taux moyen d'absence</h3>
        <p>{{ number_format(collect($stats)->pluck('moyenne_absences')->map(fn($a) => floatval($a))->avg(), 2) }} <small>absences/étudiant</small></p>
      </div>
    </div>
    
    <div class="chart-container">
      <canvas id="barChart"></canvas>
    </div>
    
    <div class="chart-container">
      <canvas id="lineChart"></canvas>
    </div>
    
    <table>
      <thead>
        <tr>
          <th>Classe</th>
          <th>Moyenne des Notes</th>
          <th>Moyenne des Absences</th>
          <th>Performance</th>
          <th>Détails</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($stats as $stat)
          <tr>
            <td>{{ $stat['classe'] }}</td>
            <td>{{ number_format($stat['moyenne_notes'], 2) }}</td>
            <td>{{ number_format($stat['moyenne_absences'], 2) }}</td>
            <td>
              @php
                $note = floatval($stat['moyenne_notes']);
                $absence = floatval($stat['moyenne_absences']);
                
                if($note >= 14 && $absence <= 2) {
                  echo '<span class="badge badge-success">Excellente</span>';
                } elseif($note >= 10 && $absence <= 5) {
                  echo '<span class="badge badge-warning">Moyenne</span>';
                } else {
                  echo '<span class="badge badge-danger">À améliorer</span>';
                }
              @endphp
            </td>
            <td>
              <a class="btn" href="{{ route('classe.stats', $stat['classe_id']) }}">Voir Détails</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script>
    // Configuration commune pour les graphiques
    const chartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      scales: { 
        y: { 
          beginAtZero: true,
          grid: {
            color: 'rgba(0,0,0,0.05)'
          }
        },
        x: {
          grid: {
            display: false
          }
        }
      },
      plugins: {
        legend: {
          position: 'top',
        },
        tooltip: {
          backgroundColor: 'rgba(0,0,0,0.8)',
          titleFont: {
            size: 14,
            weight: 'bold'
          },
          bodyFont: {
            size: 12
          }
        }
      }
    };

    // Graphique à barres (moyennes des notes)
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: {!! json_encode(array_column($stats, 'classe')) !!},
        datasets: [{
          label: 'Moyenne des Notes',
          data: {!! json_encode(array_column($stats, 'moyenne_notes')) !!},
          backgroundColor: 'rgba(76, 201, 240, 0.7)',
          borderColor: 'rgba(76, 201, 240, 1)',
          borderWidth: 1
        }]
      },
      options: {
        ...chartOptions,
        plugins: {
          ...chartOptions.plugins,
          title: {
            display: true,
            text: 'Comparaison des moyennes par classe',
            font: {
              size: 16
            }
          }
        }
      }
    });

    // Graphique linéaire (absences)
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
      type: 'line',
      data: {
        labels: {!! json_encode(array_column($stats, 'classe')) !!},
        datasets: [{
          label: 'Moyenne des Absences',
          data: {!! json_encode(array_column($stats, 'moyenne_absences')) !!},
          backgroundColor: 'rgba(244, 67, 54, 0.2)',
          borderColor: 'rgba(244, 67, 54, 1)',
          borderWidth: 2,
          tension: 0.3,
          fill: true
        }]
      },
      options: {
        ...chartOptions,
        plugins: {
          ...chartOptions.plugins,
          title: {
            display: true,
            text: 'Taux d\'absence par classe',
            font: {
              size: 16
            }
          }
        }
      }
    });
  </script>
</body>
</html>