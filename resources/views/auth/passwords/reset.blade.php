@extends('layouts.app')

@section('title', 'Redefinir Senha')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 bg-primary bg-gradient">
    <div class="card shadow-lg border-0" style="width: 380px; border-radius: 16px;">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <i class="bi bi-shield-lock text-primary" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold mt-3 mb-1">Redefinir Senha</h5>
                <p class="text-muted small">Digite sua nova senha para recuperar acesso</p>
            </div>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-floating mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Senha" required autofocus>
                    <label for="password">Senha</label>
                </div>
                @error('password') <div class="text-danger small mb-3">{{ $message }}</div> @enderror

                <div class="form-floating mb-3">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmar Senha" required>
                    <label for="password_confirmation">Confirmar Senha</label>
                </div>
                @error('password_confirmation') <div class="text-danger small mb-3">{{ $message }}</div> @enderror

                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-primary py-2 fw-semibold">Redefinir Senha</button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="small text-muted">Voltar ao login</a>
                </div>
            </form>

            <div class="text-center mt-4">
                <small class="text-muted">© {{ date('Y') }} Planejamento Estratégico</small>
            </div>
        </div>
    </div>
</div>
@endsection