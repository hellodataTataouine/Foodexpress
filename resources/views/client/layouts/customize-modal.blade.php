<!-- Customize Modal -->
<div class="modal fade" id="customizeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Modal content goes here -->
        <div class="modal-body">
          <h4 class="customize-title">{{ $product->nom_produit }} <span class="custom-primary">{{ $product->prix }} DT</span></h4>
          <!-- Customize modal content goes here -->
          <!-- Family options loop -->
          @foreach($familleOptions as $familleOption)
            <h5>{{ $familleOption->nom_famille_option }}:</h5>
            @if($familleOption->type == 'simple')
              <!-- Radio buttons for simple type -->
              @foreach($familleOption->options as $option)
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="{{ $familleOption->id }}" id="{{ $option->id }}" value="{{ $option->id }}">
                  <label class="form-check-label" for="{{ $option->id }}">
                    {{ $option->nom_option }}
                  </label>
                </div>
              @endforeach
            @elseif($familleOption->type == 'multiple')
              <!-- Select list for multiple type -->
              <select class="form-select" multiple name="{{ $familleOption->id }}">
                @foreach($familleOption->options as $option)
                  <option value="{{ $option->id }}">{{ $option->nom_option }}</option>
                @endforeach
              </select>
            @elseif($familleOption->type == 'qte')
              <!-- Number input for qte type -->
              <input type="number" name="{{ $familleOption->id }}" value="1" min="1">
            @endif
          @endforeach
  
          <!-- Customize modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Order Now</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  