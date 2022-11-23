<div x-data="{ plugin_name:  @entangle('plugin_name').defer }">
    <div class="mb-3 p-1">
        <label for="plugin_name" class="form-label">{{__("generator::plugin.label")}}</label>
        <input  x-model="plugin_name"  wire:model.defer="plugin_name" type="text" class="form-control" id="plugin_name" placeholder="{{__("generator::plugin.label")}}">
    </div>
    <div class="form-control text-warning fw-bold fs-6" style="background-color: rgb(56, 43, 95);">
        php artisan plugin:make <span x-text="plugin_name"></span>
    </div>
    <div class="text-center p-1"><button class="btn btn-primary btn-sm" wire:click="DoWork()">{{__("generator::plugin.button.save")}}</button></div>
</div>