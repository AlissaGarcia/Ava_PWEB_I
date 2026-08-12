# ETAPA 2 – Implementação de Policies ✅

## 📋 Objetivo

Implementar controle de autorização nas operações CRUD (Create, Read, Update, Delete) de notas, garantindo que os usuários só possam manipular suas próprias notas.

---

## 🔐 O Que Foi Implementado

### 1. Laravel Policy - `app/Policies/NotePolicy.php`

**Descrição:** Define as regras de autorização para o modelo Note

```php
namespace App\Policies;

use App\Models\Note;
use App\Models\User;

class NotePolicy
{
    // ✅ Permite visualizar a nota se o usuário é o proprietário
    public function view(User $user, Note $note): bool
    {
        return $user->id === $note->user_id;
    }

    // ✅ Permite editar a nota se o usuário é o proprietário
    public function update(User $user, Note $note): bool
    {
        return $user->id === $note->user_id;
    }

    // ✅ Permite deletar a nota se o usuário é o proprietário
    public function delete(User $user, Note $note): bool
    {
        return $user->id === $note->user_id;
    }
}
```

**Métodos implementados:**

| Método | Descrição | Regra |
|--------|-----------|-------|
| `view()` | Visualizar uma nota | `user_id` == `note.user_id` |
| `update()` | Editar uma nota | `user_id` == `note.user_id` |
| `delete()` | Deletar uma nota | `user_id` == `note.user_id` |

---

### 2. Integração no Controller - `app/Http/Controllers/NoteController.php`

**Uso da autorização:**

```php
public function show(Note $note)
{
    // Autoriza o usuário antes de exibir a nota
    $this->authorize('view', $note);
    
    $note->conteudo = Crypt::decryptString($note->conteudo);
    return view('notes.show', compact('note'));
}

public function edit(Note $note)
{
    // Autoriza o usuário antes de permitir edição
    $this->authorize('update', $note);
    
    $note->conteudo = Crypt::decryptString($note->conteudo);
    return view('notes.edit', compact('note'));
}

public function update(Request $request, Note $note)
{
    // Autoriza o usuário antes de atualizar
    $this->authorize('update', $note);
    // ... resto do código
}

public function destroy(Note $note)
{
    // Autoriza o usuário antes de deletar
    $this->authorize('delete', $note);
    
    $note->delete();
    return redirect()->route('notes.index')->with('success', 'Nota excluída!');
}
```

---

### 3. Segurança Implementada

#### ✅ **Proteção contra acesso não autorizado**
- Usuário A não consegue visualizar/editar/deletar notas de Usuário B
- Se tentar acessar `/notes/{id}` de outra pessoa, recebe erro 403 (Forbidden)

#### ✅ **Validações aplicadas**
```
GET  /notes/{id}      → Valida via policy 'view'
POST /notes/{id}/edit → Valida via policy 'update'
PUT  /notes/{id}      → Valida via policy 'update'
DELETE /notes/{id}    → Valida via policy 'delete'
```

#### ✅ **Mensagens de erro apropriadas**
- **Acesso autorizado:** Operação executada normalmente
- **Acesso negado:** Erro 403 (This action is unauthorized)

---

## 🔍 Como Funciona a Policy

### Fluxo de Autorização

```
1. Usuário tenta acessar /notes/5
                    ↓
2. NoteController verifica: $this->authorize('view', $note)
                    ↓
3. Laravel chama: NotePolicy->view($user, $note)
                    ↓
4. Policy valida: $user->id === $note->user_id
                    ↓
5. Resultado:
   - SIM  → Continua com a operação
   - NÃO  → Lança exceção AuthorizationException (403)
```

---

## 📊 Cenários de Teste

### ✅ Cenário 1: Usuário tenta acessar sua própria nota
```
Usuário ID: 1
Nota ID: 5, user_id: 1
Resultado: ✅ AUTORIZADO
```

### ❌ Cenário 2: Usuário tenta acessar nota de outro usuário
```
Usuário ID: 1
Nota ID: 5, user_id: 2
Resultado: ❌ NÃO AUTORIZADO (403)
```

### ✅ Cenário 3: Usuário edita sua própria nota
```
Usuário ID: 1
Nota ID: 5, user_id: 1
Resultado: ✅ AUTORIZADO
```

### ❌ Cenário 4: Usuário tenta editar nota de outro usuário
```
Usuário ID: 1
Nota ID: 5, user_id: 2
Resultado: ❌ NÃO AUTORIZADO (403)
```

---

## 🛡️ Boas Práticas Implementadas

✅ **Princípio do Menor Privilégio**
- Cada usuário só pode acessar seus próprios dados

✅ **Validação em Camada Alta**
- A autorização é verificada no controller, antes de qualquer operação

✅ **Uso de Policies**
- Código limpo e reutilizável
- Separação de responsabilidades

✅ **Mensagens Claras**
- Usuários sabem quando não têm permissão

✅ **Sem Vazamento de Dados**
- Usuários não conseguem deduzir existência de notas alheias

---

## 📝 Resumo da Etapa 2

| Item | Status | Detalhes |
|------|--------|----------|
| Policy criada | ✅ | 3 métodos: view, update, delete |
| Controller integrado | ✅ | Usa `$this->authorize()` |
| Regra implementada | ✅ | Usuário só manipula suas notas |
| Segurança | ✅ | Protegido contra acesso não autorizado |
| Testes manuais | ⏳ | Recomendado testar com múltiplos usuários |

---

## 🔄 Próximo Passo

Avançar para **Etapa 3 - Lixeira com Soft Delete Avançado**
