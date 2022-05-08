<ol class="dd-list">
    @foreach($childs as $child)
        <li class="dd-item">
            <div class="dd-handle">
                {{ $child->name }}
            </div>
            @if(count($child->childs))
                @include('admin.partials.store_cat',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ol>