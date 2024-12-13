<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            flash()->error('Bạn phải đăng nhập mới thực hiện được chức năng này.');
            return redirect()->route('auth.admin');
        } else if (Auth::user()->status == 0) {
            Auth::logout();
            flash()->error('Tài khoản của bạn đã bị khoá.');
            return redirect()->route('auth.admin')->withInput();
        }

        $user = $this->userRepository->getWithCatalogueById(Auth::id());
        View::share('currentUser', $user->first());
        return $next($request);
    }
}
