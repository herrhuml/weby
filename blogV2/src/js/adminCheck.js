
function deleteCheck(id){
    //window.location.replace('index.php?s=admin&action=delete&id='+id);
    if (confirm('Opravdu chcete tento ćlánek smazat?')) {
        window.location.replace('index.php?s=admin&action=delete&id='+id);
      } else {
      } 
}