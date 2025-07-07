namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        $barangs = Barang::all(); // Ambil data dari tabel barangs
        return view('pimpinan.data', compact('barangs'));
    }
}
