<?php

    $result = getPdo()->prepare('SELECT * FROM favoris WHERE id_membre =:id_membre');
    $result->execute([
        'id_membre' => $_SESSION['id_compte']
    ]);

while ($row = $result->fetch()) {
        $fav_value = $row['favoris'];
        $plus_value = $row['plus_tard'];
        $id_post = $row['id_post'];

        // echo "plus_value";
        // echo $plus_value;

        // echo "favoris";
        // echo $fav_value;

        if (($plus_value || $fav_value) == 1 ) {
        print '<form action="" method="post">';

            reset($_POST);

            if (array_key_exists('btn_fav', $_POST)) {
                // $events->delete($event, $member);
                $favoris = new favoris();
                $favoris->updateFavoris($_POST['btn_fav'], $_SESSION['id_compte']);
                header('Location: index.php?page=favoris');
            }
            if (array_key_exists('btn_later', $_POST)) {
                // $events->delete($event, $member); 
                $later = new later();
                $later->updateLater($_POST['btn_later'], $_SESSION['id_compte']);
                header('Location: index.php?page=favoris');
            }

            print '<div>';
            $favoris->getFavorisIcon($id_post) == 0 ?
                print '<button  name="btn_fav" value=' . $id_post . ' style="border:none;background-color:transparent;"><i class="bi bi-star"></i></button>' :
                print '<button name="btn_fav" value=' . $id_post . '  style="border:none;background-color:transparent;"><i class="bi bi-star-fill"></i></button>';
            $favoris->getLaterIcon($id_post) == 0 ?
                print '<button name="btn_later" value=' . $id_post . ' style="border:none;background-color:transparent;"><i class="bi bi-clock"></i></button>' :
                print '<button name="btn_later" value=' . $id_post . ' style="border:none;background-color:transparent;"><i class="bi bi-check-circle"></i></button>';
            print '</div>';

        print '</form">';
        

        print '<div>';
        print '<div class="card-body">';

        $resultSelec = getPdo()->prepare('SELECT * FROM post WHERE UUID_post =:UUID_post');
        $resultSelec->execute([
            'UUID_post' => $id_post
        ]);
    
        while ($rowSelec = $resultSelec->fetch()) {
            
        print '<p class="card-text">' . $rowSelec['contenu'] . '</p>';
        }

        print '</div>';

        print '</div>';

        }
    }
