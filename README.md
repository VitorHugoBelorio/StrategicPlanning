# Strategic Planning

Sistema Laravel para Gestão e Estruturação de Plano Estratégico

O Strategic Planning é um sistema desenvolvido em Laravel + Blade +
MySQL que permite que qualquer usuário crie e acompanhe um Plano
Estratégico completo, de forma organizada e centralizada.

O sistema permite registrar e visualizar: - Diagnóstico estratégico
(pontos fortes, fracos, oportunidades e ameaças) - Objetivos
estratégicos - Pilares (trilhas estratégicas) - Tasks relacionadas aos
pilares - Indicadores de desempenho - Relatórios consolidados do plano

## Tecnologias Utilizadas

-   Laravel 12
-   PHP 8
-   Blade Templates
-   Bootstrap 5
-   MySQL via XAMPP
-   Composer

## Estrutura do Sistema (Entidades Principais)

-   PlanoEstrategico
-   DiagnosticoEstrategico
-   ObjetivoEstrategico
-   PilarEstrategico
-   Task
-   IndicadorDesempenho
-   User

## Autenticação

O sistema inclui: - Login - Registro de usuário - Logout - Recuperação
de senha - Middleware auth

## Requisitos para Instalação

-   PHP 8.1+
-   Composer 2+
-   MySQL
-   Node.js (opcional)

## Como Instalar e Rodar

1.  Clone o repositório
2.  Instale dependências com composer install
3.  Configure o arquivo .env
4.  Gere a key: php artisan key:generate
5.  Rode as migrações: php artisan migrate
6.  Inicie o servidor: php artisan serve

## Rotas Principais

Rotas públicas: login, registro, recuperação de senha. Rotas protegidas:
dashboard, planos, diagnósticos, objetivos, pilares, tasks, indicadores
e relatórios.

## Estrutura MVC

O projeto segue o padrão Laravel: - Controllers - Models - Views
(Blade) - Rotas em web.php

## Licença

Projeto acadêmico/didático.

## Autores

Vitor Hugo Belorio
Felipe Toshiaki Nakano
Kauan Kaiky Takano
Gabriel Cardoso
