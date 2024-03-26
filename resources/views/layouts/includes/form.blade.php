@if($project->exists)
    <form action="{{route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
@else
    <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
@endif
    @csrf
    <div class="row mb-5">
        <div class="col-6 mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @elseif (old('title', '')) is-valid @enderror" id="title" name="title" value="{{ old('title', $project->title)}}">
            <div>
                @error('title')
                <p class="text-danger">{{$message}}</p>
                @else
                <p class="text-secondary">Inserire un titolo valido</p>
                @enderror
            </div>
        </div>
        <div class=" col-6 mb-3">
            {{-- Da gestire --}}
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" value="{{ old('slug', $project->slug)}}" disabled>
        </div>
        <div class="col-3 mb-3">
            <label for="end_date" class="form-label @error('title') is-invalid @elseif (old('end_date', '')) is-valid @enderror">Data fine progetto</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $project->end_date)}}">
            <div>
                @error('end_date')
                <p class="text-danger">{{$message}}</p>
                @else
                <p class="text-secondary">Inserire una data valida</p>
                @enderror
            </div>
        </div>
        <div class="col-3 mb-3">
            <label class="mb-2" for="type_id">Selziona un Tipo valido</label>
            <select class="form-select" id="type_id" name="type_id">
                <option value="">Nessuno</option>
                @foreach($types as $type)
                <option value="{{$type->id}}" @if(old('type_id', $project->type?->id) == $type->id) selected @endif>{{$type->label}}</option>
                @endforeach
            </select>
            <div>
                @error('type_id')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="col-5 mb-3">
            <label for="preview_project" class="form-label @error('preview_project') is-invalid @elseif (old('preview_project', '')) @enderror">Anteprima Progetto</label>
            <input type="file" class="form-control" id="preview_project" name="preview_project" value="{{ old('preview_project', $project->preview_project)}}">
            <div>
                @error('preview_project')
                <p class="text-danger">{{$message}}</p>
                @else
                <p class="text-secondary">Inserire un file .png .jpg .jpeg</p>
                @enderror
            </div>
        </div>
        <div class="col-1 align-self-center">
            <img class="img-fluid" id="preview" src="{{old('preview_project', $project->preview_project)
             ? asset('storage/' . old('preview_project', $project->preview_project))
             : 'https://marcolanci.it/boolean/assets/placeholder.png' }}" alt="preview">
        </div>
        <div class="mb-3 col-12">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @elseif (old('description', '')) @enderror" id="description" rows="10" name="description">{{ old('description', $project->description)}}</textarea>
            <div>
                @error('description')
                <p class="text-danger">{{$message}}</p>
                @else
                <p class="text-secondary">Inserire una descrizione valida</p>
                @enderror
            </div>
        </div>
        <div class="col d-flex justify-content-between">
            <a class="btn btn-primary" href="{{route('admin.projects.index')}}">Torna Indietro</a>
            <div class="d-flex align-items-center gap-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_published" name="is_published" @if(old('is_published', $project->is_published)) checked @endif>
                    <label class="form-check-label" for="is_published">Pubblico</label>
                </div>
                <button class="btn btn-secondary" type="reset">Svuota</button>
                <button class="btn btn-success" type="submit">Salva</button>
            </div>
        </div>
    </div>
</form>