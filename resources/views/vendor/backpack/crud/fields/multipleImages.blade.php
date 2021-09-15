<!-- field_type_name -->
@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    {{-- <input
        type="text"
        name="{{ $field['name'] }}"
        value="{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}"
        @include('crud::fields.inc.attributes')
    > --}}
    <input
        type="file"
        name="{{ $field['name'] }}[]"
        class="filepond"
        multiple
        data-max-file-size="10MB"
        @include('crud::fields.inc.attributes')
    >


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
        <link rel="stylesheet" href="{{ asset('packages/filepond/dist/filepond.min.css') }}">
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet" />
    @endpush

    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}
    @push('crud_fields_scripts')
        <script src="{{ asset('packages/filepond/dist/filepond.min.js') }}"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                FilePond.registerPlugin(
                    FilePondPluginFileValidateSize,
                    FilePondPluginImageExifOrientation,
                    FilePondPluginImagePreview
                );
                // FilePond.setOptions({
                //     server: {
                //         url: '/filepond/api',
                //         process: '/process',
                //         revert: '/process',
                //         headers: {
                //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
                //         }
                //     }
                // });
                // FilePond.parse(document.body);
                FilePond.create(document.querySelector('input.filepond[name="{{ $field['name'] }}[]"]'), {
                    allowMultiple: true,
                    storeAsFile: true,
                    // name: "{{ $field['name'] }}"
                });
            });
        </script>
    @endpush
@endif
