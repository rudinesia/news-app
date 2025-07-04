import './bootstrap';
import Alpine from 'alpinejs';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

// Make Alpine available globally
window.Alpine = Alpine;

// CKEditor initialization function
window.initCKEditor = function(elementId) {
    ClassicEditor
        .create(document.querySelector(`#${elementId}`), {
            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'outdent',
                'indent',
                '|',
                'imageUpload',
                'blockQuote',
                'insertTable',
                'mediaEmbed',
                '|',
                'undo',
                'redo'
            ],
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:full',
                    'imageStyle:side'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            }
        })
        .then(editor => {
            console.log('CKEditor initialized successfully');
            
            // Store editor instance for form submission
            window.ckeditorInstances = window.ckeditorInstances || {};
            window.ckeditorInstances[elementId] = editor;
            
            // Update textarea on form submit
            const form = document.querySelector(`#${elementId}`).closest('form');
            if (form) {
                form.addEventListener('submit', () => {
                    document.querySelector(`#${elementId}`).value = editor.getData();
                });
            }
        })
        .catch(error => {
            console.error('CKEditor initialization failed:', error);
        });
};

// Alpine.js components
Alpine.data('sidebar', () => ({
    open: false,
    toggle() {
        this.open = !this.open;
    }
}));

Alpine.data('dropdown', () => ({
    open: false,
    toggle() {
        this.open = !this.open;
    },
    close() {
        this.open = false;
    }
}));

Alpine.data('modal', () => ({
    open: false,
    show() {
        this.open = true;
    },
    hide() {
        this.open = false;
    }
}));

Alpine.data('confirmDelete', () => ({
    showModal: false,
    deleteUrl: '',
    itemName: '',
    
    confirm(url, name) {
        this.deleteUrl = url;
        this.itemName = name;
        this.showModal = true;
    },
    
    cancel() {
        this.showModal = false;
        this.deleteUrl = '';
        this.itemName = '';
    },
    
    proceed() {
        if (this.deleteUrl) {
            // Create and submit a delete form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = this.deleteUrl;
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            const tokenField = document.createElement('input');
            tokenField.type = 'hidden';
            tokenField.name = '_token';
            tokenField.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            form.appendChild(methodField);
            form.appendChild(tokenField);
            document.body.appendChild(form);
            form.submit();
        }
    }
}));

// Start Alpine
Alpine.start();
