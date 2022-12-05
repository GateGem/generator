<?php

namespace GateGem\Generator\Http\Livewire\Theme;

use Illuminate\Support\Facades\Artisan;
use GateGem\Core\Livewire\Modal;

class Create extends Modal
{
    public $theme_name='';
    public function mount()
    {
        $this->setTitle(__("generator::theme.title"));
        $this->modal_size = Modal::Small;
    }
    public function DoWork(){
        $this->hideModal();
        Artisan::call('theme:make ' . $this->theme_name);
        $this->refreshData(['module'=>'theme']);
    }
    public function render()
    {
        return $this->viewModal('generator::theme.create');
    }
}
