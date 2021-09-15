<!-- field_type_name -->
@if (count($field['images']) > 0)
    @include('crud::fields.inc.wrapper_start')
        <label>{!! $field['label'] !!}</label>
        <div class="preview-images">
            @foreach ($field['images'] as $image)
                <div class="item">
                    <img src="{{ product_images($image->path) }}">
                    <input name="keepImages[]" value="{{ $image->id }}">
                    <button class="btn btn-danger btn-sm">
                        <i class="nav-icon la la-times" style="font-size: 10px;"></i> Delete
                    </button>
                </div>
            @endforeach
        </div>

        {{-- HINT --}}
        @if (isset($field['hint']))
            <p class="help-block">{!! $field['hint'] !!}</p>
        @endif
    @include('crud::fields.inc.wrapper_end')

    @if ($crud->fieldTypeNotLoaded($field))
        @php
            $crud->markFieldTypeAsLoaded($field);
        @endphp

        {{-- FIELD EXTRA CSS  --}}
        {{-- push things in the after_styles section --}}
        @push('crud_fields_styles')
            <style>
                .preview-images {
                    display: flex;
                    position: relative;
                    overflow: hidden;
                    overflow-x: auto;
                }
                .preview-images .item {
                    position: relative;
                }
                .preview-images .item input {
                    display: none;
                }
                .preview-images .item img {
                    height: 200px;
                    border: 1px solid black;
                    margin-left: .5rem;
                }
                .preview-images .item button {
                    position: absolute;
                    top: 0;
                    right: 0;
                    margin-right: .5rem;
                    margin-top: .5rem;
                }
            </style>
        @endpush

        {{-- FIELD EXTRA JS --}}
        {{-- push things in the after_scripts section --}}
        @push('crud_fields_scripts')
            <script>
                const items = document.querySelectorAll('.preview-images .item');
                items.forEach(item => {
                    const btnDelete = item.querySelector('button');
                    btnDelete.addEventListener('click', e => {
                        e.preventDefault();
                        item.animate([
                            { opacity: 1 },
                            { opacity: 0 }
                        ], {
                            duration: 200,
                            fill: 'forwards'
                        });
                        setTimeout(() => {
                            item.remove();
                        }, 500);
                    });
                });
            </script>
        @endpush
    @endif
@endif
