<div x-data="{ theme_name:  @entangle('theme_name').defer }">
    <div class="mb-3 p-1">
        <label for="theme_name" class="form-label">{{__("generator::theme.label")}}</label>
        <input  x-model="theme_name"  wire:model.defer="theme_name" type="text" class="form-control" id="theme_name" placeholder="{{__("generator::theme.label")}}">
    </div>
    <div class="form-control text-warning fw-bold fs-6" style="background-color: rgb(56, 43, 95);">
        php artisan theme:make <span x-text="theme_name"></span>
    </div>
    <div class="text-center p-1"><button class="btn btn-primary btn-sm" wire:click="DoWork()">{{__("generator::theme.button.save")}}</button></div>
</div>