<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Posts;

class authorize_edit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id =$request->input('id');
        $post = posts::find($id);

        if(auth()->user()->username !== $post->editor && auth()->user()->role !== 1 )
        {
  
            abort(403,'Unauthorized.');
        }

        return $next($request);
    }
}
