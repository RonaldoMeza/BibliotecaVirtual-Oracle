<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Book;

class PrestamoController extends Controller
{
    public function create()
    {
        $usuarios = User::all();     // Usamos modelo Eloquent, no DB::select
        $libros   = Book::all();


        return view('admin.prestamos.create', compact('libros', 'usuarios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'  => 'required|exists:oracle.users,id',
            'libro_id' => 'required|exists:oracle.libros,id_libro',
        ]);

        try {
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare("BEGIN pkg_prestamo.sp_crear_prestamo(:user_id, :libro_id, :new_id); END;");

            $stmt->bindParam(':user_id', $validated['user_id']);
            $stmt->bindParam(':libro_id', $validated['libro_id']);
            $stmt->bindParam(':new_id', $newId, \PDO::PARAM_INT | \PDO::PARAM_INPUT_OUTPUT, 10);

            $stmt->execute();

            if ($newId > 0) {
                return redirect()->route('admin.prestamos.index')->with('success', '✅ Préstamo registrado correctamente.');
            } else {
                return back()->with('error', '❌ Error: no se pudo registrar el préstamo.')->withInput();
            }

        } catch (\Exception $e) {
            return back()->with('error', '❌ Error al registrar el préstamo: ' . $e->getMessage())->withInput();
        }
    }


    public function index()
    {
        $prestamos = DB::select("
            SELECT p.id_prestamo, u.name as usuario, l.titulo,
                TO_CHAR(p.fecha_prestamo, 'YYYY-MM-DD') as fecha_prestamo,
                TO_CHAR(p.fecha_devolucion, 'YYYY-MM-DD') as fecha_devolucion,
                p.estado
            FROM prestamos p
            JOIN users u ON u.id = p.user_id
            JOIN libros l ON l.id_libro = p.libro_id
            ORDER BY p.fecha_prestamo DESC"
        );

        return view('admin.prestamos.index', compact('prestamos'));
    }

    public function devolver($id)
    {
        try {
            DB::statement("BEGIN pkg_prestamo.sp_devolver_libro(:p_prestamo); END;", [
                ':p_prestamo' => $id
            ]);

            return redirect()->route('admin.prestamos.index')->with('success', 'Libro devuelto correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.prestamos.index')->with('error', 'Error al devolver libro: ' . $e->getMessage());
        }
    }


    public function historial()
    {
        $user_id = Auth::id();
        $cursor = null;

        DB::statement('BEGIN pkg_prestamo.sp_historial_usuario(:user_id, :cur); END;', [
            ':user_id' => $user_id,
            ':cur' => &$cursor
        ]);

        $resultados = [];
        if ($cursor) {
            while ($row = oci_fetch_assoc($cursor)) {
                $resultados[] = $row;
            }
            oci_free_statement($cursor);
        }

        return view('historial', ['historial' => $resultados]);
    }
}
