<?php
    session_start();
    require_once("classes/Db.php");
    require_once("classes/Admin.php");
    require_once("classes/FileUpload.php");
    $admin = new Admin();
    $fileupload = new FileUpload();

    if(isset($_GET["action"]))
    {
        if($_GET["action"]=="login")
        {
            if(!isset($_SESSION["loggedIn"]))
            {
                $check = $admin->checkAdmin($_POST["user"],$_POST["passwd"]);
                if($check == "ok")
                {
                    $admin->login();
                }
            }
        }
        else if($_GET["action"]=="logout")
        {
            if(isset($_SESSION["loggedIn"]))
            {
                $admin->logout();
            }
        }

    }


    if(isset($_SESSION["loggedIn"]))
        {
            Db::pripoj("127.0.0.1","root","","blogv2");

            $results = Db::query('SELECT * FROM clanky')->fetchAll();
            echo('<table><tr><th>Nadpis</th><th>Text</th><th colspan="2">Akce</th></tr>');
            foreach ($results as $r) {
                echo('<tr> 
                    <td> '.$r["nadpis"].' </td> 
                    <td> '.$r["text"].' </td> 
                    <td> <a href=index.php?s=admin&action=edit&id='.$r["id"].'> edit </a> </td>
                    <td> <a class="aHover" onclick="deleteCheck('.$r["id"].')"> smazat </a> </td>
                    </tr>');
            }
            echo('</table><div class="break"></div>');
            require("components/uploadForm.php");
            echo('<div class="break"></div>');
            if(!isset($_GET["action"]) || $_GET["action"] != "edit"){
                require("components/addForm.php");
                echo('<div class="break"></div>');
            }

            if(isset($_GET["action"]))
            {
                if($_GET["action"]=="edit")
                {
                    if(!isset($_POST["submit"])){
                        $id = $_GET["id"];
                        $result = Db::query("SELECT * FROM clanky WHERE id=?",array($id))->fetchAll();
                        $nadpis = $result[0]["nadpis"];
                        $text = $result[0]["text"];
                        echo('
                        <form action="index.php?s=admin&action=edit&id='.$id.'" method="post">
                            <input type="text" name="nadpis" value="'.$nadpis.'">
                            <textarea name="text" id="editor">'.$text.'</textarea>
                            <input type="submit" name="submit" value="save">
                        </form>
                        
                        <script>
                                ClassicEditor
                                    .create( document.querySelector( \'#editor\' ) )
                                    .catch( error => {
                                        console.error( error );
                                    } );
                        </script>');
                        echo('<div class="break"></div>');
                    }else{
                        if($_POST["submit"]=="save"){
                            $n = Db::query("UPDATE clanky SET nadpis=?, text=? WHERE id=?",array($_POST["nadpis"],$_POST["text"],$_GET["id"]))->rowCount();
                            header("Location: index.php?s=admin");
                        }
                    }
                }
                elseif($_GET["action"]=="delete" && isset($_GET["id"]))
                {
                    $n = Db::query("DELETE FROM clanky WHERE id=?",array($_GET["id"]))->rowCount();
                    header("Location: index.php?s=admin");
                }
                elseif($_GET["action"]=="add" && !empty($_POST["nadpis"]) && !empty($_POST["text"]))
                {
                    $now = date("Y-m-d H:i:s");
                    $n = Db::query("INSERT INTO clanky (nadpis, text, cas) VALUES(?,?,?)",array($_POST["nadpis"],$_POST["text"],$now))->rowCount();
                    header("Location: index.php?s=admin");
                }
                elseif($_GET["action"]=="upload")
                {
                    if(isset($_POST["submit"])) {
                        $img = str_replace( " ","_",$_FILES['fileToUpload']['name'] );
                        move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], "images/".$img );
                    }
                }
            }
        }
           
    

    if(!isset($_SESSION["loggedIn"]))
    {
        require("components/loginForm.html");
    }
    else if(isset($_SESSION["loggedIn"]))
    {
        require("components/logoutForm.html");
    }
?>