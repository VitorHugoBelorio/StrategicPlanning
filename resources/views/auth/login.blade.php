@extends('layouts.app')

@section('title', 'Login - Planejamento Estratégico')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 bg-primary bg-gradient">
    <div class="card shadow-lg border-0" style="width: 380px; border-radius: 16px;">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <i class="bi bi-bullseye text-primary" style="font-size: 3rem;"></i>
                <h4 class="fw-bold mt-3 mb-1">Planejamento Estratégico</h4>
                <p class="text-muted small">Acesse sua conta para continuar</p>
            </div>

            @if ($errors->has('error'))
                <div class="alert alert-danger text-center py-2">{{ $errors->first('error') }}</div>
            @endif

            <form action="{{ route('login.attempt') }}" method="POST">
                @csrf

                <div class="form-floating mb-3">
                    <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required autofocus>
                    <label for="email">E-mail</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Senha" required>
                    <label for="password">Senha</label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary py-2 fw-semibold">Entrar</button>
                </div>
            </form>

            <div class="text-center mt-4">
                <small class="text-muted">© {{ date('Y') }} Planejamento Estratégico</small>
            </div>
        </div>
    </div>
</div>
@endsection
