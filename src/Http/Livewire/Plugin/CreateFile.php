<?php

namespace LaraIO\Generator\Http\Livewire\Plugin;

use Illuminate\Support\Facades\Artisan;
use LaraIO\Core\Livewire\Modal;

class CreateFile extends Modal
{ 
    public $plugin_name = '';
    public $file_name = '';
    public $file_type = 'command';
    public $array_type = [
        "command",
        'livewire',
        "component",
        "component-view",
        "migration",
        "middleware",
        "model",
        "controller",
        "seed",
        "event",
        "factory",
        "job",
        "listener",
        "mail",
        "notification",
        "policy",
        "provider",
        "request",
        "resource",
        "provider",
        "rule"
    ];
    public function mount($plugin)
    {
        $this->plugin_name=$plugin;
        $this->setTitle('Create New Plugin:'.$plugin);
        $this->modal_size = Modal::Large;
    }
    public function DoWork(){
        if (!$this->file_name) {
            $this->showMessage('Bạn chưa nhập tên file');
            return;
        }
        Artisan::call('plugin:make-' . $this->file_type . ' ' . $this->file_name . ' ' . $this->plugin_name);
        $this->refreshData(['plugin' => 'plugin']);
        $this->hideModal();
        $this->showMessage('Tạo file thành công');
    }
    public function render()
    {
        return $this->viewModal('generator::plugin.create-file');
    }
}
