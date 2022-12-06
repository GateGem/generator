<div class="p-1" x-data="{ file_type: @entangle('file_type').defer, file_option: @entangle('file_option').defer, file_name: @entangle('file_name').defer }">
    <div class="p-1">
        <div class="row g-1">
            <div class="col-12 col-md-4">
                <label for="file_type" class="form-label">File Type</label>
                <select x-model="file_type" wire:model.defer="file_type" class="form-select" id="file_type">
                    @foreach ($array_type as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class=" col-12 col-md-4">
                <label for="file_name" class="form-label">File Name</label>
                <input x-model="file_name" wire:model.defer="file_name" type="text" class="form-control"
                    id="file_name" placeholder="File Name">
            </div>
            <div class=" col-12 col-md-4">
                <label for="file_name" class="form-label">Option</label>
                <input x-model="file_option" wire:model.defer="file_option" type="text" class="form-control"
                    id="file_option" placeholder="option">
            </div>
        </div>
    </div>
    <div class="form-control text-warning fw-bold fs-6" style="background-color: rgb(56, 43, 95);">
        php artisan module:make-<span x-text="file_type"></span> <span x-text="file_name"></span> {{ $module_name }}
        <span x-text="file_option"></span>
    </div>

    <div class="text-center p-1 mt-1"><button class="btn btn-primary btn-sm"
            wire:click="DoWork()">{{ __('generator::module.button.saveFile') }}</button></div>
</div>
