
@props(['status'])
<span class="status-badge status-{{ strtolower($status) }}">
    {{ ucfirst($status) }}
</span>