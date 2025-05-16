<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Messages de Contact | Administration</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #4361ee;
      --primary-light: #ebf0ff;
      --secondary: #3f37c9;
      --success: #4cc9f0;
      --danger: #f72585;
      --dark: #2b2d42;
      --light: #f8f9fa;
      --gray: #6c757d;
      --gray-light: #e9ecef;
      --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f5f7fa;
      color: var(--dark);
      padding: 2rem;
    }
    
    .page-header {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      padding: 1.5rem 2rem;
      margin-bottom: 2rem;
      border-radius: 8px;
      box-shadow: var(--card-shadow);
    }
    
    .page-header h1 {
      font-weight: 600;
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }
    
    .page-header p {
      opacity: 0.9;
      margin-bottom: 0;
    }
    
    .messages-container {
      background-color: white;
      border-radius: 8px;
      box-shadow: var(--card-shadow);
      overflow: hidden;
    }
    
    .table-responsive {
      overflow-x: auto;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 800px;
    }
    
    thead {
      background-color: var(--primary);
      color: white;
    }
    
    th {
      padding: 1rem;
      font-weight: 500;
      text-align: left;
    }
    
    td {
      padding: 1rem;
      border-bottom: 1px solid var(--gray-light);
      vertical-align: top;
    }
    
    tr:last-child td {
      border-bottom: none;
    }
    
    tr:hover {
      background-color: var(--primary-light);
    }
    
    .message-preview {
      max-width: 300px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    
    .empty-state {
      padding: 3rem 2rem;
      text-align: center;
      color: var(--gray);
    }
    
    .empty-state i {
      font-size: 3rem;
      color: var(--gray-light);
      margin-bottom: 1rem;
    }
    
    .badge {
      display: inline-block;
      padding: 0.35em 0.65em;
      font-size: 0.75em;
      font-weight: 500;
      line-height: 1;
      text-align: center;
      white-space: nowrap;
      vertical-align: baseline;
      border-radius: 0.25rem;
    }
    
    .badge-primary {
      color: white;
      background-color: var(--primary);
    }
    
    .badge-light {
      color: var(--dark);
      background-color: var(--gray-light);
    }
    
    .filters {
      display: flex;
      gap: 1rem;
      margin-bottom: 1.5rem;
      flex-wrap: wrap;
    }
    
    .filter-group {
      flex: 1;
      min-width: 200px;
    }
    
    .filter-label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: var(--dark);
    }
    
    .filter-input {
      width: 100%;
      padding: 0.5rem 1rem;
      border: 1px solid var(--gray-light);
      border-radius: 6px;
      font-size: 0.9rem;
    }
    
    .filter-input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
    }
    
    @media (max-width: 768px) {
      body {
        padding: 1rem;
      }
      
      .page-header {
        padding: 1rem;
      }
      
      th, td {
        padding: 0.75rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="page-header">
      <h1>
        <i class="fas fa-envelope-open-text"></i>
        Messages de Contact
      </h1>
      <p>Liste des messages reçus via le formulaire de contact</p>
    </div>

    <!-- Filtres -->
    <form method="GET" action="{{ route('contact.index') }}">
  <div class="filters">
    <div class="filter-group">
      <label class="filter-label">Rechercher par nom</label>
      <input type="text" name="name" class="filter-input" placeholder="Entrez un nom..." value="{{ request('name') }}">
    </div>
    <div class="filter-group">
      <label class="filter-label">Filtrer par date</label>
      <select name="date" class="filter-input">
        <option {{ request('date') == '' ? 'selected' : '' }}>Toutes les dates</option>
        <option {{ request('date') == "Aujourd'hui" ? 'selected' : '' }}>Aujourd'hui</option>
        <option {{ request('date') == 'Cette semaine' ? 'selected' : '' }}>Cette semaine</option>
        <option {{ request('date') == 'Ce mois' ? 'selected' : '' }}>Ce mois</option>
      </select>
    </div>
    <div class="filter-group" style="align-self: flex-end;">
      <button type="submit" class="filter-input" style="background-color: var(--primary); color: white; cursor: pointer;">Filtrer</button>
    </div>
  </div>
</form>


    <div class="messages-container">
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>Nom</th>
              <th>Email</th>
              <th>Sujet</th>
              <th>Message</th>
              <th>Date</th>
              <th>Statut</th>
            </tr>
          </thead>
          <tbody>
            @forelse($messages as $message)
              <tr>
                <td>
                  <strong>{{ $message->name }}</strong>
                </td>
                <td>
                  <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                </td>
                <td>{{ $message->subject }}</td>
                <td class="message-preview" title="{{ $message->message }}">
                  {{ Str::limit($message->message, 50) }}
                </td>
                <td>
                  <span class="badge badge-light">
                    {{ $message->created_at->format('d/m/Y H:i') }}
                  </span>
                </td>
                <td>
                  <span class="badge badge-primary">
                    Nouveau
                  </span>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6">
                  <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h3>Aucun message reçu</h3>
                    <p>Aucun message n'a été envoyé via le formulaire de contact.</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Pagination -->
    @if($messages->hasPages())
    <div style="margin-top: 2rem; display: flex; justify-content: center;">
      <nav>
        {{ $messages->links() }}
      </nav>
    </div>
    @endif
  </div>

  <script>
    // Fonction pour afficher un aperçu complet du message
    document.querySelectorAll('.message-preview').forEach(element => {
      element.addEventListener('click', () => {
        alert(element.getAttribute('title'));
      });
    });
  </script>
</body>
</html>