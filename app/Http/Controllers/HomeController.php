<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDO;

class HomeController extends Controller
{
    public function dashboard() 
    { 
        return view('dashboard'); 
    }

    public function home()
    {
        $books = \App\Models\Book::with(['author', 'category'])->get();
        $historial = [];

        $pdo = DB::connection('oracle')->getPdo();

        // Preparar la llamada al procedimiento PL/SQL
        $stmt = $pdo->prepare("BEGIN pkg_prestamo.sp_historial_usuario(:user_id, :cursor); END;");

        // Definir variables
        $userId = Auth::id();
        $cursor = null;

        // Vincular los parámetros
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':cursor', $cursor, PDO::PARAM_STMT); // <- PARAM_STMT es CLAVE

        // Ejecutar
        $stmt->execute();

        // Leer datos desde el cursor
        oci_execute($cursor); // aquí sí es un resource OCI8
        while ($row = oci_fetch_assoc($cursor)) {
            $historial[] = $row;
        }

        return view('home', compact('books', 'historial'));
    }
    
}
