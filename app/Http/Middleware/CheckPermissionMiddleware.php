namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleAndPermission
{
    public function handle($request, Closure $next, ...$rolesAndPermissions)
    {
        $user = Auth::user();

        foreach ($rolesAndPermissions as $roleOrPermission) {
            if ($user->hasRole($roleOrPermission) || $user->hasPermissionTo($roleOrPermission)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
