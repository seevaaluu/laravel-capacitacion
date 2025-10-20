<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Encabezado -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h1 class="text-primary">
                    <i class="fas fa-users"></i> Listado de Usuarios
                </h1>
                <hr>
            </div>
        </div>

        <!-- Mensaje de éxito (opcional) -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Barra de acciones -->
        <div class="row mb-3">
            <div class="col-md-6">
                <a class="btn btn-success" href="{{ route('users.create') }}">
                    <i class="fas fa-plus"></i> Nuevo Usuario
                </a>
            </div>
            <div class="col-md-6">
                <form method="GET" class="form-inline float-right">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Buscar usuario..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </form>
            </div>
        </div>

        
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Fecha de Registro</th>
                                <th scope="col">Direccion</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <i class="fas fa-user text-muted"></i> 
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        <i class="fas fa-envelope text-muted"></i> 
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        <i class="fas fa-calendar text-muted"></i> 
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        <i class="fas fa-calendar text-muted"></i> 
                                        {{ $user->personal_info[0]['address'] ?? 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a 
                                                class="btn btn-sm btn-info" 
                                                title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a
                                                class="btn btn-sm btn-warning" 
                                                title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form
                                                    action="{{ route('users.destroy', $user->id) }}"
                                                    method="POST" 
                                                    style="display: inline;"
                                                    onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger" 
                                                        title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Footer con información de paginación -->
            <div class="card-footer">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">
                            
                        </p>
                    </div>
                    <div class="col-md-6">
                       {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
            <!-- Mensaje cuando no hay usuarios -->
            @if($users->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                <h4>No se encontraron usuarios</h4>
                <p>Comienza agregando tu primer usuario.</p>
                <a class="btn btn-primary">
                    <i class="fas fa-plus"></i> Crear Usuario
                </a>
            </div>
            @endif
    <!-- Bootstrap 4 JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>