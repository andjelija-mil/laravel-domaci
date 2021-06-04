<div>
    <button type="button" data-toggle="modal" data-target="#createModal" class="btn btn-success">Dodaj korisnika</button>

    <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog">
        <div class="modal-dialog text-dark" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registracija</h5>
                    <button type="button" wire:click="close" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Ime</label>
                            <input type="text" class="form-control @error('name') border-danger @enderror" id="name" wire:model="name"
                                   placeholder="Ime">
                            @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" class="form-control @error('email') border-danger @enderror" id="email" wire:model="email" placeholder="E-mail">
                            @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Lozinka</label>
                            <input type="password" class="form-control @error('password') border-danger @enderror" id="password" wire:model="password"
                                   placeholder="Lozinka">
                            @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Zatvori</button>
                    <button type="button" wire:click.prevent="create"
                            class="btn btn-primary close-btn" data-dismiss="modal">Registracija</button>
                </div>
            </div>
        </div>
    </div>
</div>
