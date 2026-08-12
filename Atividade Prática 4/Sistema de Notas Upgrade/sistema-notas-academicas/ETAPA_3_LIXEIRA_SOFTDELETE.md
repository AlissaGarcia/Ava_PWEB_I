# ETAPA 3 – Lixeira com Soft Delete Avançado ✅

## 📋 Objetivo

Implementar um sistema completo de lixeira que permite aos usuários deletar notas de forma reversível, com opções de restauração ou exclusão permanente.

---

## 🗑️ O Que Foi Implementado

### 1. Soft Delete - `app/Models/Note.php`

**Descrição:** O Laravel Eloquent fornece o trait `SoftDeletes` que implementa exclusão lógica

```php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'titulo',
        'conteudo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

**Como funciona:**
- Quando você chama `$note->delete()`, o registro não é removido do banco
- Apenas a coluna `deleted_at` é preenchida com a data/hora
- Queries automáticas filtram registros deletados por padrão

**Banco de dados:**
```
notes table:
- id
- user_id
- titulo
- conteudo
- created_at
- updated_at
- deleted_at ← Adicionada pela migration
```

---

### 2. Migration - `database/migrations/2026_08_09_000000_create_notes_table.php`

```php
Schema::create('notes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->string('titulo');
    $table->text('conteudo');
    $table->timestamps();
    $table->softDeletes(); // ← Adiciona coluna deleted_at
});
```

---

### 3. Métodos de Lixeira - `app/Http/Controllers/NoteController.php`

#### 🗑️ **Listar Notas Deletadas**
```php
public function trash()
{
    // Exibe apenas notas do usuário que foram deletadas
    $notes = auth()->user()->notes()->onlyTrashed()->latest('deleted_at')->get();
    return view('notes.trash', compact('notes'));
}
```

**Características:**
- `onlyTrashed()` - Retorna apenas registros com deleted_at != NULL
- `latest('deleted_at')` - Ordena pelas mais recentemente deletadas
- `auth()->user()->notes()` - Garante que só vê suas próprias notas

---

#### 🔄 **Restaurar Nota**
```php
public function restore($id)
{
    // Encontra a nota deletada do usuário
    $note = auth()->user()->notes()->withTrashed()->findOrFail($id);
    
    // Valida se o usuário tem permissão para deletar (lógica de propriedade)
    $this->authorize('delete', $note);
    
    // Restaura a nota (remove deleted_at)
    $note->restore();
    
    return redirect()->route('notes.trash')->with('success', 'Nota restaurada!');
}
```

**Características:**
- `withTrashed()` - Inclui registros deletados na busca
- `restore()` - Muda `deleted_at` para NULL
- Mantém toda a data original (created_at, conteúdo, etc)
- Usa a mesma policy de autorização

---

#### 🔥 **Deletar Permanentemente**
```php
public function forceDelete($id)
{
    // Encontra a nota deletada do usuário
    $note = auth()->user()->notes()->withTrashed()->findOrFail($id);
    
    // Valida se o usuário tem permissão
    $this->authorize('delete', $note);
    
    // Deleta permanentemente (remove do banco de dados)
    $note->forceDelete();
    
    return redirect()->route('notes.trash')->with('success', 'Nota deletada permanentemente!');
}
```

**Características:**
- `forceDelete()` - Remove o registro do banco completamente
- ⚠️ **IRREVERSÍVEL** - Não pode ser desfeito
- Pede confirmação ao usuário

---

#### 🧹 **Esvaziar Lixeira**
```php
public function emptyTrash()
{
    // Deleta permanentemente TODAS as notas deletadas do usuário
    auth()->user()->notes()->onlyTrashed()->forceDelete();
    
    return redirect()->route('notes.trash')->with('success', 'Lixeira esvaziada!');
}
```

**Características:**
- Limpa toda a lixeira de uma vez
- Pede confirmação com modal JavaScript
- ⚠️ Ação permanente e irreversível

---

#### 🔙 **Restaurar Todas**
```php
public function restoreAll()
{
    // Restaura TODAS as notas deletadas do usuário
    auth()->user()->notes()->onlyTrashed()->restore();
    
    return redirect()->route('notes.trash')->with('success', 'Todas restauradas!');
}
```

---

### 4. Rotas - `routes/web.php`

```php
Route::prefix('notes/trash')->name('notes.')->group(function () {
    Route::get('/', [NoteController::class, 'trash'])->name('trash');
    Route::post('{id}/restore', [NoteController::class, 'restore'])->name('restore');
    Route::delete('{id}/force-delete', [NoteController::class, 'forceDelete'])->name('forceDelete');
    Route::delete('empty', [NoteController::class, 'emptyTrash'])->name('emptyTrash');
    Route::post('restore-all', [NoteController::class, 'restoreAll'])->name('restoreAll');
});
```

**Endpoints:**

| Método | URL | Ação |
|--------|-----|------|
| GET | `/notes/trash` | Listar lixeira |
| POST | `/notes/trash/{id}/restore` | Restaurar nota |
| DELETE | `/notes/trash/{id}/force-delete` | Deletar permanente |
| DELETE | `/notes/trash/empty` | Esvaziar lixeira |
| POST | `/notes/trash/restore-all` | Restaurar todas |

---

### 5. View da Lixeira - `resources/views/notes/trash.blade.php`

**Funcionalidades:**

✅ **Interface vazia amigável**
- Mensagem quando lixeira está vazia
- Link para voltar ao dashboard

✅ **Alertas informativos**
- Mostra quantas notas estão na lixeira
- Avisa que serão deletadas em 30 dias (customizável)
- Educação sobre reversibilidade

✅ **Ações em massa**
- Restaurar todas as notas
- Esvaziar lixeira completamente

✅ **Cards individuais para cada nota**
- Título, data de criação
- **Data de exclusão com ícone**
- Preview do conteúdo
- Botões de ação (Restaurar, Deletar permanentemente)
- Border em amarelo para indicar status

✅ **Confirmações de segurança**
- Modal JavaScript pergunta antes de restaurar
- Modal JavaScript pergunta (com ênfase) antes de deletar permanente
- Valida com `onsubmit` nos formulários

---

### 6. Componente da Lixeira - `resources/views/components/trash-note-card.blade.php`

**Componente reutilizável para cards da lixeira**

```blade
<x-trash-note-card :note="$note" />
```

**Características:**
- Border amarelo indicando status de lixeira
- Exibe data de exclusão destaque
- Botões de restaurar e deletar permanente
- Confirmações de segurança integradas

---

### 7. Navbar Atualizada

**Link de lixeira com badge de contagem:**

```blade
<a href="{{ route('notes.trash') }}" class="...">
    <span>🗑️</span>
    <span>Lixeira</span>
    @if(auth()->user()->notes()->onlyTrashed()->exists())
        <span class="badge">{{ count }}</span>
    @endif
</a>
```

**Características:**
- Ícone 🗑️ emoji para rápida identificação
- Badge com contagem de notas na lixeira
- Link dinâmico sempre visível

---

### 8. Index com Alerta de Lixeira

**Quando há notas na lixeira:**

```blade
<x-alert type="warning" message="X nota(s) na lixeira">
    Você tem notas deletadas que podem ser restauradas.
    <a href="{{ route('notes.trash') }}">Abrir Lixeira</a>
</x-alert>
```

**Características:**
- Alerta amarelo destacando existência de lixeira
- Botão direto para abrir lixeira
- Só aparece quando há itens na lixeira

---

## 🔄 Fluxo de Funcionamento

### Deletando uma Nota

```
Usuário clica "Excluir" na nota
                ↓
Modal JavaScript: "Deseja realmente excluir?"
                ↓
POST /notes/{id}
                ↓
NoteController::destroy() executa:
  - Autoriza o usuário
  - Chama $note->delete()
                ↓
Laravel Eloquent:
  - Não remove o registro do banco
  - Apenas preenche deleted_at com a data
                ↓
Redireciona para /notes com mensagem:
"Nota excluída e movida para lixeira!"
```

---

### Visualizando a Lixeira

```
Usuário clica em "🗑️ Lixeira"
                ↓
GET /notes/trash
                ↓
NoteController::trash() executa:
  - Pega notas do usuário
  - Filtra com onlyTrashed()
  - Ordena por deleted_at
                ↓
Retorna view com cards da lixeira
```

---

### Restaurando uma Nota

```
Usuário clica "Restaurar" na lixeira
                ↓
Modal JavaScript: "Restaurar esta nota?"
                ↓
POST /notes/trash/{id}/restore
                ↓
NoteController::restore() executa:
  - Encontra a nota deletada
  - Autoriza o usuário
  - Chama $note->restore()
                ↓
Laravel Eloquent:
  - Muda deleted_at para NULL
  - Nota volta ao estado normal
                ↓
Redireciona para lixeira com mensagem:
"Nota restaurada com sucesso!"
```

---

### Deletando Permanentemente

```
Usuário clica "Deletar" na lixeira
                ↓
Modal JavaScript (com ênfase):
"Deseja realmente deletar PERMANENTEMENTE?
Esta ação é IRREVERSÍVEL!"
                ↓
DELETE /notes/trash/{id}/force-delete
                ↓
NoteController::forceDelete() executa:
  - Encontra a nota deletada
  - Autoriza o usuário
  - Chama $note->forceDelete()
                ↓
Laravel Eloquent:
  - Executa DELETE SQL
  - Remove completamente do banco
                ↓
Redireciona com mensagem:
"Nota deletada permanentemente!"
```

---

## 🔍 Queries SQL Geradas

### Soft Delete (Delete)
```sql
UPDATE notes SET deleted_at = '2026-08-12 22:54:00' WHERE id = 5;
```

### Listar Apenas Ativas
```sql
SELECT * FROM notes 
WHERE user_id = 1 AND deleted_at IS NULL;
```

### Listar Apenas na Lixeira
```sql
SELECT * FROM notes 
WHERE user_id = 1 AND deleted_at IS NOT NULL;
```

### Restaurar
```sql
UPDATE notes SET deleted_at = NULL WHERE id = 5;
```

### Deletar Permanentemente
```sql
DELETE FROM notes WHERE id = 5;
```

---

## 🛡️ Segurança Implementada

✅ **Isolamento por Usuário**
- Cada usuário só vê suas próprias notas (ativas e deletadas)
- Usa `auth()->user()->notes()` para garantir propriedade

✅ **Autorização com Policy**
- Verifica proprietário antes de restaurar/deletar

✅ **Confirmações de Segurança**
- Modais JavaScript para ações críticas
- Ênfase especial em "Deletar permanentemente"

✅ **Proteção contra XSS**
- Usa `{{ }}` no Blade (escape automático)

✅ **Proteção CSRF**
- Todos os formulários incluem `@csrf`

✅ **Validação de Entrada**
- Usa `findOrFail()` (lança 404 se não encontrar)
- `withTrashed()` garante que busca inclua deletadas

---

## 📊 Métricas de Implementação

| Item | Quantidade |
|------|-----------|
| Métodos no Controller | 5 |
| Rotas de lixeira | 5 |
| Views criadas/modificadas | 3 |
| Componentes criados | 1 |
| Queries SQL diferentes | 5 |
| Confirmações modais | 2 |
| Ações em massa | 2 |

---

## 🧪 Casos de Teste

### ✅ Teste 1: Deletar e Restaurar
```
1. Criar nota
2. Deletar nota
3. Verificar em /notes (não aparece)
4. Ir para /notes/trash
5. Restaurar nota
6. Verificar em /notes (aparece novamente)
```

### ✅ Teste 2: Deletar Permanentemente
```
1. Criar nota
2. Deletar nota (soft delete)
3. Ir para lixeira
4. Deletar permanentemente
5. Ir para lixeira (não aparece mais)
6. Buscar no banco (não existe)
```

### ✅ Teste 3: Isolamento por Usuário
```
1. Usuário A: Criar nota
2. Usuário A: Deletar nota
3. Usuário B: Acessar /notes/trash
4. Resultado: Lixeira vazia (não vê notas de A)
```

### ✅ Teste 4: Ações em Massa
```
1. Usuário: Criar 3 notas
2. Usuário: Deletar 3 notas
3. Ir para lixeira
4. Clicar "Restaurar Tudo"
5. Resultado: 3 notas restauradas e visíveis
```

---

## 📈 Recursos Utilizados

### Laravel Traits
- `SoftDeletes` - Implementa soft delete automático

### Métodos Eloquent
- `onlyTrashed()` - Filtra apenas deletados
- `withTrashed()` - Inclui deletados na busca
- `delete()` - Soft delete
- `restore()` - Remove `deleted_at`
- `forceDelete()` - Delete permanente

### View Components
- `<x-trash-note-card>` - Card da lixeira
- `<x-alert>` - Alertas na interface

---

## 🔄 Integração com Etapa 2 (Policies)

A lixeira utiliza as mesmas **Policies** da Etapa 2:

```php
$this->authorize('delete', $note); // Validação em restaurar/deletar
```

Isso garante que:
- Usuário A não consegue restaurar nota de Usuário B
- Usuário A não consegue deletar permanentemente nota de Usuário B
- Segurança mantida em todas as operações

---

## 📝 Resumo da Etapa 3

| Item | Status | Detalhes |
|------|--------|----------|
| Soft Delete | ✅ | Trait + Migration |
| Métodos de lixeira | ✅ | 5 métodos no controller |
| Rotas | ✅ | 5 endpoints configurados |
| Views | ✅ | trash.blade.php + componentes |
| Segurança | ✅ | Policies + CSRF + Confirmações |
| Integração Navbar | ✅ | Link com badge de contagem |
| Integração Index | ✅ | Alerta quando há lixeira |
| Ações em massa | ✅ | Restaurar/Esvaziar tudo |

---

## 🎯 Próximas Etapas

Após Etapa 2 e 3, implementar:
- **Etapa 4:** Auditoria de registros (log de criação/edição/exclusão)
- **Etapa 5:** Filtros e busca avançada (por data, por título, ordenação)

---

**Status:** ✅ ETAPA 3 CONCLUÍDA COM SUCESSO

*Implementação de lixeira robusta e segura com Soft Delete completo*
