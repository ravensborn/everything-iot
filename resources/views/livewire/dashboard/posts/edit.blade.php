<div>


    <div id="fake-form">

        <div class="row">
            <div class="col-12">
                <div>
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" class="form-control" wire:model="title">
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-md-6">
                <label for="category_id" class="form-label">Category</label>
                <select id="category_id" class="form-control" wire:model="category_id">
                    <option value="0"> -- Select a category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12 col-md-6 mt-3 mt-md-0">
                <label for="locale" class="form-label">Language</label>
                <select id="locale" class="form-control" wire:model="locale">
                    <option value="0"> -- Select a language --</option>
                    @foreach(config('app.available_locales') as $code => $item)
                        <option value="{{ $code }}">
                            {{ $item['name'] }}
                        </option>
                    @endforeach
                </select>
                @error('locale')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row mt-3" wire:ignore>
            <div class="col">
                <div>
                    <label for="default-editor">Content</label>
                    <textarea id="default-editor" class="form-control" wire:model="content">
                    </textarea>
                    @error('content')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <script>

                    const imagesUploadHandler = (blobInfo, progress) => new Promise((resolve, reject) => {
                        const xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.open('POST', '/dashboard/posts/{{ $post->slug }}/upload');
                        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content); // manually set header

                        xhr.upload.onprogress = (e) => {
                            progress(e.loaded / e.total * 100);
                        };

                        xhr.onload = () => {
                            if (xhr.status === 403) {
                                reject({message: 'HTTP Error: ' + xhr.status, remove: true});
                                return;
                            }

                            if (xhr.status < 200 || xhr.status >= 300) {
                                reject('HTTP Error: ' + xhr.status);
                                return;
                            }

                            const json = JSON.parse(xhr.responseText);

                            if (!json || typeof json.location != 'string') {
                                reject('Invalid JSON: ' + xhr.responseText);
                                return;
                            }

                            resolve(json.location);
                        };

                        xhr.onerror = () => {
                            reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                        };

                        const formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());

                        xhr.send(formData);
                    });

                    tinymce.init({
                        selector: 'textarea#default-editor',
                        image_class_list: [
                            {title: 'Image Responsive', value: 'img-fluid object-fit-contain'},
                        ],
                        height: 500,
                        plugins: [
                            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                            'insertdatetime', 'media', 'table', 'editimage', 'wordcount'
                        ],
                        // images_upload_url: '',
                        images_upload_handler: imagesUploadHandler,
                        automatic_uploads: true,
                        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                        setup: function (editor) {
                            editor.on('init change', function () {
                                editor.save();
                            });
                            editor.on('change', function (e) {
                                @this.
                                set('content', editor.getContent());
                            });
                        },
                    });
                </script>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-6">
                <div>
                    <div class="form-check">
                        <input class="form-check-input" name="hiddenPost" type="checkbox" value=""
                               id="hiddenProductCheckbox" wire:model="is_hidden">
                        <label class="form-check-label" for="hiddenProductCheckbox">
                            Hidden post
                        </label>
                    </div>
                </div>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" name="isCommentable" type="checkbox" value=""
                               id="isCommentableCheckbox" wire:model="is_commentable">
                        <label class="form-check-label" for="isCommentableCheckbox">
                            Is commentable
                        </label>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-3">
            <hr>
            <button class="btn btn-primary" wire:click.prevent="updatePost">
                <i class="bi bi-check2 me-1"></i>
                Update
                <span wire:loading wire:target="updatePost">
                    - Updating...
                </span>
            </button>
        </div>
        <div class="mt-3">
            <a href="{{ route('dashboard.posts.index') }}">Return to list of posts.</a>
        </div>
    </div>


</div>
