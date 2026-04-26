<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pacientes - NeuroCentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { 
            --sidebar-color: #16222e; 
            --bg-light: #f0faff; 
            --neuro-cyan: #33c3e1; 
            --neuro-cyan-dark: #00acc1;
            --neuro-purple: #6f42c1;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            margin: 0; 
            background-color: var(--bg-light);
            background-image: linear-gradient(rgba(240, 250, 255, 0.95), rgba(240, 250, 255, 0.95)), 
                              url('https://www.transparenttextures.com/patterns/cubes.png'); 
        }
        
        .sidebar { 
            min-width: 280px; max-width: 280px; 
            background: var(--sidebar-color); 
            min-height: 100vh; color: white; 
            position: fixed; z-index: 1000;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .doctor-profile { padding: 40px 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.05); }

        .avatar-circle {
            width: 75px; height: 75px; background: white; border-radius: 18px; 
            margin: 0 auto 15px; display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem; font-weight: bold; color: var(--neuro-cyan);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }

        .sidebar .nav-link { 
            color: rgba(255,255,255,0.7); 
            padding: 14px 25px; 
            display: flex; align-items: center; 
            text-decoration: none; border-radius: 12px; margin: 4px 15px;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover { color: white; background: rgba(51, 195, 225, 0.15); transform: translateX(5px); }
        .sidebar .nav-link.active { color: white; background: var(--neuro-cyan); font-weight: 600; box-shadow: 0 4px 12px rgba(51, 195, 225, 0.3); }

        .main-content { margin-left: 280px; width: calc(100% - 280px); padding: 40px; min-height: 100vh; }

        .data-card { 
            background: white; border-radius: 25px; padding: 30px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05);
        }

        .search-bar { 
            background: white; border-radius: 50px; padding: 12px 25px; 
            border: 1px solid #e1e8ed; width: 350px; transition: all 0.3s;
        }
        .search-bar:focus { outline: none; border-color: var(--neuro-cyan); box-shadow: 0 0 0 4px rgba(51, 195, 225, 0.1); }

        .table thead th { background-color: #f8fbff; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; color: #7a828a; padding: 15px; }
        .table tbody tr { transition: background 0.2s; border-radius: 10px; }
        .table tbody tr:hover { background-color: #f0f9ff !important; }

        .badge-tea {
            background-color: rgba(51, 195, 225, 0.1) !important;
            color: var(--neuro-cyan) !important;
            border: 1px solid rgba(51, 195, 225, 0.2);
            font-weight: 600; padding: 8px 15px;
        }

        .btn-view-profile {
            background: white; border: 2px solid var(--neuro-cyan); color: var(--neuro-cyan);
            font-weight: 600; transition: all 0.3s;
        }
        .btn-view-profile:hover { background: var(--neuro-cyan); color: white; transform: translateY(-2px); box-shadow: 0 5px 10px rgba(51, 195, 225, 0.2); }

        .custom-footer {
            background-color: var(--sidebar-color); color: white;
            margin-left: 280px; padding: 25px 0; border-top: 4px solid var(--neuro-cyan);
        }

        .btn-action { width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; transition: 0.3s; border: none; background: none; }
        .btn-edit { color: var(--neuro-purple); background: rgba(111, 66, 193, 0.1); text-decoration: none; }
        .btn-edit:hover { background: var(--neuro-purple); color: white; }
        .btn-delete { color: #ff4d4d; background: rgba(255, 77, 77, 0.1); }
        .btn-delete:hover { color: white; background: #ff4d4d; }
    </style>
</head>
<body>

<div class="d-flex">
    <nav class="sidebar">
        <div class="doctor-profile">
            <a href="{{ url('/medico') }}" style="text-decoration: none;">
                <div class="avatar-circle">JR</div>
                <h5 class="mb-1 fw-bold text-white">Dr. Jorge Reque</h5>
            </a>
            <p class="small opacity-50 mb-0 text-uppercase">Director Médico</p>
        </div>
        
        <div class="nav flex-column mt-4">
            <a href="{{ route('dashboard') }}" class="nav-link"><i class="bi bi-grid-1x2-fill me-3"></i> Panel Principal</a>
            
            {{-- SE CORRIGIÓ A 'index' --}}
            <a href="{{ route('index') }}" class="nav-link active"><i class="bi bi-people-fill me-3"></i> Pacientes</a>
            
            <a href="{{ route('paso1') }}" class="nav-link"><i class="bi bi-person-plus-fill me-3"></i> Registrar Paciente</a>
            
            <div style="margin-top: 150px;" class="px-4">
                <hr class="opacity-25">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link text-danger p-2 border-0 bg-transparent w-100 text-start">
                        <i class="bi bi-box-arrow-left me-3"></i> Salir
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold text-dark m-0">Gestión de Pacientes</h2>
                <p class="text-muted">Monitoreo clínico y seguimiento de evolución.</p>
            </div>
            
            <div class="d-flex gap-3 align-items-center">
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm rounded-pill px-4 mb-0 py-2">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="position-relative">
                    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    <input type="text" id="searchInput" class="search-bar ps-5" placeholder="Buscar paciente...">
                </div>
            </div>
        </div>

        <div class="data-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0"><i class="bi bi-person-lines-fill me-2 text-cyan"></i>Pacientes Activos</h5>
                <a href="{{ route('paso1') }}" class="btn btn-info text-white rounded-pill px-4 shadow-sm" style="background-color: var(--neuro-cyan); border:none;">
                    <i class="bi bi-plus-lg me-2"></i>Nuevo Paciente
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="pacientesTable">
                    <thead>
                        <tr>
                            <th class="ps-4 border-0">Nombre del Paciente</th>
                            <th class="border-0">Edad</th>
                            <th class="border-0">Diagnóstico / Nivel TEA</th>
                            <th class="text-center border-0">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lista_pacientes as $p)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle p-2 me-3 text-primary" style="width: 40px; height: 40px; display:flex; align-items:center; justify-content:center;">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <div>
                                            <span class="fw-bold text-dark d-block">{{ $p->nombre }}</span>
                                            <small class="text-muted">ID: #{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="fw-semibold">{{ $p->edad }}</span> años</td>
                                <td><span class="badge rounded-pill badge-tea">{{ $p->nivel_tea ?? 'Pendiente' }}</span></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- SE CORRIGIÓ A 'perfil' --}}
                                        <a href="{{ route('perfil', $p->id) }}" class="btn btn-view-profile btn-sm rounded-pill px-3">
                                            <i class="bi bi-eye-fill me-1"></i> Perfil Padre
                                        </a>
                                        
                                        {{-- SE CORRIGIÓ A 'edit' --}}
                                        <a href="{{ route('edit', $p->id) }}" class="btn-action btn-edit" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        {{-- SE CORRIGIÓ A 'destroy' --}}
                                        <form action="{{ route('destroy', $p->id) }}" method="POST" onsubmit="return confirm('¿Confirma que desea eliminar permanentemente este registro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="noResultsRow">
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <div class="mb-3">
                                        <i class="bi bi-folder-x fs-1 opacity-25"></i>
                                    </div>
                                    <p class="m-0">No hay pacientes registrados en el sistema.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<footer class="custom-footer">
    <div class="container-fluid px-5 text-center">
        <p class="small mb-0">© 2026 <strong>NeuroCentro</strong> - Sistema de Monitoreo Clínico especializado en TEA</p>
    </div>
</footer>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll('#pacientesTable tbody tr:not(#noResultsRow)');
        let found = false;
        
        rows.forEach(row => {
            let nombre = row.querySelector('td:first-child').textContent.toLowerCase();
            if(nombre.includes(value)) {
                row.style.display = '';
                found = true;
            } else {
                row.style.display = 'none';
            }
        });

        let noResults = document.getElementById('noResultsRow');
        if(!found && value !== "") {
            if(!noResults) {
                let tbody = document.querySelector('#pacientesTable tbody');
                let newRow = tbody.insertRow();
                newRow.id = "noResultsRow";
                newRow.innerHTML = `<td colspan="4" class="text-center py-4 text-muted">No se encontraron pacientes con "${value}"</td>`;
            }
        } else if (found && noResults) {
            noResults.remove();
        }
    });
</script>

</body>
</html>