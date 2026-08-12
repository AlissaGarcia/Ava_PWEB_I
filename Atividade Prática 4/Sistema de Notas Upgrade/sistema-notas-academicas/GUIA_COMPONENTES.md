# Guia de Uso - Componentes e Layout

## 📋 Layout Base

Toda view deve estender o layout base:

```blade
@extends('layouts.app')

@section('title', 'Título da Página')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800">Seu Cabeçalho</h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <!-- Seu conteúdo aqui -->
        </div>
    </div>
@endsection
```

---

## 🎨 Componentes Disponíveis

### 1. Alert - Exibir Mensagens

```blade
<!-- Sucesso -->
<x-alert type="success" message="Operação realizada com sucesso!" />

<!-- Erro -->
<x-alert type="error" message="Ocorreu um erro ao processar a solicitação" />

<!-- Aviso -->
<x-alert type="warning" message="Atenção: esta ação é irreversível" />

<!-- Informação -->
<x-alert type="info" message="Informação importante para você" />

<!-- Com slot e customização -->
<x-alert type="success" dismissible="false">
    Sua nota foi salva com sucesso!
</x-alert>
```

---

### 2. Button - Botões Reutilizáveis

```blade
<!-- Botão primário padrão -->
<x-button>Clique aqui</x-button>

<!-- Botão com link -->
<x-button variant="primary" href="/notes">Ver Minhas Notas</x-button>

<!-- Diferentes variantes -->
<x-button variant="success">Sucesso</x-button>
<x-button variant="danger">Deletar</x-button>
<x-button variant="secondary">Cancelar</x-button>

<!-- Diferentes tamanhos -->
<x-button size="sm">Pequeno</x-button>
<x-button size="md">Médio</x-button>
<x-button size="lg">Grande</x-button>

<!-- Com ícones -->
<x-button>
    <svg class="w-4 h-4"><!-- SVG --></svg>
    Botão com ícone
</x-button>

<!-- Desabilitado -->
<x-button disabled>Desabilitado</x-button>
```

---

### 3. Card - Cards Genéricos

```blade
<!-- Card simples -->
<x-card>
    Conteúdo do card
</x-card>

<!-- Card com título -->
<x-card title="Minhas Notas">
    Lista de notas aqui
</x-card>

<!-- Card com título e subtítulo -->
<x-card title="Dashboard" subtitle="Bem-vindo ao sistema">
    Conteúdo principal
</x-card>

<!-- Aninhando componentes -->
<x-card title="Ações">
    <x-button>Ação 1</x-button>
    <x-button variant="danger">Ação 2</x-button>
</x-card>
```

---

### 4. Form Input - Campos de Formulário

```blade
<!-- Input simples -->
<x-form-input name="nome" />

<!-- Input com label -->
<x-form-input name="email" label="Email" type="email" />

<!-- Input com placeholder -->
<x-form-input 
    name="buscar" 
    label="Buscar notas"
    placeholder="Digite o termo de busca..."
/>

<!-- Textarea -->
<x-form-input 
    name="conteudo" 
    label="Conteúdo"
    type="textarea"
    placeholder="Digite seu conteúdo..."
/>

<!-- Input com valor pré-preenchido -->
<x-form-input 
    name="titulo"
    label="Título"
    value="Título anterior"
/>

<!-- Exibição automática de erros -->
<!-- Os erros do Laravel são exibidos automaticamente -->
<form method="POST" action="/notes">
    @csrf
    <x-form-input name="titulo" label="Título" />
    <!-- Se houver erro em 'titulo', será exibido automaticamente -->
</form>
```

---

### 5. Note Card - Cards de Notas

```blade
<!-- Usar em loops de notas -->
@foreach ($notes as $note)
    <x-note-card :note="$note" />
@endforeach

<!-- Em um grid responsivo -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($notes as $note)
        <x-note-card :note="$note" />
    @endforeach
</div>
```

---

## 🔐 Diretivas de Autenticação

```blade
<!-- Verificar se usuário está autenticado -->
@auth
    <p>Bem-vindo, {{ auth()->user()->name }}!</p>
@endauth

<!-- Verificar se usuário não está autenticado -->
@guest
    <p>Você precisa fazer login para continuar</p>
@endguest

<!-- Verificar guard específico -->
@auth('admin')
    <p>Painel administrativo</p>
@endauth
```

---

## 🎯 Exemplo Completo

```blade
@extends('layouts.app')

@section('title', 'Minhas Notas')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800">Minhas Notas</h2>
        <x-button variant="primary" href="/notes/create">Nova Nota</x-button>
    </div>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <x-alert type="success" message="{{ session('success') }}" />
            @endif

            @if($notes->isEmpty())
                <x-card title="Nenhuma nota">
                    <p class="text-gray-600 mb-4">Você ainda não criou nenhuma nota</p>
                    <x-button variant="primary" href="/notes/create">Criar primeira nota</x-button>
                </x-card>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($notes as $note)
                        <x-note-card :note="$note" />
                    @endforeach
                </div>
            @endif

        </div>
    </div>
@endsection
```

---

## 📱 Classes Tailwind Úteis

```blade
<!-- Espaçamento -->
<div class="p-6">Padding</div>
<div class="m-4">Margin</div>
<div class="py-12">Vertical padding</div>

<!-- Cores -->
<div class="bg-indigo-600">Background indigo</div>
<div class="text-white">Texto branco</div>
<div class="border-gray-200">Border cinza</div>

<!-- Layout -->
<div class="flex gap-4">Layout flexível</div>
<div class="grid grid-cols-3 gap-6">Grid 3 colunas</div>
<div class="max-w-7xl mx-auto">Contêiner centralizado</div>

<!-- Responsividade -->
<div class="md:grid-cols-2 lg:grid-cols-3">Responsivo</div>
<div class="sm:px-6 lg:px-8">Padding responsivo</div>

<!-- Estados -->
<div class="hover:bg-gray-100">Hover</div>
<div class="focus:ring-2">Focus</div>
<div class="transition">Transição</div>
```

---

## ✅ Checklist de Boas Práticas

- ✅ Use `@extends('layouts.app')` em todas as views
- ✅ Defina `@section('title')` para SEO
- ✅ Use componentes reutilizáveis sempre que possível
- ✅ Mantenha o conteúdo em `@section('content')`
- ✅ Use `@auth/@guest` para conteúdo condicional
- ✅ Aproveite o sistema de alertas para feedback
- ✅ Siga a estrutura de grid responsivo
- ✅ Use Tailwind classes para estilização

---

**Criado em:** 12/08/2026  
**Versão:** 1.0  
**Status:** Ativo
