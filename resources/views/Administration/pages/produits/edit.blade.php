@extends('Administration.layouts.master')

@section('content')
<div class="container-xxl">

    <div class="row">
         

     

         <div class="col-xl-12 col-lg-12">
               <div class="row">
                    <!-- Vignette du produit -->
                    <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Vignette du produit <span class="text-danger">*</span></h4>
                                </div>
                                <div class="card-body">
                                    @php
                                        $thumbnail = $product->images()->where('is_thumbnail', true)->first();
                                        $imageUrl = $thumbnail ? asset('storage/' . $thumbnail->path) : asset('images/default.png');
                                    @endphp
                                    <div class="mb-3">
                                        <label for="product-thumbnail" class="form-label">Vignette du produit</label>
                                        <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="img-fluid rounded" id="thumbnail-preview">
                                        </div>
                                        

                                       <!-- Formulaire pour mettre à jour la vignette -->
                                        <form action="{{ route('product.updateThumbnail', $product->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="file" class="form-control mt-2" name="thumbnail" id="product-thumbnail" required>
                                            <button type="submit" class="btn btn-primary mt-2">Mettre à jour la vignette</button>
                                        </form>

                                        @error('thumbnail')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                    </div>

                    <!-- Images additionnelles -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Images additionnelles du produit</h4>
                            </div>
                            <div class="card-body">
                                
                                    
            
                                   <!-- Images supplémentaires -->
                                    <div class="mb-3">
                                        <label for="product-images" class="form-label">Ajouter des images supplémentaires</label>
                                        
                                        <form action="{{ route('product.addImages', $product->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            
                                            <input type="file" class="form-control mt-2" name="images[]" id="product-images" multiple required>
                                            
                                            <button type="submit" class="btn btn-primary mt-2">Ajouter les images</button>
                                        </form>

                                        @error('images')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

            
                                    <div class="mb-3">
                                    <h5>Images existantes :</h5>
                                    <div class="row">
                                        @foreach ($product->images as $image)
                                        @if (!$image->is_thumbnail)
                                            <div class="col-lg-4">
                                                <div class="card">
                                                    <img src="{{ asset('storage/' . $image->path) }}" alt="Image produit" class="img-fluid" style="height:100px">
                                                    <form action="{{ route('images.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette image ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm mt-2">Supprimer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                       
                                    </div>
                                    </div>
            
                                    
                                
                            </div>
                        </div>
                    </div>
            
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                
        
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Informations sur le produit</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="product-name" class="form-label">Nom du produit <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nom du produit" value="{{ old('name', $product->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="product-categories" class="form-label">Catégorie du produit <span class="text-danger">*</span></label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" data-choices data-choices-groups data-placeholder="Sélectionnez une catégorie">
                                        <option value="">Choisissez une catégorie</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="product-brand" class="form-label">Marque <span class="text-danger">*</span></label>
                                        <input type="text" id="product-brand" name="brand" class="form-control @error('brand') is-invalid @enderror" placeholder="Nom de la marque" value="{{ old('brand', $product->marque) }}">
                                        @error('brand')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="product-weight" class="form-label">Poids</label>
                                        <input type="text" id="product-weight" name="weight" class="form-control @error('weight') is-invalid @enderror" placeholder="Poids en gm & kg" value="{{ old('weight', $product->weight) }}">
                                        @error('weight')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>
                
                            <div class="row mb-4">
                                <div class="col-lg-5">
                                    <div class="mt-3">
                                        <h5 class="text-dark fw-medium">Couleurs :</h5>
                                        <div class="d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                                                @foreach (['dark', 'yellow', 'white', 'red', 'green', 'blue', 'sky', 'gray'] as $color)
                                                        <input type="checkbox" class="btn-check" id="color-{{ $color }}" name="colors[]" value="{{ $color }}"
                                                            {{ in_array($color, old('colors', is_string($product->colors) ? explode(',', $product->colors) : $product->colors ?? [])) ? 'checked' : '' }}>
                                                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="color-{{ $color }}">
                                                            <i class="bx bxs-circle fs-18 text-{{ $color }}"></i>
                                                        </label>
                                                @endforeach
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control bg-light-subtle @error('description') is-invalid @enderror" id="description" name="description" rows="7" placeholder="Description courte du produit">{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="product-stock" class="form-label">Stock <span class="text-danger">*</span></label>
                                        <input type="number" id="product-stock" name="stock" class="form-control @error('stock') is-invalid @enderror" placeholder="Quantité" value="{{ old('stock', $product->stock) }}">
                                        @error('stock')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="product-tags" class="form-label">Tags</label>
                                    <select class="form-control @error('tags') is-invalid @enderror" name="tags[]" id="choices-multiple-remove-button" multiple data-choices data-choices-removeItem>
                                        <option value="Fashion" {{ in_array('Fashion', explode(',', old('tags', $product->tags ?? ''))) ? 'selected' : '' }}>Fashion</option>
                                        <option value="Electronics" {{ in_array('Electronics', explode(',', old('tags', $product->tags ?? ''))) ? 'selected' : '' }}>Electronics</option>
                                        <option value="Watches" {{ in_array('Watches', explode(',', old('tags', $product->tags ?? ''))) ? 'selected' : '' }}>Watches</option>
                                        <option value="Headphones" {{ in_array('Headphones', explode(',', old('tags', $product->tags ?? ''))) ? 'selected' : '' }}>Headphones</option>
                                    </select>
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Détails des prix</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="product-price" class="form-label">Prix <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><i class='bx bx-dollar'></i></span>
                                        <input type="number" id="product-price" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="000" value="{{ old('price', $product->price) }}">
                                    </div>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="product-discount" class="form-label">Remise</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><i class='bx bxs-discount'></i></span>
                                        <input type="number" id="product-discount" name="discount" class="form-control @error('discount') is-invalid @enderror" placeholder="000" value="{{ old('discount', $product->discount) }}">
                                    </div>
                                    @error('discount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
           
                    <div class="p-3 bg-light mb-3 rounded">
                        <div class="row justify-content-end g-2">
                            <div class="col-lg-2">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100">Annuler</a>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary w-100">Sauvegarder</button>
                            </div>
                        </div>
                    </div>
          
                </form>

                </div>
    </div>

</div>
@endsection