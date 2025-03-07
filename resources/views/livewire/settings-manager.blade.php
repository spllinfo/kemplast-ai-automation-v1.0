<div>
    <!-- Loading overlay -->
    <div x-data="{ show: false }" 
         x-show="show" 
         x-init="$watch('$wire.isLoading', value => { show = value })" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-xl flex items-center space-x-4">
            <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-primary"></div>
            <span class="text-gray-700 text-lg">Processing...</span>
        </div>
    </div>

    <!-- Notification component -->
    <div x-data="{ 
            show: false, 
            type: 'success', 
            message: '',
            init() {
                window.addEventListener('notify', (event) => {
                    this.show = true;
                    this.type = event.detail.type;
                    this.message = event.detail.message;
                    
                    // Auto-dismiss after 5 seconds
                    setTimeout(() => { this.show = false }, 5000);
                });
            }
        }" 
        x-show="show"
        x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed top-4 right-4 z-50 max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
        <div class="p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <template x-if="type === 'success'">
                        <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </template>
                    <template x-if="type === 'error'">
                        <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </template>
                    <template x-if="type === 'warning'">
                        <svg class="h-6 w-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </template>
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p x-text="message" class="text-sm font-medium text-gray-900"></p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button @click="show = false" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
        <div>
            <nav>
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                    <li class="breadcrumb-item active">Website</li>
                </ol>
            </nav>
            <h1 class="page-title fw-medium fs-18 mb-0">Web Settings</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3">
            <div class="card custom-card">
                <div class="card-body">
                    <ul class="nav nav-tabs flex-column nav-tabs-header mail-settings-tab mb-0" role="tablist">
                        @foreach($settings as $group => $groupSettings)
                            <li class="nav-item me-0">
                                <a class="nav-link {{ $activeTab === $group ? 'active' : '' }}"
                                   wire:click.prevent="setActiveTab('{{ $group }}')"
                                   href="#{{ $group }}-settings"
                                   role="tab"
                                   aria-selected="{{ $activeTab === $group ? 'true' : 'false' }}">
                                    <i class="ri-{{ $group }}-line fs-14 lh-1 text-primary me-2 align-middle"></i>
                                    {{ ucfirst($group) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Social Links</div>
                </div>
                <div class="card-body">
                    <div class="row gy-3" x-data="{ saving: false }">
                        <div class="col-xl-12">
                            <label for="facebook" class="form-label">Facebook:</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="ri-facebook-fill"></i>
                                </span>
                                <input type="url"
                                       class="form-control"
                                       id="facebook"
                                       wire:model.debounce.500ms="socialLinks.facebook"
                                       placeholder="https://facebook.com/yourpage"
                                       x-on:focus="saving = false"
                                       x-on:blur="saving = true; $wire.saveSocialLinks()">
                            </div>
                            @if($errors->has('socialLinks.facebook')) <div class="text-danger mt-1">{{ $errors->first('socialLinks.facebook') }}</div> @endif
                        </div>
                        
                        <div class="col-xl-12">
                            <label for="twitter" class="form-label">Twitter:</label>
                            <div class="input-group">
                                <span class="input-group-text bg-info text-white">
                                    <i class="ri-twitter-fill"></i>
                                </span>
                                <input type="url"
                                       class="form-control"
                                       id="twitter"
                                       wire:model.debounce.500ms="socialLinks.twitter"
                                       placeholder="https://twitter.com/yourhandle"
                                       x-on:focus="saving = false"
                                       x-on:blur="saving = true; $wire.saveSocialLinks()">
                            </div>
                            @if($errors->has('socialLinks.twitter')) <div class="text-danger mt-1">{{ $errors->first('socialLinks.twitter') }}</div> @endif
                        </div>
                        
                        <div class="col-xl-12">
                            <label for="pinterest" class="form-label">Pinterest:</label>
                            <div class="input-group">
                                <span class="input-group-text bg-danger text-white">
                                    <i class="ri-pinterest-fill"></i>
                                </span>
                                <input type="url"
                                       class="form-control"
                                       id="pinterest"
                                       wire:model.debounce.500ms="socialLinks.pinterest"
                                       placeholder="https://pinterest.com/yourprofile"
                                       x-on:focus="saving = false"
                                       x-on:blur="saving = true; $wire.saveSocialLinks()">
                            </div>
                            @if($errors->has('socialLinks.pinterest')) <div class="text-danger mt-1">{{ $errors->first('socialLinks.pinterest') }}</div> @endif
                        </div>
                        
                        <div class="col-xl-12">
                            <label for="linkedin" class="form-label">LinkedIn:</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="ri-linkedin-fill"></i>
                                </span>
                                <input type="url"
                                       class="form-control"
                                       id="linkedin"
                                       wire:model.debounce.500ms="socialLinks.linkedin"
                                       placeholder="https://linkedin.com/in/yourprofile"
                                       x-on:focus="saving = false"
                                       x-on:blur="saving = true; $wire.saveSocialLinks()">
                            </div>
                            @if($errors->has('socialLinks.linkedin')) <div class="text-danger mt-1">{{ $errors->first('socialLinks.linkedin') }}</div> @endif
                        </div>
                        
                        <div class="col-xl-12">
                            <label for="instagram" class="form-label">Instagram:</label>
                            <div class="input-group">
                                <span class="input-group-text bg-pink text-white">
                                    <i class="ri-instagram-fill"></i>
                                </span>
                                <input type="url"
                                       class="form-control"
                                       id="instagram"
                                       wire:model.debounce.500ms="socialLinks.instagram"
                                       placeholder="https://instagram.com/yourhandle"
                                       x-on:focus="saving = false"
                                       x-on:blur="saving = true; $wire.saveSocialLinks()">
                            </div>
                            @if($errors->has('socialLinks.instagram')) <div class="text-danger mt-1">{{ $errors->first('socialLinks.instagram') }}</div> @endif
                        </div>
                        
                        <div class="col-xl-12">
                            <label for="youtube" class="form-label">YouTube:</label>
                            <div class="input-group">
                                <span class="input-group-text bg-danger text-white">
                                    <i class="ri-youtube-fill"></i>
                                </span>
                                <input type="url"
                                       class="form-control"
                                       id="youtube"
                                       wire:model.debounce.500ms="socialLinks.youtube"
                                       placeholder="https://youtube.com/c/yourchannel"
                                       x-on:focus="saving = false"
                                       x-on:blur="saving = true; $wire.saveSocialLinks()">
                            </div>
                            @if($errors->has('socialLinks.youtube')) <div class="text-danger mt-1">{{ $errors->first('socialLinks.youtube') }}</div> @endif
                        </div>
                        
                        <div class="col-12 mt-3" x-show="saving">
                            <div x-show="saving" 
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform scale-90"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 class="text-success text-center">
                                <i class="ri-checkbox-circle-line me-1"></i> Auto-saving...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-9">
            <div class="tab-content">
                @foreach($settings as $group => $groupSettings)
                    <div class="tab-pane fade {{ $activeTab === $group ? 'show active' : '' }}"
                         id="{{ $group }}-settings"
                         role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">{{ ucfirst($group) }} Settings</div>
                            </div>
                            <div class="card-body">
                                <div class="row gy-4">
                                    @foreach($groupSettings as $key => $setting)
                                        <div class="col-xl-12" x-data="{ saving: false }">
                                            <div class="mb-4">
                                                <label for="{{ $key }}" class="form-label d-flex align-items-center">
                                                    {{ ucwords(str_replace('_', ' ', $key)) }}
                                                    @if(isset($setting['description']))
                                                        <span class="ms-2" x-data="{ showTooltip: false }">
                                                            <i class="ri-information-line text-muted cursor-pointer"
                                                               @mouseenter="showTooltip = true"
                                                               @mouseleave="showTooltip = false"></i>
                                                            <div x-show="showTooltip"
                                                                 x-transition:enter="transition ease-out duration-200"
                                                                 x-transition:enter-start="opacity-0 transform scale-95"
                                                                 x-transition:enter-end="opacity-100 transform scale-100"
                                                                 x-transition:leave="transition ease-in duration-100"
                                                                 x-transition:leave-start="opacity-100 transform scale-100"
                                                                 x-transition:leave-end="opacity-0 transform scale-95"
                                                                 class="absolute z-10 bg-gray-800 text-white text-sm rounded p-2 max-w-xs">
                                                                {{ $setting['description'] }}
                                                            </div>
                                                        </span>
                                                    @endif
                                                </label>
                                                
                                                @if($setting['type'] === 'boolean')
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox"
                                                               class="form-check-input"
                                                               id="{{ $key }}"
                                                               wire:model.debounce.500ms="formState.{{ $key }}"
                                                               x-on:change="saving = true; setTimeout(() => { saving = false }, 1500)">
                                                    </div>
                                                @elseif($setting['type'] === 'textarea' || $setting['type'] === 'text')
                                                    <textarea class="form-control"
                                                              id="{{ $key }}"
                                                              wire:model.debounce.500ms="formState.{{ $key }}"
                                                              x-on:focus="saving = false"
                                                              x-on:blur="saving = true; setTimeout(() => { saving = false }, 1500)"
                                                              rows="3"></textarea>
                                                @elseif($setting['type'] === 'json' || $setting['type'] === 'array')
                                                    <div class="position-relative">
                                                        <textarea class="form-control code-editor"
                                                                  id="{{ $key }}"
                                                                  wire:model.debounce.500ms="formState.{{ $key }}"
                                                                  x-on:focus="saving = false"
                                                                  x-on:blur="saving = true; setTimeout(() => { saving = false }, 1500)"
                                                                  rows="5">{{ is_array($setting['value']) ? json_encode($setting['value'], JSON_PRETTY_PRINT) : $setting['value'] }}</textarea>
                                                        <small class="text-muted">Enter JSON format data</small>
                                                    </div>
                                                @elseif($setting['type'] === 'url')
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light">
                                                            <i class="ri-link"></i>
                                                        </span>
                                                        <input type="url"
                                                               class="form-control"
                                                               id="{{ $key }}"
                                                               wire:model.debounce.500ms="formState.{{ $key }}"
                                                               x-on:focus="saving = false"
                                                               x-on:blur="saving = true; setTimeout(() => { saving = false }, 1500)"
                                                               placeholder="https://example.com">
                                                    </div>
                                                @elseif($setting['type'] === 'integer')
                                                    <input type="number"
                                                           class="form-control"
                                                           id="{{ $key }}"
                                                           wire:model.debounce.500ms="formState.{{ $key }}"
                                                           x-on:focus="saving = false"
                                                           x-on:blur="saving = true; setTimeout(() => { saving = false }, 1500)"
                                                           step="1">
                                                @elseif($setting['type'] === 'select')
                                                    <select class="form-select js-choice"
                                                            id="{{ $key }}"
                                                            wire:model.debounce.500ms="formState.{{ $key }}"
                                                            x-on:change="saving = true; setTimeout(() => { saving = false }, 1500)">
                                                        @foreach($setting['options'] ?? [] as $optionValue => $optionLabel)
                                                            <option value="{{ $optionValue }}">{{ $optionLabel }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <input type="text"
                                                           class="form-control"
                                                           id="{{ $key }}"
                                                           wire:model.debounce.500ms="formState.{{ $key }}"
                                                           x-on:focus="saving = false"
                                                           x-on:blur="saving = true; setTimeout(() => { saving = false }, 1500)">
                                                @endif
                                                
                                                @if($errors->has('formState.' . $key))
                                                    <div class="text-danger mt-1">
                                                        {{ $errors->first('formState.' . $key) }}
                                                    </div>
                                                @endif
                                                
                                                <div x-show="saving" 
                                                     x-transition:enter="transition ease-out duration-300"
                                                     x-transition:enter-start="opacity-0 transform scale-90"
                                                     x-transition:enter-end="opacity-100 transform scale-100"
                                                     class="text-success mt-1 text-sm">
                                                    <i class="ri-checkbox-circle-line me-1"></i> Auto-saving...
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="card custom-card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end gap-2">
                            <button type="button" 
                                    class="btn btn-secondary" 
                                    wire:click="restoreDefaults"
                                    wire:loading.attr="disabled">
                                <i class="ri-restart-line me-1"></i> Restore Defaults
                            </button>
                            <button type="button" 
                                    class="btn btn-primary" 
                                    wire:click="saveAllSettings"
                                    wire:loading.attr="disabled">
                                <i class="ri-save-line me-1"></i> Save All Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            // Initialize select2 elements
            if (typeof Choices !== 'undefined') {
                const elements = document.querySelectorAll('.js-choice');
                elements.forEach(element => {
                    new Choices(element, {
                        searchEnabled: true,
                        itemSelectText: '',
                        allowHTML: true,
                    });
                });
            }
            
            // Initialize code editors if any
            if (typeof CodeMirror !== 'undefined') {
                document.querySelectorAll('.code-editor').forEach(editor => {
                    CodeMirror.fromTextArea(editor, {
                        lineNumbers: true,
                        mode: "application/json",
                        theme: "default",
                        lineWrapping: true
                    });
                });
            }
        });
    </script>
    @endpush
</div>