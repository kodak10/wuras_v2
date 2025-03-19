@extends('Administration.layouts.master')

@section('content')
<div class="container-xxl">
    <div class="row">
         <div class="col-xl-12 col-lg-12">
          <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
               <div class="row">
               <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Vignette du produit</h4>
                        </div>
                        <div class="card-body">
                            <input type="file" name="thumbnail" class="form-control">
                            @error('thumbnail')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Images additionnelles du produit</h4>
                        </div>
                        <div class="card-body">
                            <input type="file" name="images[]" class="form-control" multiple>
                            @error('images.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
            </div>
              <!-- Main form -->
              
                  @csrf
                  <div class="card">
                       <div class="card-header">
                            <h4 class="card-title">Informations sur le produit</h4>
                       </div>
                       <div class="card-body">
                            <div class="row">
                                 <div class="col-lg-6">
                                      <div class="mb-3">
                                           <label for="product-name" class="form-label">Nom du produit</label>
                                           <input type="text" name="name" class="form-control" placeholder="Nom du produit" value="{{ old('name') }}">
                                           @error('name')
                                               <div class="text-danger">{{ $message }}</div>
                                           @enderror
                                      </div>
                                 </div>
                                 <div class="col-lg-6">
                                   <label for="product-category" class="form-label">Catégorie</label>
                                   <select name="category_id" class="form-control" required>
                                       <option value="">Sélectionnez une catégorie</option>
                                       @foreach($categories as $category)
                                           <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                       @endforeach
                                   </select>
                                   @error('category_id')
                                       <div class="text-danger">{{ $message }}</div>
                                   @enderror
                               </div>
                               
                            </div>
                            <div class="row">
                                 <div class="col-lg-4">
                                      <div class="mb-3">
                                           <label for="product-brand" class="form-label">Marque</label>
                                           <input type="text" name="marque" class="form-control" placeholder="Nom de la marque" value="{{ old('marque') }}">
                                           @error('marque')
                                               <div class="text-danger">{{ $message }}</div>
                                           @enderror
                                      </div>
                                 </div>
                                 <div class="col-lg-4">
                                      <div class="mb-3">
                                           <label for="product-weight" class="form-label">Poids</label>
                                           <input type="text" name="weight" id="product-weight" class="form-control" placeholder="En Kg" value="{{ old('weight') }}">
                                           @error('weight')
                                               <div class="text-danger">{{ $message }}</div>
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
                                                    {{ in_array($color, old('colors', explode(',', $product->colors ?? ''))) ? 'checked' : '' }}>
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
                                           <textarea class="form-control bg-light-subtle" name="description" rows="7" placeholder="Short description about the product">{{ old('description') }}</textarea>
                                           @error('description')
                                               <div class="text-danger">{{ $message }}</div>
                                           @enderror
                                      </div>
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-lg-6">
                                      <div class="mb-3">
                                           <label for="product-stock" class="form-label">Stock</label>
                                           <input type="number" name="stock" class="form-control" placeholder="Quantité" value="{{ old('stock') }}">
                                           @error('stock')
                                               <div class="text-danger">{{ $message }}</div>
                                           @enderror
                                      </div>
                                 </div>
                                 <div class="col-lg-6">
                                      <label for="product-stock" class="form-label">Tag</label>
                                      <select class="form-control" name="tags[]" data-choices data-choices-removeItem multiple>
                                           <option value="Fashion" {{ in_array('Fashion', old('tags', [])) ? 'selected' : '' }}>Fashion</option>
                                      </select>
                                      @error('tags')
                                          <div class="text-danger">{{ $message }}</div>
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
                                      <div class="mb-3">
                                           <label for="product-price" class="form-label">Prix</label>
                                           <div class="input-group mb-3">
                                                <span class="input-group-text fs-20"><i class='bx bx-dollar'></i></span>
                                                <input type="number" name="price" class="form-control" placeholder="000" value="{{ old('price') }}">
                                           </div>
                                           @error('price')
                                               <div class="text-danger">{{ $message }}</div>
                                           @enderror
                                      </div>
                                 </div>
                                 <div class="col-lg-6">
                                      <div class="mb-3">
                                           <label for="product-discount" class="form-label">Remise</label>
                                           <div class="input-group mb-3">
                                                <span class="input-group-text fs-20"><i class='bx bxs-discount'></i></span>
                                                <input type="number" name="discount" class="form-control" placeholder="000" value="{{ old('discount') }}">
                                           </div>
                                           @error('discount')
                                               <div class="text-danger">{{ $message }}</div>
                                           @enderror
                                      </div>
                                 </div>
                            </div>
                       </div>
                  </div>
                  <div class="p-3 bg-light mb-3 rounded">
                       <div class="row justify-content-end g-2">
                            <div class="col-lg-2">
                                 <button type="submit" class="btn btn-outline-secondary w-100">Créer un produit</button>
                            </div>
                            <div class="col-lg-2">
                                 <a href="#!" class="btn btn-primary w-100">Annuler</a>
                            </div>
                       </div>
                  </div>
               </form>
         </div>
    </div>
</div>
@endsection
