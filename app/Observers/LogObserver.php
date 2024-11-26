<?php
namespace App\Observers;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Model;

class LogObserver
{
    /**
     * O método 'created' será chamado quando um novo modelo for criado.
     */
    public function created(Model $model)
    {
        $this->logChange($model, 'create');
    }

    /**
     * O método 'updated' será chamado quando um modelo for atualizado.
     */
    public function updated(Model $model)
    {
        $this->logChange($model, 'update');
    }

    /**
     * O método 'deleted' será chamado quando um modelo for deletado.
     */
    public function deleted(Model $model)
    {
        $this->logChange($model, 'delete');
    }

    /**
     * Função que gera o log de alterações de qualquer modelo.
     */
    protected function logChange(Model $model, string $action)
    {
        Log::create([
            'model' => get_class($model), // Captura o nome do modelo (por exemplo, 'Product', 'SensitiveData', etc.)
            'model_id' => $model->id, // ID do modelo alterado
            'action' => $action, // Ação realizada: create, update, delete
            'changes' => $action == 'delete' ? null : $model->getChanges(), // Se for delete, não registra mudanças
            'user_id' => Auth::id(), // ID do usuário que fez a alteração
            'query' => Request::getQueryString(), // Registra a query de pesquisa, se houver
        ]);
    }
}
