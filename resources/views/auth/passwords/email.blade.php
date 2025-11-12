@extends('layouts.app')

@section('title', 'Recuperar Senha')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 bg-primary bg-gradient">
    <div class="card shadow-lg border-0" style="width: 380px; border-radius: 16px;">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <i class="bi bi-shield-lock text-primary" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold mt-3 mb-1">Recuperar Senha</h5>
                <p class="text-muted small">Informe o e-mail para receber o link de redefinição</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success text-center py-2">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}" required autofocus>
                    <label for="email">E-mail</label>
                </div>
                @error('email') <div class="text-danger small mb-3">{{ $message }}</div> @enderror

                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-primary py-2 fw-semibold">Enviar link de recuperação</button>
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