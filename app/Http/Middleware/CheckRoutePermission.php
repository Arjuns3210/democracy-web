<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Req;
use App\Models\Permission;

class CheckRoutePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session('data')['role_id'] == 1){
            return $next($request);
        }

        $req = Req::instance();
        $parent_codename =  $req->segment(2);
        $permissions = session()->get('permissions');
        $count = count($permissions);
        $permission_array = array();

        for($i=0; $i<$count; $i++){
            $permission_array[$i] = $permissions[$i]->codename;
        }

        if($req->segment(3)){
            $child_codename=$req->segment(3);
            $permissions=Permission::where('codename', 'like', $parent_codename . "%". $child_codename)
            ->select('codename')
            ->get();
            if(in_array($parent_codename,$permission_array)){
                if(in_array($permissions[0]['codename'],$permission_array)){
                    return $next($request);
                }
            }
        }
        else{
            if(in_array($parent_codename,$permission_array)){
                return $next($request);
            }
        }
        return redirect('webadmin/');
    }
}

