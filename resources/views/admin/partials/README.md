# Admin Panel Modular Components

This directory contains reusable components for the admin panel to maintain consistency and reduce code duplication.

## Components

### 1. Sidebar (`sidebar.blade.php`)
- **Purpose**: Main navigation sidebar for admin panel
- **Features**:
  - Dynamic active state based on current route
  - Role-based menu items (Super Admin only sections)
  - User profile section with avatar and role display
  - Logout functionality

### 2. Header (`header.blade.php`)
- **Purpose**: Top header bar with page title and actions
- **Features**:
  - Dynamic page title from `@yield('page-title')`
  - Breadcrumb navigation support
  - "View Site" button to frontend
  - Responsive design

### 3. Flash Messages (`flash-messages.blade.php`)
- **Purpose**: Display session flash messages
- **Supported Types**:
  - `success` - Green success messages
  - `error` - Red error messages
  - `warning` - Yellow warning messages
  - `info` - Blue info messages

### 4. Delete Modal (`delete-modal.blade.php`)
- **Purpose**: Confirmation modal for delete operations
- **Features**:
  - Alpine.js powered interactivity
  - Dynamic item name display
  - Form submission handling
  - Accessible design with proper focus management

## Usage

### In Layout Files
```blade
@include('admin.partials.sidebar')
@include('admin.partials.header')
@include('admin.partials.flash-messages')
@include('admin.partials.delete-modal')
```

### Delete Modal JavaScript
```javascript
// Call this function to show delete confirmation
confirmDelete(itemName, deleteUrl)

// Example in blade template
<button onclick="confirmDelete('{{ $item->name }}', '{{ route('admin.items.destroy', $item) }}')">
    Delete
</button>

// Or using data attributes (recommended for special characters)
<button data-name="{{ $item->name }}" 
        data-url="{{ route('admin.items.destroy', $item) }}"
        onclick="confirmDelete(this.dataset.name, this.dataset.url)">
    Delete
</button>
```

## Design Consistency

All components follow the same design principles:
- **Tailwind CSS** for styling
- **Heroicons** for SVG icons
- **Alpine.js** for interactivity
- **Consistent color scheme**: Gray-based with blue accents
- **Responsive design** for mobile and desktop

## Customization

To customize these components:
1. Edit the respective `.blade.php` file
2. Changes will automatically apply to all pages using the component
3. Maintain the existing CSS classes for consistency
4. Test across all admin pages after changes
