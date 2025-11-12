<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório do Plano Estratégico - {{ $plano->titulo }}</title>
    <style>
        @page {
            margin: 100px 40px 60px 40px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        /* Cabeçalho */
        header {
            position: fixed;
            top: -80px;
            left: 0;
            right: 0;
            height: 60px;
            text-align: center;
            border-bottom: 2px solid #0a3d62;
        }

        header img {
            height: 45px;
            margin-bottom: 5px;
        }

        header h1 {
            margin: 0;
            font-size: 14px;
            color: #0a3d62;
            text-transform: uppercase;
        }

        /* Rodapé */
        footer {
            position: fixed;
            bottom: -40px;
            left: 0;
            right: 0;
            height: 30px;
            text-align: center;
            border-top: 1px solid #aaa;
            font-size: 10px;
            color: #666;
        }

        footer .page-number:after {
            content: counter(page);
        }

        /* Conteúdo */
        h2, h3 {
            color: #0a3d62;
            margin-bottom: 5px;
        }

        h2 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 3px;
            margin-top: 20px;
        }

        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th, .table td {
            border: 1px solid #bbb;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }

        .table th {
            background-color: #f1f2f6;
            font-weight: bold;
        }

        .info-box {
            border: 1px solid #ccc;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 6px;
        }

        .small {
            font-size: 10px;
            color: #666;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

    <header>
        <h1>Relatório do Plano Estratégico</h1>
    </header>

    <footer>
        Página <span class="page-number"></span>
    </footer>

    <main>
        <h2>{{ $plano->titulo }}</h2>

        <div class="section">
            <div class="info-box">
                <p><strong>Visão:</strong> {{ $plano->visao }}</p>
                <p><strong>Missão:</strong> {{ $plano->missao }}</p>
                <p><strong>Valores:</strong> {{ $plano->valores }}</p>
                <p class="small">Gerado em: {{ now()->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        @if($plano->diagnostico)
        <div class="section">
            <h2>Diagnóstico Estratégico</h2>
            <table class="table">
                <tr>
                    <th>Pontos Fortes</th>
                    <th>Pontos Fracos</th>
                    <th>Oportunidades</th>
                    <th>Ameaças</th>
                </tr>
                <tr>
                    <td>{{ $plano->diagnostico->pontos_fortes }}</td>
                    <td>{{ $plano->diagnostico->pontos_fracos }}</td>
                    <td>{{ $plano->diagnostico->oportunidades }}</td>
                    <td>{{ $plano->diagnostico->ameacas }}</td>
                </tr>
            </table>
        </div>
        @endif

        <div class="section">
            <h2>Objetivos Estratégicos</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Específico</th>
                        <th>Mensurável</th>
                        <th>Atingível</th>
                        <th>Relevante</th>
                        <th>Tempo Definido</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plano->objetivos as $obj)
                    <tr>
                        <td>{{ $obj->descricao }}</td>
                        <td>{{ $obj->especifico }}</td>
                        <td>{{ $obj->mensuravel }}</td>
                        <td>{{ $obj->atingivel }}</td>
                        <td>{{ $obj->relevante }}</td>
                        <td>{{ $obj->tempo_definido }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="section page-break">
            <h2>Pilares Estratégicos</h2>
            @foreach($plano->pilares as $pilar)
                <h3>{{ $pilar->nome }}</h3>
                <p><strong>Objetivo:</strong> {{ $pilar->objetivo }}</p>
                <p><strong>Meta:</strong> {{ $pilar->meta }}</p>
                <p><strong>Indicador:</strong> {{ $pilar->indicador }}</p>
                <p><strong>Período:</strong> {{ $pilar->data_inicio->format('d/m/Y') }} - {{ $pilar->data_fim->format('d/m/Y') }}</p>
                
                @if($pilar->tasks->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tarefa</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th>Prioridade</th>
                            <th>Responsável</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pilar->tasks as $task)
                        <tr>
                            <td>{{ $task->titulo }}</td>
                            <td>{{ $task->descricao }}</td>
                            <td>{{ ucfirst($task->status) }}</td>
                            <td>{{ ucfirst($task->prioridade) }}</td>
                            <td>{{ optional($task->responsavel)->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            @endforeach
        </div>
    </main>
</body>
</html>
