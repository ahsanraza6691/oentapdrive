






<div class="accordion mb-3" id="addVariantAccordion">
    @if (!empty($product))
    
        @foreach ($product->product_variants as $product_attribute)
        <input type="hidden" name="dpv_id[]" value="{{ $product_attribute->id }}">
        <input type="hidden" name="variant_id{{ $product_attribute->id }}" value="{{ $product_attribute->variant_id }}">
            <div class="accordion-item">
                <h2 class="accordion-header" >
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collaps{{ $product_attribute->id }}" aria-expanded="true"
                        aria-controls="panelsStayOpen-collaps{{ $product_attribute->id }}">
                        {{ $product_attribute->variant }}
                    </button>
                    <button class="removeBtn" type="button"
                        onclick="removeVariant('{{ $product_attribute->product_id }}', '{{ $product_attribute->variant_id }}','{{ $product_attribute->id }}')">Remove</button>
                </h2>
                <div id="panelsStayOpen-collaps{{ $product_attribute->id }}" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-heading{{ $product_attribute->id }}">
                    <div class="accordion-body">
                        @if ($product_attribute->variant_id != 1)
                            
                       
                        <div class="row">
                            <div class="col-md-4">
                                <div class="firstBox">
                                    <span>Name</span>
                                    <p>{{ $product_attribute->variant }}</p>
                                    <ul>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" name="visible_product{{ $product_attribute->id }}" id="visible_product{{ $product_attribute->id }}" 
                                                {{ $product_attribute->visible_product == 1 ? 'checked' : '' }}
                                                >
                                                <label class="form-check-label" for="visible_product{{ $product_attribute->id }}">
                                                    Visible on the product
                                                        page
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="2" name="used_for_variation{{ $product_attribute->id }}" id="used_for_variation{{ $product_attribute->id }}" {{ $product_attribute->used_for_variation == 2 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="used_for_variation{{ $product_attribute->id }}">
                                                    Used for variations
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="secondBox">
                                    
                                    <div class="form-group">
                                        <label>Values</label>
                                        <select name="attribute{{ $product_attribute->id }}[]" class="select_2 select_{{ $product_attribute->id }}" multiple
                                            placeholder="Select Terms" data-allow-clear="1">
                                            
                                            @foreach ($attributes_values as $items)
                                                @if ($product_attribute->variant_id == $items->variant_id)
                                                
                                                <option value="{{ $items->id }}"
                                                
                                                    @foreach ($product_attribute->product_attributes as $item)

                                                    {{ $items->id == $item->attribute_id ? 'selected' : ''}}
                                                    {{-- {{ $item->attribute_id == $items->variant_id ? 'selected' : '' }} --}}
                                                        
                                                    @endforeach
                                                
                                                >
                                                    {{ $items->attribute_value }}
                                                </option>
                                            @endif

                                            
                                                {{-- <option value="{{ $variants->id }}"  
                                                    
                                                    @if (!empty($product->product_variants))
                                                        @foreach ($product->product_variants as $product_variants)
                                                            
                                                        @if (!empty($product_variants->product_attributes))
                                                        
                                                        @foreach ($product_variants->product_attributes as $product_variants)
                                                            {{ $product_variants->attribute_id == $variants->id ? 'selected' : ''}}
                                                        @endforeach
                                                        
                                                        @endif
                                                        
                                                            
                                                        @endforeach
                                                    @endif
                                                    >
                                                    
                                                    {{ $variants->attribute_value }}
                                                </option> --}}
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="selectButtons mt-2">
                                        <div>
                                            <button type="button"
                                                class="btn btn-success plusButton selectAll_{{ $product_attribute->id }}"
                                                onclick="selectAll('{{ $product_attribute->id }}')">Select All</button>
                                            <button type="button"
                                                class="btn btn-success plusButton unSelectAll_{{ $product_attribute->id }}"
                                                onclick="unselectAll('{{ $product_attribute->id }}')">Select
                                                None</button>
                                        </div>
                                        {{-- <button type="button" class="btn btn-success plusButton">Add New</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @else
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input class="form-control" name="cstm_attribute_name{{ $product_attribute->id }}" type="text" placeholder="" 
                                    
                                    @if ($product_attribute->variant_id == 1)
                                            
                                    value="{{$product_attribute->variant}}"
                                    
                                    @endif>
                                    
                                                
                                </div>
                                <ul>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" name="visible_product{{ $product_attribute->id }}" id="visible_product{{ $product_attribute->id }}" {{ $product_attribute->visible_product == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="visible_product{{ $product_attribute->id }}">
                                                Visible on the product
                                                    page
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="2" name="used_for_variation{{ $product_attribute->id }}" id="used_for_variation{{ $product_attribute->id }}" {{ $product_attribute->used_for_variation == 2 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="used_for_variation{{ $product_attribute->id }}">
                                                Used for variations
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-8">
                                <div class="secondBox">
                                    <div class="mb-3">
                                        <label>Value(s)</label>
                                        @php
                                            $custom_values = array();
                                        @endphp
                                        
                                        @if (!empty($product_attribute->product_attributes))
                                            @foreach($product_attribute->product_attributes as $item)
                                            
                                            @if ($item->attribute_id == null)
                                                @php
                                                    array_push($custom_values, $item->attribute);
                                                @endphp    
                                            @endif
                                            
                                            @endforeach
                                        @endif

                                        <textarea  name="cstm_attribute_value{{ $product_attribute->id }}" class="textAreaValue" placeholder='Enter some text, or some attributes by "|" separating values.'>{{ implode("|",$custom_values); }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<div class="row">
    <div class="col-md-2">
        <button type="submit" class="btn btn-success saveRedBtn plusButton" id="saveAttribute">Save Attribute</button>
    </div>
</div>
