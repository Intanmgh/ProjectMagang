namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index() {
        return view('user.dashboard');
    }

    public function masuk() {
        return view('user.masuk');
    }

    public function keluar() {
        return view('user.keluar');
    }
}
