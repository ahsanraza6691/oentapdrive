<div class="accordion mb-3" id="addVariantAccordion">
    @if (!empty($product_attributes))
    
        @foreach ($product_attributes as $product_attribute)
            <input type="hidden" name="dpv_id[]" value="{{ $product_attribute->id }}">
            <input type="hidden" name="variant_id{{ $product_attribute->id }}"
                value="{{ $product_attribute->variant_id }}">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-heading{{ $product_attribute->id }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collaps{{ $product_attribute->id }}" aria-expanded="true"
                        aria-controls="panelsStayOpen-collaps{{ $product_attribute->id }}">
                        {{ $product_attribute->variant }}
                    </button>
                    <button class="removeBtn" type="button"
                        onclick="removeVariant('{{ $product_attribute->product_id }}','{{ $product_attribute->variant_id }}','{{ $product_attribute->id }}')">Remove</button>
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
                                                    <input class="form-check-input input_type_checkbox" type="checkbox" value="1"
                                                        name="visible_product{{ $product_attribute->id }}"
                                                        id="visible_product{{ $product_attribute->id }}" checked>
                                                    <label class="form-check-label"
                                                        for="visible_product{{ $product_attribute->id }}">
                                                        Visible on the product
                                                        page
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input input_type_checkbox" type="checkbox" value="2"
                                                        name="used_for_variation{{ $product_attribute->id }}"
                                                        id="used_for_variation{{ $product_attribute->id }}">
                                                    <label class="form-check-label"
                                                        for="used_for_variation{{ $product_attribute->id }}">
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
                                            <select name="attribute{{ $product_attribute->id }}[]"
                                                class="select_2 selected_{{ $product_attribute->id }} customAttribute" multiple
                                                placeholder="Select Terms" data-allow-clear="1" data-attr-id="{{ $product_attribute->id }}">
                                                @foreach ($product_attribute->child_attributes as $variants)
                                                    <option value="{{ $variants->id }}">
                                                        {{ $variants->attribute_value }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="selectButtons mt-2">
                                            <div>
                                                <button type="button"
                                                    class="btn btn-success plusButton selectAll_{{ $product_attribute->id }}"
                                                    onclick="selectAll('{{ $product_attribute->id }}')">Select
                                                    All</button>
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
                                        <input class="form-control cstm_attribute_name cstm_attribute_name{{ $product_attribute->id }}"
                                            name="cstm_attribute_name{{ $product_attribute->id }}" type="text"
                                            placeholder="">
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input input_type_checkbox" type="checkbox" value="1"
                                                    name="visible_product{{ $product_attribute->id }}"
                                                    id="visible_product{{ $product_attribute->id }}">
                                                <label class="form-check-label"
                                                    for="visible_product{{ $product_attribute->id }}">
                                                    Visible on the product
                                                    page
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input input_type_checkbox" type="checkbox" value="2"
                                                    name="used_for_variation{{ $product_attribute->id }}"
                                                    id="used_for_variation{{ $product_attribute->id }}">
                                                <label class="form-check-label"
                                                    for="used_for_variation{{ $product_attribute->id }}">
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
                                            <textarea name="cstm_attribute_value{{ $product_attribute->id }}" class="textAreaValue cstm_attribute_textarea" data-attr-id="{{ $product_attribute->id }}"
                                                placeholder='Enter some text, or some attributes by "|" separating values.'></textarea>
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


@if (!empty($product_attributes))
    

@if (count($product_attributes) > 0)
<div class="row">
    <div class="col-md-2">
        <button type="submit" class="btn btn-success saveRedBtn plusButton attribute_save_active" id="saveAttribute">Save Attribute</button>
        <button type="button" class="btn btn-success saveRedBtn plusButton attribute_save_disable">Save Attribute</button>
    </div>
</div>
@endif
@endif