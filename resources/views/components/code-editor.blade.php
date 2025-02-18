<div>
    <label for="{{ $id }}" class="px-2 text-gray-400">{{ $label??'' }}</label>
    <textarea id="{{ $id }}" name="{{ $name }} }}">{{ $code }}</textarea>
</div>
<style>
    div.cm-s-monokai.CodeMirror{
        background:transparent !important;
        height: 80vh;
        width: 100%;
    }
    div.cm-s-monokai .CodeMirror-gutters{
        background:transparent !important;
    }
    div.CodeMirror-hscrollbar::-webkit-scrollbar-track{
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: transparent !important;
    }
    div.CodeMirror-hscrollbar::-webkit-scrollbar
    {
        width: 1px !important;
        height: 8px;
        background-color: transparent !important;
    }
    div.CodeMirror-hscrollbar::-webkit-scrollbar-thumb
    {
        background-color: #ffffff !important;
    }
</style>

