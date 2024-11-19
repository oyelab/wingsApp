<tr>
    <td>
        @php
            $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level); // Add indentation for hierarchy
        @endphp
        {!! $indent !!}- {{ $category->title }}
    </td>
    <td>Sub Category</td>
    <td class="text-center">
        <span class="badge rounded-pill {{ $category->status == 1 ? 'bg-secondary-subtle text-secondary' : 'bg-danger-subtle text-danger' }}">
            {{ $category->status == 1 ? 'Published' : 'Unpublished' }}
        </span>
    </td>
    <td class="text-center mx-auto">
        <img class="rounded w-50" src="{{ asset('storage/images/categories/' . $category->image) }}" alt="{{ $category->title }}" style="max-width: 100px; max-height: 100px;">
    </td>
    <td>
        <a href="{{ route('categories.edit', $category->id) }}" class="mr-3"><i class="las la-pen text-secondary font-30"></i></a>
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <a href="javascript:void(0);" class="mr-3" onclick="confirmDelete(this)">
                <i class="las la-trash-alt text-secondary font-30"></i>
            </a>
        </form>
    </td>
</tr>

@foreach ($category->children as $child)
    @include('backEnd.partials.category-child', ['category' => $child, 'level' => $level + 1])
@endforeach
