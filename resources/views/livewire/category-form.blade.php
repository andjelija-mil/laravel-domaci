<div>
    <form wire:submit.prevent="edit">
        <div class="card-header bg-gray">
            <div class="d-flex flex-column flex-sm-row d-flex justify-content-end">
                @if($edit)
                    <a href="{{route('categoriesList')}}" class="btn btn-info">Dodaj novu kategoriju</a>
                @endif
            </div>
            <div class="">
                @if(session()->has('message'))
                    @if(session('alert-type')=='success')
                        <i class="fas fa-check-square text-success  p-2 rounded-lg">  {{session('message')}}</i>
                    @elseif(session('alert-type')=='error')
                        <i class="fas fa-exclamation-triangle text-danger  rounded-lg">  {{session('message')}}</i>
                    @endif
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Naziv*</label>
                <input type="text" class="form-control" id="name" wire:model="name" placeholder="Naziv">
                @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">@if($edit) Sacuvaj izmene @else Dodaj novu kategoriju @endif</button>
        </div>
    </form>
</div>
