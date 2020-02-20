<form action="index.php?s=admin&action=add" method="post">
    <input type="text" name="nadpis" placeholder="nadpis">
    <textarea name="text" placeholder="text" id="editor"></textarea>
    <input class="button" type="submit" name="submit" value="add">
</form>

<script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
</script>