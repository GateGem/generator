<?php

namespace LaraIO\Generator\Http\Livewire\Theme;

use Illuminate\Support\Facades\Artisan;
use LaraIO\Core\Livewire\Modal;

class CreateFile extends Modal
{
    public $theme_name = '';
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
    public function mount($theme)
    {
        $this->theme_name = $theme;
        $this->setTitle('Create New Theme:' . $theme);
        $this->modal_size = Modal::Large;
    }
    public function DoWork()
    {
        if (!$this->file_name) {
            $this->showMessage('Bạn chưa nhập tên file');
            return;
        }
        Artisan::call('theme:make-' . $this->file_type . ' ' . $this->file_name . ' ' . $this->theme_name);
        $this->refreshData(['theme' => 'theme']);
        $this->hideModal();
        $this->showMessage('Tạo file thành công');
    }
    public function render()
    {
        return $this->viewModal('generator::theme.create-file');
    }
}
