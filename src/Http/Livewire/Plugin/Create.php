<?php

namespace LaraIO\Generator\Http\Livewire\Plugin;

use Illuminate\Support\Facades\Artisan;
use LaraIO\Core\Livewire\Modal;

class Create extends Modal
{
    public $plugin_name = '';
    public function mount()
    {
        $this->setTitle(__("generator::plugin.title"));
        $this->modal_size = Modal::Small;
    }
    public function DoWork()
    {
        $this->hideModal();
        Artisan::call('plugin:make ' . $this->plugin_name);
        $this->refreshData(['module' => 'plugin']);
    }
    public function render()
    {
        return $this->viewModal('generator::plugin.create');
    }
}
