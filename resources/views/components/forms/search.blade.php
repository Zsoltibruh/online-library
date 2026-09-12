@props(['route', 'placeholder' => 'e.g.: Dune or George Orwell'])

<div class="mt-2">
    <form action="{{ $route }}" method="get">
        @csrf
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-full border p-4 text-base">
            <label class="label" for="search">Search</label>
            <input type="text" class="input" id="search" name="search" placeholder="{{ $placeholder }}" />

            <button type="submit" class="btn btn-primary">Search</button>
        </fieldset>
    </form>
</div>
